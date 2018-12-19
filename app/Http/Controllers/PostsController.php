<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;
use App\Tag;
use Session;
use Auth;

class PostsController extends Controller
{
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //->with('category', Category::all())
        

        $categories = Category::all();

        $tags = Tag::all();

        if($categories->count() == 0 || $tags->count() == 0 ){
            Session::flash('info', 'You must have some categories and tags before attempting to create a post.');

            return redirect()->back();
        }

        return view('admin.posts.create')->with('categories', $categories)
                                            ->with('tags', $tags);
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
        // dd($request->all());

        $this->validate($request, [

            'title' => 'required|max:255',
            'file' => 'required|image',
            'content' => 'required',
            'category_id' => 'required',
            'tags' => 'required'

        ]);

        $featured = $request->file;
        $featured_new_name = time().$featured->getClientOriginalName();
        $featured->move('uploads/posts', $featured_new_name);

        // Brzi nacin od $post = new Post;
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'feature' => 'uploads/posts/'. $featured_new_name,
            'category_id' => $request->category_id,
            'slug' => str_slug($request->title),
            // pravimo vezu sa novom kolonom u tabeli koju smo naknadno napravili
            // nakon ovog u Post.php stavljamo da je i ovo polje filable
            'iser_id' => Auth::id() 
        ]);

        $post->tags()->attach($request->tags);

        Session::flash('success', 'You successfuly created a post!');

        // dd($request->all());

        return redirect()->back();
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
        $post = Post::find($id);

        return view('admin.posts.edit')->with('post', $post)
                                       ->with('categories', Category::all())
                                       ->with('tags', Tag::all());
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
        $post = Post::find($id);

        $this->validate($request, [
            
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required'

        ]);

        if($request->hasFile('file')){

            $featured = $request->file;

            // time() da bi vreme bilo jedinstveno
            $feature_new_name = time() . $featured->getClientOriginalName();

            $featured->move('uploads/posts/' , $feature_new_name);

            $post->feature = 'uploads/posts/'. $feature_new_name;
        }

        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;

        $post->save();

        // ovaj sync() metod ide u bazu, syncuje nove tagove
        $post->tags()->sync($request->tags);

        Session::flash('success', 'You sucessfuly updated the post!');

        return redirect()->route('posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::find($id);
        $post->delete();

        Session::flash('success', 'You sucessfuly deleted a post!');
        // return redirect()->route('posts');
        return redirect()->back();
    }

    public function trashed(){

        // onlyTrashed() je metod koji povlaci samo trashed iz baze
        // get() isto treba on povlaci rez samo odredjenog modela, u ovom slucaju Post modela
        $posts = Post::onlyTrashed()->get();

        return view('admin.posts.trashed')->with('posts', $posts);
       
    }

    // Delete posts permanently
    public function kill($id){

        // withTrashed() povlaci sve 
        // where() je kao WHERE u SQL
        // get() sa njim dobijamo celu kolekciju
        // first() sa njim dobijamo prvi model koji mozemo da obrisemo
        $posts = Post::withTrashed()->where('id', $id)->first();

        // forceDelete() za brisanje skroz (i iz baze)
        $posts->forceDelete();

        Session::flash('success', 'You sucessfuly permanently deleted a post!');

        return redirect()->back();
        // dd($posts);
     
    }

    // Restore Post
    public function restore($id){

        $post = Post::withTrashed()->where('id', $id)->first();

        $post->restore();

        Session::flash('success', 'You sucessfuly restored a post!');

        return redirect()->route('posts');

    }
}
