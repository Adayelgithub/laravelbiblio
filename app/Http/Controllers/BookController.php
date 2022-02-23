<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Book::all();
        return view('book.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function available()
    {
        $records = Book::all();
        return view('book.available', compact('records'));
    }

    public function create()
    {
        $categories_list = Category::all();
        return view('book.create' , compact('categories_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|min:3|max:255',
            'author' => 'required|min:10|max:4096',
            'publisher' => 'required|min:10|max:4096'
        ]);
        $input = $request->all();

        Book::create($input , ['isbn' => "asd"]);

        return redirect()->route('books.index')->with('success','Libro añadido con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('book.show',compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('book.edit',compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'nombre' => 'required|min:3|max:255',
            'author' => 'required|min:10|max:4096',
            'publisher' => 'required|min:10|max:4096'
        ]);
        $input = $request->all();

        $book->update($input);
        return redirect()->route('books.index')->with('success','Libro editado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')
            ->with('success','Libro eliminado con éxito');
    }
}
