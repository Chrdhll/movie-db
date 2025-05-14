<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::paginate(6); // atau sesuai kebutuhan
        return view('movies.home_page', compact('movies'));
    }
}
