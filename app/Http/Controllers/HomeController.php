<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\laptop;
use DB;
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function logout()
    {
        Auth::logout();
        return redirect(url('/home'));// 重定向到您希望的页面
    }
    
    public function see()
    {
        try {
            $latestLaptop = laptop::orderBy('created_at', 'desc')->take(6)->get();
            return view('home', ['latestLaptop' => $latestLaptop]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function index()
    {
        $topLaptops = Laptop::withCount(['reviews as average_rating' => function ($query) {
            $query->select(DB::raw('coalesce(avg(rating),0)'));
        }])->orderBy('average_rating', 'desc')
          ->take(5)
          ->get();

        return view('home', ['topLaptops' => $topLaptops]);
    }

    public function adminHome(){
        return view('adminHome');
    }
//youfu
    public function aboutUs(){
        return view('aboutUs');
    }

    public function contactUs(){
        return view('contactUs');
    }

    public function tutorial(){
        return view('tutorial');
    }

    public function disclaimer(){
        return view('disclaimer');
    }

    public function privacyPolicy(){
        return view('privacyPolicy');
    }
}
