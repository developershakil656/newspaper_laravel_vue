<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use PhpParser\Node\Stmt\Foreach_;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id','desc')->get();
        return response()->json([
            'categories' => $categories
        ]);
    }

    public function activeCategories(){
        $categories = Category::with('posts')->where('status',1)->get();
        return response()->json([
            'categories' => $categories
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
        $request->validate([
            'name' => 'required|unique:categories',
            'status' => 'required',
        ]);

        // $category = Category::create([
        //     'name' => $request->name,
        //     'slug' => $request->name,
        //     'status' => $request->status,
        // ]);

        $category =new Category;

        $category->name = $request->name;
        $category->slug = slugify($request->name);
        $category->status = $request->status;

        $category->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $category=Category::where('slug',$slug)->first();

        return response()->json([
            'category' => $category
        ]);
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
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $category =Category::find($request->id);

        $category->name = $request->name;
        $category->slug = slugify($request->name);
        $category->status = $request->status;

        $category->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $category= Category::where('slug',$slug)->first();
        $category->delete();
    }

    public function deleteAll(Request $request){
        foreach ($request->data as $id) {
            $category= Category::find($id);
            $category->delete();
        }
    }

    public function activeAll(Request $request){
        foreach ($request->data as $id) {
            $category =Category::find($id);
            $category->status = $request->status;

            $category->update();
        }
    }

}
