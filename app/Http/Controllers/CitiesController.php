<?php

namespace App\Http\Controllers;

use App\City;
use App\Governorate;
use App\Photo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CitiesController extends Controller
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
        $governorates=Governorate::all();
        if($governorates->count()>0){
            return view('admin.cities.index',compact('governorates'));
        }else{
            \Session::flash('urlerror','there is no governorates or cities to show please add one and try again');
            \Session::flash('url','cities/create');
            return view('admin.cities.index');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $governorates=Governorate::all();
        $cities=City::all();
        if($governorates->count()>0){
            return view('admin.cities.create',compact('governorates','cities'));
        }else{
            \Session::flash('urlerror','please add any governorate before add any city');
            \Session::flash('url','governorates/create');
            return redirect()->route('governorates.create');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->has('is_division')){
            $city=\App\Division::create([
                    'name'=>$request->input('name'),
                    'area'=>$request->input('area'),
                    'gover_id'=>$request->input('governorate_id'),
                    'is_city'=>1,
                    'div_id'=>$request->input('div_id'),
                    'population'=>$request->input('population'),
                    'p_denisty_rate'=>$request->input('p_denisty_rate'),
                    'description'=>$request->input('description')
                ]);
        }else{
            if($request->has('governorate')){
                $city=\App\City::create([
                    'name'=>$request->input('name'),
                    'area'=>$request->input('area'),
                    'gover_id'=>$request->input('governorate_id'),
                    'is_division'=>$request->input('is_division'),
                    'div_id'=>$request->input('div_id'),
                    'population'=>$request->input('population'),
                    'p_denisty_rate'=>$request->input('p_denisty_rate'),
                    'description'=>$request->input('description')
                ]);
            }else{
                $city=\App\City::create([
                    'name'=>$request->input('name'),
                    'area'=>$request->input('area'),
                    'gover_id'=>$request->input('gover_id'),
                    'is_division'=>$request->input('is_division'),
                    'population'=>$request->input('population'),
                    'div_id'=>$request->input('div_id'),
                    'p_denisty_rate'=>$request->input('p_denisty_rate'),
                    'description'=>$request->input('description')
                ]);
            }
        }
        
        $city->photos()->create([
            'url'=>PhotosController::save_image($request->file('flag')),
            'thumb'=>PhotosController::save_image_thumb($request->file('flag')),
            'name'=>$city->name."_flag",
            'tag'=>"flags"
        ]);
        $city->photos()->create([
            'url'=>PhotosController::save_image($request->file('logo')),
            'thumb'=>PhotosController::save_image_thumb($request->file('logo')),
            'name'=>$city->name."_logo",
            'tag'=>"logos"
        ]);
        \Session::flash('message','City has been Added');
        return redirect('cities/'.$city->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $city=City::findOrFail($id);
        return view('admin.cities.show',compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $governorates=\App\Governorate::all();
        $city=City::findOrFail($id);
        return view('admin.cities.edit',compact('governorates','city'));
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
        $city=\App\City::find($id);
        $flag=$city->photos()->where('tag','=','logos')->first();
        $logo=$city->photos()->where('tag','=','flags')->first();
        $images=$city->photos()->where('tag','=','features')->get();
        $city->update([
            'name'=>$request->input('name'),
            'area'=>$request->input('area'),
            'gover_id'=>$request->input('gover_id'),
            'is_division'=>$request->input('is_division'),
            'units'=>$request->input('units'),
            'divisions'=>$request->input('divisions'),
            'population'=>$request->input('population'),
            'p_denisty_rate'=>$request->input('p_denisty_rate'),
            'code'=>$request->input('code'),
            'time_zone'=>$request->input('time_zone'),
            'website'=>$request->input('website'),
            'creation_date'=>$request->input('creation_date'),
            'national_day'=>$request->input('national_day'),
            'description'=>$request->input('description')
        ]);
        if($request->hasFile('flag')) {
            Storage::delete($flag['url']);
            Storage::delete($flag['thumb']);
            $flag->update([
                'url' => PhotosController::save_image($request->file('flag')),
                'thumb' => PhotosController::save_image_thumb($request->file('flag'))
            ]);
        }elseif($request->hasFile('logo')){
            Storage::delete($logo['url']);
            Storage::delete($logo['thumb']);
            $logo->update([
                'url'=>PhotosController::save_image($request->file('logo')),
                'thumb'=>PhotosController::save_image_thumb($request->file('logo'))
            ]);
        }elseif($request->hasFile('images')){
            $nimages=$request->file('images');
            foreach($images as $image){
                foreach($nimages as $nimage){
                    Storage::delete($image['url']);
                    Storage::delete($image['thumb']);
                    $image->update([
                        'url'=>PhotosController::save_image($nimage),
                        'thumb'=>PhotosController::save_image_thumb($nimage)
                    ]);
                }
            }
        }

        \Session::flash('message','City has been Added');
        return redirect('cities/'.$city->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city=City::find($id);
        foreach($city->photos as $photo){
            Photo::find($photo['id'])->delete();
            Storage::delete($photo['url']);
        }
        $city->delete();
        \Session::flash('error','City has been Deleted');
        return redirect()->route('cities.create');
    }
    public function ajaxcities()
    {
        $id=Input::get('gover_id');
        if($id){
            $cities=City::with('photos')->where('gover_id','=',$id)->get();
        }else{
            $cities=City::with('photos')->get();
        }
        return response()->json($cities);
    }
}
