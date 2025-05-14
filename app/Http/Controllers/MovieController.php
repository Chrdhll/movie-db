<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::latest()->paginate(6); // atau sesuai kebutuhan
        return view('movies.home_page', compact('movies'));
    }

    public function show ($id)
    {
        $movie = Movie::find($id);
        return view('movies.show', compact('movie'));
    }
}
