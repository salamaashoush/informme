<?php

namespace App\Http\Controllers;

use App\City;
use App\Division;
use App\Governorate;
use App\Photo;
use App\Unit;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class UnitsController extends Controller
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
        $cities=City::with('divisions')->get();
        $divisions=Division::with('units.photos')->get();
        if($divisions->count()>0){
            return view('admin.units.index',compact('governorates','cities','divisions'));
        }else{
            \Session::flash('error','there is no Units to show please add one and try again');
            \Session::flash('url','units/create');
            return view('admin.units.index');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $units=Unit::all();
        $divisions=Division::all();
        $cities=City::all();
        if($divisions->count()>0){
            return view('admin.units.create',compact('units','cities','divisions'));
        }else{
            \Session::flash('error','please add any divisions before add any units');
            return redirect()->route('divisions.create');
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
        if($request->has('division')){
            $unit=Unit::create([
                'name'=>$request->input('name'),
                'area'=>$request->input('area'),
                'city_id'=>$request->input('city_id'),
                'div_id'=>$request->input('div_id'),
                'population'=>$request->input('population'),
                'p_denisty_rate'=>$request->input('p_denisty_rate'),
                'code'=>$request->input('code'),
                'time_zone'=>$request->input('time_zone'),
                'website'=>$request->input('website'),
                'creation_date'=>$request->input('creation_date'),
                'national_day'=>$request->input('national_day'),
                'description'=>$request->input('description')
            ]);
        }else{
            $unit=Unit::create([
                'name'=>$request->input('name'),
                'area'=>$request->input('area'),
                'city_id'=>$request->input('city_id'),
                'div_id'=>$request->input('div_id'),
                'population'=>$request->input('population'),
                'p_denisty_rate'=>$request->input('p_denisty_rate'),
                'code'=>$request->input('code'),
                'time_zone'=>$request->input('time_zone'),
                'website'=>$request->input('website'),
                'creation_date'=>$request->input('creation_date'),
                'national_day'=>$request->input('national_day'),
                'description'=>$request->input('description')
            ]);
        }
        $unit->photos()->create([
            'url'=>PhotosController::save_image($request->file('flag')),
            'thumb'=>PhotosController::save_image_thumb($request->file('flag')),
            'name'=>$unit->name."_flag",
            'tag'=>"flags"
        ]);
        $unit->photos()->create([
            'url'=>PhotosController::save_image($request->file('logo')),
            'thumb'=>PhotosController::save_image_thumb($request->file('logo')),
            'name'=>$unit->name."_logo",
            'tag'=>"logos"
        ]);
        $images=$request->file('images');
        foreach($images as $image){
            $unit->photos()->create([
                'url'=>PhotosController::save_image($image),
                'thumb'=>PhotosController::save_image_thumb($image),
                'name'=>$unit->name."_feature",
                'tag'=>"features"
            ]);
        }
        \Session::flash('message','Units has been Added');
        return redirect('units/'.$unit->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $unit=Unit::findOrFail($id);
        return view('admin.units.show',compact('unit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $divisions=Division::all();
        $unit=Unit::findOrFail($id);
        $units=Unit::all();
        return view('admin.units.edit',compact('unit','units','divisions'));
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
        $unit=Unit::find($id);
        $flag=$unit->photos()->where('tag','=','logos')->first();
        $logo=$unit->photos()->where('tag','=','flags')->first();
        $images=$unit->photos()->where('tag','=','features')->get();
        $unit->update([
            'name'=>$request->input('name'),
            'area'=>$request->input('area'),
            'city_id'=>$request->input('city_id'),
            'div_id'=>$request->input('div_id'),
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

        \Session::flash('message','units has been updated');
        return redirect('units/'.$unit->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unit=Unit::find($id);
        foreach($unit->photos as $photo){
            Photo::find($photo['id'])->delete();
            Storage::delete($photo['path']);
        }
        $unit->delete();
        \Session::flash('error','units has been Deleted');
        return redirect()->route('units.create');
    }
}
