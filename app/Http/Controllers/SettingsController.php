<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use Session;

class SettingsController extends Controller
{
    //
    public function __construct(){

        $this->middleware('admin');
    }

    public function index(){
        
        return view('admin.settings.settings')->with('settings', Setting::first());

    }

    public function update(){

        // dd(request()->all());
        $this->validate(request(), [
            
            'site_name' => 'required',
            'contact_email' => 'required|email',
            'contact_number' => 'required',
            'address' => 'required'
        ]);
        // ne moramo $request da prosledimo kao parametar
        // laravel ima helper method request()
        $settings = Setting::first();

        $settings->site_name = request()->site_name;
        $settings->address = request()->address;
        $settings->contact_email = request()->contact_email;
        $settings->contact_number = request()->contact_number;
        $settings->description = request()->description;
        $settings->street = request()->street;
        $settings->hours = request()->hours;

        $settings->save();

        Session::flash('success', 'Settings updated successfully!');

        return redirect()->back();

    }
}
