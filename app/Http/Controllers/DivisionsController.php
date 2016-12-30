<?php

namespace App\Http\Controllers;

use App\City;
use App\Division;
use App\Governorate;
use App\Photo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class DivisionsController extends Controller
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
        $divisions=Division::with('photos')->get();
        if($cities->count()>0){
            return view('admin.divisions.index',compact('governorates','divisions'));
        }else{
            \Session::flash('urlerror','there is no Divisions to show please add one and try again');
            \Session::flash('url','divisions/create');
            return view('admin.divisions.index');
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
        $divisions=Division::all();
        if($governorates->count()>0){
            return view('admin.divisions.create',compact('divisions','governorates'));
        }else{
            \Session::flash('error','please add any Governorate before add any divisions');
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
        if($request->has('governorate_id')){
            $division=Division::create([
                'name'=>$request->input('name'),
                'area'=>$request->input('area'),
                'gover_id'=>$request->input('governorate_id'),
                'type'=>$request->input('type'),
                'is_city'=>$request->input('is_city'),
                'population'=>$request->input('population'),
                'description'=>$request->input('description')
            ]);
        }else{
            $division=Division::create([
                'name'=>$request->input('name'),
                'area'=>$request->input('area'),
                'gover_id'=>$request->input('gover_id'),
                'type'=>$request->input('type'),
                'is_city'=>$request->input('is_city'),
                'population'=>$request->input('population'),
                'description'=>$request->input('description')
            ]);
        }
        $division->photos()->create([
            'url'=>PhotosController::save_image($request->file('flag')),
            'thumb'=>PhotosController::save_image_thumb($request->file('flag')),
            'name'=>$division->name."_flag",
            'tag'=>"flags"
        ]);
        $division->photos()->create([
            'url'=>PhotosController::save_image($request->file('logo')),
            'thumb'=>PhotosController::save_image_thumb($request->file('logo')),
            'name'=>$division->name."_logo",
            'tag'=>"logos"
        ]);
        \Session::flash('message','Division has been Added');
        return redirect('divisions/'.$division->id.'/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $division=Division::findOrFail($id);
        return view('admin.divisions.show',compact('division'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cities=City::all();
        $division=Division::findOrFail($id);
        $divisions=Division::all();
        return view('admin.divisions.edit',compact('division','divisions','cities'));
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
        $division=Division::find($id);
        $flag=$division->photos()->where('tag','=','logos')->first();
        $logo=$division->photos()->where('tag','=','flags')->first();
        $division->update([
            'name'=>$request->input('name'),
            'area'=>$request->input('area'),
            'gover_id'=>$request->input('gover_id'),
            'type'=>$request->input('type'),
            'is_city'=>$request->input('is_city'),
            'population'=>$request->input('population'),
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

        \Session::flash('message','division has been updated');
        return redirect('divisions/'.$division->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $division=Division::find($id);
        foreach($division->photos as $photo){
            Photo::find($photo['id'])->delete();
            Storage::delete($photo['path']);
        }
        $division->delete();
        \Session::flash('error','Division has been Deleted');

        return redirect()->route('divisions.create');
    }
    public function ajaxdivisions()
    {
        $id=Input::get('gover_id');
        if($id){
            $divisions=Division::where('gover_id','=',$id)->get();
        }else{
            $divisions=Division::all();
        }
        return response()->json($divisions);
    }
}
