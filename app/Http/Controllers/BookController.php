<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Fine;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Book::latest()->paginate(4);
        $loans = Loan::all();
        $fines = Fine::all();

        return view('book.index', compact('records' ,'loans' ,'fines'))
            ->with('i', (request()->input('page', 1) - 1) * 5);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create()
    {
        if(@Auth::user()->hasRole('admin')){
            $categories_list = Category::all();
            return view('book.create' , compact('categories_list'));

        }
        return redirect()->route('books.index')->with('error','No tienes permisos');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if(@Auth::user()->hasRole('admin')){
            $regex = '/^ISBN:(\d{9}(?:\d|X))$/';

            $request->validate([
                'nombre' => 'required|min:3|max:100',
                'author' => 'required|min:5|max:100',
                'publisher' => 'required|min:5|max:100',
                'isbn' => 'required|min:10|max:10'
            ]);
            $input = $request->all();

            Book::create($input);

            return redirect()->route('books.index')->with('success','Libro añadido con éxito.');

        }

        return redirect()->route('books.index')->with('error','No tienes permisos');
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
        if(@Auth::user()->hasRole('admin')){
            $categories_list = Category::all();
            return view('book.edit',compact('book', 'categories_list'));

        }

        return redirect()->route('books.index')->with('error','No tienes permisos');

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
        if(@Auth::user()->hasRole('admin')){
            $request->validate([
                'nombre' => 'required|min:3|max:255',
                'author' => 'required|min:10|max:4096',
                'publisher' => 'required|min:10|max:4096'
            ]);
            $input = $request->all();

            $book->update($input);
            return redirect()->route('books.index')->with('success','Libro editado con éxito');
        }
        return redirect()->route('books.index')->with('error','No tienes permisos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        if(@Auth::user()->hasRole('admin')){
            $book->delete();
            return redirect()->route('books.index')
                ->with('success','Libro eliminado con éxito');
        }
        return redirect()->route('books.index')->with('error','No tienes permisos');

    }
}
