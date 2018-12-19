<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Session;

class CategorysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //->with('categories', Category::all())
        return view('admin.categories.index')->with('categories', Category::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $categories = Category::all();
        // , compact('categories')
        return view('admin.categories.create')->with('categories', Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            
            'name' => 'required|max:255'
        ]);

        $category = new Category;

        $category->name = $request->name;

        $category->save();

        Session::flash('success', 'You successfuly created a category!');

        return redirect()->route('categories');

       
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
        //
        $category = Category::find($id);

        return view('admin.categories.edit')->with('category', $category);
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
        //
        $category = Category::find($id);

        $category->name = $request->name;

        $category->save();

        Session::flash('success', 'You successfuly updated a category!');

        return redirect()->route('categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Find a category by id and delete it
        $category = Category::find($id);

        $categories = Category::all();

        // ako nema kategorija brisemo post
        foreach($category->posts as $post){

            // improvizacija
            if ($categories->count() > 1 ){
                $post->save();  
            } else {
                $post->forceDelete();    
            }
        }

        $category->delete();

        Session::flash('success', 'You successfuly deleted a category!');
        return redirect()->route('categories');
    }
}
