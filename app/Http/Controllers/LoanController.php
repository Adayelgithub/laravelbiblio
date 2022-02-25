<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Loan::all();


        return view('loan.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $books = Book::all();
        return view('loan.create',compact('books'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $current_date = date('Y-m-d', strtotime("now"));
        $end_date = date('Y-m-d', strtotime(' +6 day'));
        $request->validate([
            'scheduled_returned_date' => 'required|date_format:Y-m-d|date|before:'.$end_date.'|date|after:'.$current_date,
            'observations' => 'required|min:10|max:100',
        ]);
        //$input = ['scheduled_returned_date' =>  strtotime($request['scheduled_returned_date'])];
        //$input = ['book_id' => $book->nombre , 'user_id' => $user->name];
        $input = $request->all();

        Loan::create($input);

        return redirect()->route('books.index')->with('success','Solicitud de préstamos añadida con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function edit(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loan $loan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        //
    }
}
