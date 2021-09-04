<?php

namespace App\Http\Controllers;

use App\City;
use App\Governorate;
use App\Photo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class GovernoratesController extends Controller
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
        $governorates=\App\Governorate::all();
        return view('admin.governorates.index',compact('governorates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $governorates=\App\Governorate::all();
        return view('admin.governorates.create',compact('governorates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $governorate=Governorate::create([
            'name'=>$request->input('name'),
            'type'=>$request->input('type'),
            'capital'=>$request->input('capital'),
            'area'=>$request->input('area'),
            'population'=>$request->input('population'),
            'p_denisty_rate'=>$request->input('p_denisty_rate'),
            'code'=>$request->input('code'),
            'time_zone'=>$request->input('time_zone'),
            'website'=>$request->input('website'),
            'description'=>$request->input('description')
        ]);
        $governorate->photos()->create([
            'url'=>PhotosController::save_image($request->file('flag')),
            'thumb'=>PhotosController::save_image_thumb($request->file('flag')),
            'name'=>$governorate->name."_flag",
            'tag'=>'flags'
        ]);
        $governorate->photos()->create([
            'url'=>PhotosController::save_image($request->file('logo')),
            'thumb'=>PhotosController::save_image_thumb($request->file('logo')),
            'name'=>$governorate->name."_logo",
            'tag'=>'logos'
        ]);
        \Session::flash('message','Governorate has been created');
        return redirect()->route('governorates.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $governorate=Governorate::findOrFail($id);
        return view('admin.governorates.show',compact('governorate'));
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
        $governorate=Governorate::findOrFail($id);
        return view('admin.governorates.edit',compact('governorate','governorates'));


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
        $governorate=Governorate::findOrFail($id);
        $flag=$governorate->photos()->where('tag','=','flags')->first();
        $logo=$governorate->photos()->where('tag','=','logos')->first();
        $governorate->update([
            'name'=>$request->input('name'),
            'capital'=>$request->input('capital'),
            'area'=>$request->input('area'),
            'population'=>$request->input('population'),
            'p_denisty_rate'=>$request->input('p_denisty_rate'),
            'code'=>$request->input('code'),
            'time_zone'=>$request->input('time_zone'),
            'website'=>$request->input('website'),
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
        }
        \Session::flash('message','Governorate has been updated');
        return redirect()->route('governorates.edit',compact('governorate'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $governorate=Governorate::find($id);
        foreach($governorate->photos as $photo){
            Photo::find($photo['id'])->delete();
            Storage::delete($photo['path']);
        }
        $governorate->delete();
        \Session::flash('error','Governorate has been Deleted');
        return redirect()->route('governorates.create');
    }
}
