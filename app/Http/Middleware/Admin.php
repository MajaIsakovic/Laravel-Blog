<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //znaci 1. napravimo midleware preko php artisan make:midleware
        //2. napravimo ovaj uslov ovde
        // 3. registrujemo midleware u Kernel.php fajlu
        //4. odemo u web.php i vezemo middleware('admin'); metod za user/admin rutu na kraju - bolje ne (ne radi u oba pravca)
        // ili!: u UsersControleru napravimo konstruktor i stavimo middleware u njega
        //  public function __construct(){ 
        //     $this->middleware('admin');
        // }

         // ! Proverimo da li autentifikovani user ima access za odredjenu rutu
        //ako nema, vratimo ga odakle je dosao
        if(Auth::user()->admin){
        
            return $next($request);

        } else{
                
            Session::flash('info', 'You do not have permissions to acces!');

            return redirect()->back();
        }

       
    }
}
