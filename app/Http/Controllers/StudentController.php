<?php

namespace App\Http\Controllers;
use App\Model\student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
        function insert(){
             student::create([
        'name'=>'lucky',
        'email'=>'lucky@gmail.com',
        'password'=>12346
     ]);
        }
    
}
