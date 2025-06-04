<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        // $movies = Movie::latest()->paginate(6);
        // return view('movies.home_page', compact('movies'));

        $query = Movie::with('category');

        // Filter berdasarkan search keyword
        if ($request->has('search') && !empty($request->search)) {
            $query->where('title', 'LIKE', '%' . $request->search . '%');
        }

        $movies = $query->latest()->paginate(6)->withQueryString(); // supaya pagination bawa search

        return view('movies.home_page', compact('movies'));
    }

    public function show($id)
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
            'title' => ['required', 'string', 'max:255'],
            'synopsis' => ['required', 'string'],
            'year' => ['required', 'integer', 'min:1900', 'max:' . date('Y')],
            'actors' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'cover_image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
        ]);

        //handle upload gambar
        $imageName = time() . '.' . $request->cover_image->extension();
        $request->cover_image->move(public_path('images'), $imageName);

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

        return redirect('/')->with('success', 'Movie berhasil ditambahkan');
    }

    public function data_movie()
    {
        $movies = Movie::with('category')->latest()->paginate(10);
        return view('movies.data_movie', compact('movies'));
    }


    public function destroy($id)
    {
        if (Gate::allows('delete-movie')) {
            $movies = Movie::findOrFail($id);
            $movies->delete();

            return redirect('/movie')->with('success', 'berhasil menghapus data');
        }
        abort(403);
    }

    public function edit($id)
    {
        $movies = Movie::findOrFail($id);
        $categories = Category::all();
        return view('movies.edit_movie', compact('movies', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate(
            [
                'title' => ['required', 'string', 'max:255'],
                'synopsis' => ['required', 'string'],
                'year' => ['required', 'integer', 'min:1900', 'max:' . date('Y')],
                'actors' => ['required', 'string', 'max:255'],
                'category_id' => ['required', 'exists:categories,id'],
                'cover_image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],

            ]

        );

        $movie = Movie::findOrFail($id);

        if ($request->hasFile('cover_image')) {
            $imageName = time() . '.' . $request->cover_image->extension();
            $request->cover_image->move(public_path('images'), $imageName);
            $movie->cover_image = $imageName;
        }

        $movie->update([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'synopsis' => $validated['synopsis'],
            'year' => $validated['year'],
            'actors' => $validated['actors'],
            'category_id' => $validated['category_id'],

        ]);

        return redirect('/movie')->with('success', 'Berhasil mengubah data');
    }

    public function detail($id)
    {
        $movie = Movie::with('category')->findOrFail($id);

        // Return partial untuk AJAX
        return view('movies.detail-content', compact('movie'));
    }
}
