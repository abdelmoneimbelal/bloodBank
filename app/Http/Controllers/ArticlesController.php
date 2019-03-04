<?php

namespace App\Http\Controllers;

use App\Category;
use App\Article;
use Image;
//use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $records = Article::paginate(20);
        return view('posts.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id')->toArray();
        return view('posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required',
            'publish_date' => 'required',
        ));
        $post = new Article;
        $post->title= $request->input('title');
        $post->description= $request->input('description');
        $post->category_id= $request->input('category_id');
        $post->publish_date= $request->input('publish_date');

        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = 'uploads/image_'.time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save( public_path($filename ) );
            $post->image = $filename;
            $post->save();
        };

        $post->save();

        return redirect()->route('articles.index')
            ->with('success','Item created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model =Article::findOrFail($id);
        return view('posts.edit',compact('model'));
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
        $record = Article::findOrFail($id);
        $record->update($request->all());
        flash()->success('<p class="text-center" style="font-size:20px; font-weight:900;font-family:Arial" >لقـــد تـــــــم التحــديــــــــث بنــجـــــــاح</p>');
        return redirect(route('articles.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Article::findOrFail($id);
        if (file_exists($record->image))
        {
            unlink(public_path($record->image));
        }
        $record->delete();
        flash()->error('<p class="text-center" style="font-size:20px; font-weight:900;font-family:Arial" >تـــم الحــذف </p>');
        return back();
    }
}
