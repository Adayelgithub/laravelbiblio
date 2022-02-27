<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Fine;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(@\Illuminate\Support\Facades\Auth::user()->hasRole('admin')){
            $records = Fine::all();
            $current_date = date("Y-m-d H:i:s");
            foreach ($records as $fine){
                $current_dateDateTime = new \DateTime($current_date);
                $fine_end_date_DateTime = new \DateTime($fine->fine_end_date);
                if($current_dateDateTime > $fine_end_date_DateTime ){
                    //$fine->fine_active = 0;
                    $payment = Fine::findOrFail($fine->id);
                    $payment->fine_active = 0;
                    $payment->saveOrFail();

                }
            }

            $records = Fine::all();
            $loans = Loan::all();
            $users = User::all();

            return view('fine.index', compact('records', 'users' , 'loans'));
        }
        return redirect()->route('books.index')->with('error','No tienes permisos');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $loans = Loan::all();
        $users = User::all();
        return view('fine.create',compact('loans','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        Fine::create($input);

        return redirect()->route('fines.index')->with('success','Penalización añadida con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fine  $fine
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        if(@Auth::user()->id == $user ){
            $books = Book::all();
            $fines = Fine::all();
            $loans = Loan::all();
            return view('fine.show',compact('user','fines','books','loans'));
        }

        return redirect()->route('books.index')->with('error','No tienes permiso');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fine  $fine
     * @return \Illuminate\Http\Response
     */
    public function edit(Fine $fine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fine  $fine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fine $fine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fine  $fine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fine $fine)
    {

        if(@\Illuminate\Support\Facades\Auth::user()->hasRole('admin')){
            $fine->delete();
            return redirect()->route('fines.index')
                ->with('success','Penalización eliminada con éxito');
        }

        return redirect()->route('books.index')->with('error','No tienes permisos');
    }
}
