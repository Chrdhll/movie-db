<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Category;
use Illuminate\Support\Str;
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
    
    public function create()
    {
        $categories = Category::all();
        return view('movies.form', compact('categories'));
    }

    public function store(Request $request)
    {
        //ambil inputan dari form movie
        $validatedData = $request->validate([
            'title' => ['required','string','max:255'],
            'synopsis' => ['required','string'],
            'year' => ['required'],
            'actors' => ['required','string','max:255'],
            'category_id' => ['required','exists:categories,id'],
            'cover_image' => ['required','image'],
        ]);
        
        //handle upload gambar
        $imageName = time() . '.' . $request->cover_image->extension();
        $request->cover_image->move(public_path('images'),$imageName);

        //simpan ke DB
        Movie::create([
            'title' => $validatedData['title'],
            'slug' => Str::slug($validatedData['title']),
            'synopsis' => $validatedData['synopsis'],
            'year' => $validatedData['year'],
            'actors' => $validatedData['actors'],
            'category_id' => $validatedData['category_id'],
            'cover_image' => $imageName,
        ]);

        return redirect('/')->with('success','Movie berhasil ditambahkan');
    }
}
