<?php
namespace App\Http\Controllers\API\V1;


use App\Category;
use App\Center;
use App\Photo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CentersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $centers=Center::all();
        if($centers->count()>0){
            return view('admin.centers.index',compact('centers'));
        }else{
            \Session::flash('error','there is no Centers to show please add one and try again');
            \Session::flash('url','centers/create');
            return view('admin.centers.index');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $centers=Center::all();
        $categories=Category::all();
        return view('admin.centers.create',compact('centers','categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $center=Center::create([
            'name'=>$request->input('name'),
            'cat_id'=>$request->input('cat_id'),
            'desc'=>$request->input('desc')
        ]);
        $center->photos()->create([
            'url'=>PhotosController::save_image($request->file('logo')),
            'thumb'=>PhotosController::save_image_thumb($request->file('logo')),
            'name'=>$center->name."_logo",
            'tag'=>"logos"
        ]);
        \Session::flash('message','Center has been Added');
        return redirect('centers/'.$center->id.'/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $center=Center::findOrFail($id);
        return view('admin.centers.show',compact('center'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories=Category::all();
        $center=Center::findOrFail($id);
        return view('admin.centers.edit',compact('center','categories'));
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
        $center=Center::findOrFail($id);
        $logo=$center->photos()->where('tag','=','logos')->first();
        $center->update([
            'name'=>$request->input('name'),
            'cat_id'=>$request->input('cat_id'),
            'desc'=>$request->input('desc')
        ]);
        if($request->hasFile('logo')) {
            Storage::delete($logo['url']);
            Storage::delete($logo['thumb']);
            $logo->update([
                'url' => PhotosController::save_image($request->file('logo')),
                'thumb' => PhotosController::save_image_thumb($request->file('logo'))
            ]);
        }
        \Session::flash('message','Center has been updated');
        return redirect('centers/'.$center->id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $center=Center::find($id);
        foreach($center->photos as $photo){
            Photo::find($photo['id'])->delete();
            Storage::delete($photo['path']);
        }
        $center->delete();
        \Session::flash('error','centers has been Deleted');
        return redirect()->route('centers.create');
    }
}
