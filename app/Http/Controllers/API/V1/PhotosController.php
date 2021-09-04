<?php
namespace App\Http\Controllers\API\V1;


use App\Center;
use App\City;
use App\Division;
use App\Governorate;
use App\Hamlet;
use App\Person;
use App\Photo;
use App\Place;
use App\Unit;
use App\User;
use App\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Intervention\Image\Response;

class PhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos=Photo::all();
        if($photos->count()>0){
            return view('admin.photos.index',compact('photos'));
        }else{
            \Session::flash('error','there is no photos to view');
            \Session::flash('url','photos/create');
            return view('admin.photos.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $photos=Photo::all();
        return view('admin.photos.create',compact('photos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->has('model')){
            $model=$request->input('model');
            $id=$request->input('id');
            switch($model){
                case "Governorate":
                    $model=Governorate::find($id);
                    break;
                case "City":
                    $model=City::find($id);
                    break;
                case "Division":
                    $model=Division::find($id);
                    break;
                case "Unit":
                    $model=Unit::find($id);
                    break;
                case "Village":
                    $model=Village::find($id);
                    break;
                case "Hamlet":
                    $model=Hamlet::find($id);
                    break;
                case "Center":
                    $model=Center::find($id);
                    break;
                case "Person":
                    $model=Person::find($id);
                    break;
                case "User":
                    $model=User::find($id);
                    break;
                case "Place":
                    $model=Place::find($id);
                    break;
                case "Article":
                    $model=Place::find($id);
                    break;
                default:
                    break;
            }

            $images = $request->file('images');
            foreach ($images as $image) {
                $model->photos()->create([
                    'path' => $this->save_image($image),
                    'thumb' => $this->save_image_thumb($image),
                    'name' => $model->name,
                    'tag' =>  $request->input('type')
                ]);
            }
        }else{
            $images = $request->file('images');
            foreach ($images as $image) {
                Photo::create([
                    'url' => $this->save_image($image),
                    'thumb' => $this->save_image_thumb($image),
                    'name' => $request->input('name'),
                    'tag' => $request->input('type')
                ]);
            }
        }
        \Session::flash('message','photo added successfully');
        return redirect()->route('photos.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $photo=Photo::findOrFail($id);
        return view('admin.photos.show',compact('photo'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $photo=Photo::findOrFail($id);
        $photo->update([
            'name' => $request->input('name'),
            'tag' => $request->input('type')
        ]);
        \Session::flash('message','photo updated successfully');
        return redirect()->route('photos.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo=Photo::find($id);
        Storage::delete($photo['url']);
        $photo->delete();
        $photos=Photo::all();
        \Session::flash('error','Photo has been Deleted');
        return view('admin.photos.create',compact('photos'));
    }
    static public function save_image($image)
    {
        $filename=date('Y-m-d H-i-s')."_".$image->getClientOriginalName();
        Image::make($image->getRealPath())->save(public_path()."/images/".$filename);
        return "images/".$filename;
    }
    static public function save_image_thumb($image)
    {
        $filename=date('Y-m-d H-i-s')."_".$image->getClientOriginalName();
        Image::make($image->getRealPath())->resize(100,100)->save(public_path()."/images/thumbs/".$filename);
        return "images/thumbs/".$filename;
    }

    public function ajax_upload()
    {
        $image=Input::file('image');

        $saved=Photo::create([
            'url' => $this->save_image($image),
            'thumb' => $this->save_image_thumb($image),
            'name' => $image->getClientOriginalName(),
            'tag' => 'article'
        ]);
        $link=['link'=>asset($saved->url)];

        return response()->json($link);
    }
    public function ajax_index()
    {
        $photos=Photo::all();
        $images=[];
        foreach($photos as $photo){
            $images[]=[
                'name'=>$photo->name,
                'id'=>$photo->id,
                'url'=>asset($photo->url),
                'thumb'=>asset($photo->thumb),
                'tag'=>$photo->tag
            ];
        }
        return response()->json($images);
    }
    public function ajax_delete()
    {
        $src=Input::get('src');
        $query=str_replace('http://inform-me.app/i', 'i', $src);
        $photo=Photo::where('thumb',$query)->first();
        \Storage::delete($photo->url);
        \Storage::delete($photo->thumb);
        $photo->delete();
    }

}
