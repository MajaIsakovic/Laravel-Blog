<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Profile;
use Session;

class UsersController extends Controller
{
    public function __construct(){
        
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.users.index')->with('users', User::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.users.create');
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
            
            'name' => 'required',
            'email' => 'required|email'
        ]);
        
        $user = new User;
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt('password');


        $user->save();


        // pre ovoga moramo da stavimo ->nullable() u _create_profiles_table
        // samo je ovaj user_id vazan ostale smo stavili na nullable() znaci that the column allows NULL values
        $profile = Profile::create([

            'user_id' => $user->id,
            // Deafaultna avatar slika
            'avatar' => 'uploads/avatars/defaultavatar.png'
        ]);

        Session::flash('success', 'User added sucessfully!');

        return redirect()->route('users');
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
        $user = User::find($id);

        $user->delete();
        $user->profile->delete();

        Session::flash('success', 'User deleted succesfully!');
        
        return redirect()->back();


    }

    public function admin($id){

        $user = User::find($id);

        $user->admin = 1;

        $user->save();

        Session::flash('success', 'You sucessfully changed users permisions!');

        return redirect()->back();

    }

    public function not_admin($id){

        $user = User::find($id);

        $user->admin = 0;

        $user->save();

        Session::flash('success', 'You sucessfully changed users permisions to Administrator!');

        return redirect()->back();

    }

}
