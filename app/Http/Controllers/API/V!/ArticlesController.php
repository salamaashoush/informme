<?php

namespace App\Http\Controllers;

use App\Article;
use App\Center;
use App\City;
use App\Division;
use App\Governorate;
use App\Person;
use App\Place;
use App\Unit;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
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
        $articles=Article::all();
        if($articles->count()>0){
            return view('admin.articles.index',compact('articles'));
        }else{
            \Session::flash('error','there is noarticles show please add one and try again');
            \Session::flash('url','articles/create');
            return view('admin.articles.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articles=Article::all();
        return view('admin.articles.create',compact('articles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('model')) {
            $model = $request->input('model');
            $id = $request->input('id');
            switch ($model) {
                case "Governorate":
                    $model = Governorate::find($id);
                    break;
                case "City":
                    $model = City::find($id);
                    break;
                case "Division":
                    $model = Division::find($id);
                    break;
                case "Unit":
                    $model = Unit::find($id);
                    break;
                case "Center":
                    $model = Center::find($id);
                    break;
                case "Person":
                    $model = Person::find($id);
                    break;
                case "User":
                    $model = User::find($id);
                    break;
                case "Place":
                    $model = Place::find($id);
                    break;
                default:
                    break;
            }
            $article=$model->articles()->create([
                'type' => $request->input('type') . "_" . $model->name,
                'title'=>$request->input('title'),
                'body'=>$request->input('body')
            ]);

            if ($request->file('main_image')) {
                $photo = $request->file('main_image');
                $article->photos()->create([
                    'name' => $photo->getClientOriginalName(),
                    'url' => PhotosController::save_image($photo, $article->name),
                    'thumb' => PhotosController::save_image_thumb($photo, $article->name),
                    'tag' => 'article'
                ]);
            }
            \Session::flash('message','article created successfully');
            return redirect()->route($model->edit_route,$model->id);
        } else {
            $article=Article::create([
                'type' => $request->input('type'),
                'title' => $request->input('title'),
                'body' => $request->input('body')
            ]);
            if ($request->file('main_image')) {
                $photo = $request->file('main_image');
                $article->photos()->create([
                    'name' => $photo->getClientOriginalName(),
                    'url' => PhotosController::save_image($photo),
                    'thumb' => PhotosController::save_image_thumb($photo),
                    'tag' => 'article'
                ]);
            }
            \Session::flash('message','article created successfully');
            return redirect()->route('articles.create');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article=Article::findOrFail($id);
        return view('admin.articles.show',compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article=Article::findOrFail($id);
        return view('admin.articles.edit',compact('article'));
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
        $article=Article::findOrFail($id);
        if ($request->has('type')) {
            $article->update([
                'type' => $request->input('type'),
                'title' => $request->input('title'),
                'body' => $request->input('body')
            ]);
        }else{
            $article->update([
                'title' => $request->input('title'),
                'body' => $request->input('body')
            ]);
        }
        \Session::flash('message','article updated successfully');
        return redirect()->route('articles.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Article::find($id)->delete();
        $articles=Article::all();
        \Session::flash('error','Article has been Deleted');
        return view('admin.articles.create',compact('articles'));
    }
}
