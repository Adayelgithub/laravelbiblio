<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

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
        $books = Book::all();
        $users = User::all();
        return view('loan.index', compact('records','books','users'));
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
    public function show($user)
    {
        $books = Book::all();
        $loans = Loan::all();
        return view('loan.show',compact('user','loans','books'));
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

    public function update($id)
    {
        if(@Auth::user()->hasRole('admin')){


        $book_id = Loan::all()->find($id)->book->id;

        $payment = Book::findOrFail($book_id);
        $payment->available = 0;
        $payment->saveOrFail();


        $loan = Loan::all()->find($id);


        $current_date = date("Y-m-d H:i:s");
        $loan->update(['loan_date' => $current_date ]);
        return redirect()->route('loans.index')->with('success','Préstamo realizado con éxito');
        } else {


            $book_id = Loan::all()->find($id)->book->id;

            $payment = Book::findOrFail($book_id);
            $payment->available = 1;
            $payment->saveOrFail();

            $loan = Loan::all()->find($id);

            $current_date = date("Y-m-d H:i:s");
            $loan->update(['returned_date' => $current_date ]);
            return redirect()->route('books.index')->with('success','Libro devuelto con éxito');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        $book_id = Loan::all()->find($loan)->book->id;

        $payment = Book::findOrFail($book_id);
        $payment->available = 1;
        $payment->saveOrFail();

        $loan->delete();
        return redirect()->route('loans.index')
            ->with('success','Préstamo rechazado con éxito');
    }
}
