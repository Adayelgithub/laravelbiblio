<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Unique;
use mysql_xdevapi\Exception;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Category::all();


        return view('category.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(@Auth::user()->hasRole('admin')){
            return view('category.create');
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
            $request->validate([
                'nombre' => 'required|unique:categories,nombre',
            ]);
            $input = $request->all();

            Category::create($input);

            return redirect()->route('categories.index')->with('success','Categoría añadida con éxito.');
        }
        return redirect()->route('books.index')->with('error','No tienes permisos');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $books = Book::all();
        return view('category.show',compact('category' ,'books'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if(@Auth::user()->hasRole('admin')){
            return view('category.edit',compact('category'));
        }
        return redirect()->route('books.index')->with('error','No tienes permisos');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {

        if(@Auth::user()->hasRole('admin')){
            $request->validate([
                'nombre' => 'required|unique:categories,nombre',
            ]);
            $input = $request->all();

            $category->update($input);
            return redirect()->route('categories.index')->with('success','Categoría editada con éxito');
        }
        return redirect()->route('books.index')->with('error','No tienes permisos');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if(@Auth::user()->hasRole('admin')){
            try {
                $category->delete();
            } catch (\Exception $e){
                return redirect()->route('categories.index')
                    ->with('error','Error, existen libros con la categoría seleccionada');
            }
            return redirect()->route('categories.index')
                ->with('success','Categoría eliminada con éxito');
        }

        return redirect()->route('books.index')->with('error','No tienes permisos');




    }
}
