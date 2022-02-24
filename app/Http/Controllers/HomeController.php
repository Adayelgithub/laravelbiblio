<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function search(Request $request){

        //$products = Product::paginate(2);
        //$records = Book::where('nombre' , $request->text)->orWhere('nombre' , 'like' , '%' . $request->text . '%')->paginate(2);
        $records = Book::where('nombre' , $request->text)->orWhere('nombre' , 'like' , '%' . $request->text . '%')->paginate(50);
        return view('book.index' , compact("records"));

    }
}
