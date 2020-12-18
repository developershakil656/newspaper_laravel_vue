<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts= Post::with('category','user')->orderBy('id','desc')->paginate(5);

        return $posts;
        // return response()->json([
        //     $posts
        // ]);
    }


    //sliders-------------------
    public function sliders()
    {
        $sliders= Post::with('category','user')->orderBy('slider_position','ASC')->where('slider',1)->get();

        return response()->json([
            'sliders' => $sliders
        ]);
    }

    public function addSlider(Request $request){
        foreach ($request->data as $id) {
            $post =Post::find($id);
            $post->slider = 1;

            $post->update();
        }
    }
    public function sliderPosition(Request $request)
    {
        foreach ($request->id as $id) {
            $post =Post::find($id);
            $post->slider_position = $request->position[$id];
            $post->update();
        }
    }
    public function removeSlider(Request $request){
        foreach ($request->data as $id) {
            $post= Post::find($id);
            
            $post->slider = 0;
            $post->update();
        }
    }

//frontend----------------------
    public function activePosts(){
        $posts= Post::with('category','user')->where('status','published')->orderBy('id','desc')->get();

        return response()->json([
            'posts' => $posts
        ]);
    }
    public function categoryPosts($slug)
    {
        $category= Category::where('slug',$slug)->first();

        $posts= Post::with('category','user')->where('category_id',$category->id)->where('status','published')->orderBy('id','desc')->get();

        return response()->json([
            'posts' => $posts,
            'categoryName'=>$category->name
        ]);
    }
    public function showPost($slug)
    {
        $post = Post::where('slug',$slug)->where('status','published')->first();
        return response()->json([
            'post' => $post
        ]);
    }

    //search By
    public function search(Request $request)
    {
        $posts= Post::with('category')->where('title','LIKE','%'.$request->slug.'%')->orwhere('content','LIKE','%'.$request->slug.'%')->get();

        // $posts= Post::with('category','user')->where('category_id',$category->id)->where('status','published')->orderBy('id','desc')->get();

        return response()->json([
            'posts' => $posts
        ]);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post= new Post;
        $user_id=Auth::user()->id;

        $post->user_id=$user_id;
        $post->category_id=$request->category_id;
        $post->title=$request->title;
        $post->slug=slugify($request->title).rand(0,9);
        $post->content=$request->content;
        $post->status=$request->status;
        $thumbnail=$request->thumbnail;
        
        if($thumbnail){
            $thumbnail_name=date('sihdmy');

            $fileType= explode('/',$request->fileType);
            $ext=end($fileType);
            $full_name= $thumbnail_name.'.'.$ext;
            $thumbnail_path='uploads/post/';
            $thumbnail_url=$thumbnail_path.$full_name;
            $post->thumbnail= $thumbnail_url;

            if($post->save()){
                Image::make($request->thumbnail)->resize(600, 250)->save($thumbnail_url);
            }
            
        }else{
            $post->save();
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
        $post = Post::find($id);
        return response()->json([
            'post' => $post
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $post= Post::find($request->id);

        $post->category_id=$request->category_id;
        $post->title=$request->title;
        $post->content=$request->content;
        $post->status=$request->status;
        $thumbnail=$request->thumbnail;
        
        if($thumbnail != $post->thumbnail){
            if(file_exists($post->thumbnail)){
                unlink($post->thumbnail);
            }

            $thumbnail_name=date('sihdmy');
            $fileType= explode('/',$request->fileType);
            $ext=end($fileType);
            $full_name= $thumbnail_name.'.'.$ext;
            $thumbnail_path='uploads/post/';
            $thumbnail_url=$thumbnail_path.$full_name;
            $post->thumbnail= $thumbnail_url;

            if($post->update()){
                Image::make($request->thumbnail)->resize(500, 250)->save($thumbnail_url);
            }
            
        }else{
            $post->update();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post= Post::find($id);

        if($post->delete()){
            if(file_exists($post->thumbnail)){
                unlink($post->thumbnail);
            }
        }
    }

    public function deleteAll(Request $request){
        foreach ($request->data as $id) {
            $post= Post::find($id);
            
            if($post->delete()){
                if(file_exists($post->thumbnail)){
                    unlink($post->thumbnail);
                }
            }
        }
    }

    public function activeAll(Request $request){
        foreach ($request->data as $id) {
            $post =Post::find($id);
            $post->status = $request->status;

            $post->update();
        }
    }

    public function checkAuth()
    {
        return response()->json([
            'user' => Auth::user()
        ]);
    }
}
