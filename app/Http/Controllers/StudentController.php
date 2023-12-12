<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class StudentController extends Controller
{
    public function index()
    {
        // $posts = Post::all();
        // return view('post.createpost', ['posts' => $posts]);
        return Inertia::render("BasicInformation");
    }
    public function create()
    {
        return Inertia::render("Student/AddStudent");
    }
}
