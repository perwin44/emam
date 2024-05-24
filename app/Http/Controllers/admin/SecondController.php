<?php

namespace App\Http\Controllers\admin;

//use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller ;

class SecondController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('showString');
    }
    public function showString(){
        return 'static string';
    }
    public function showString1(){
        return 'static string1';
    }
}
