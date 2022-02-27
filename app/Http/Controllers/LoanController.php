<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Fine;
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
        if(@\Illuminate\Support\Facades\Auth::user()->hasRole('admin')){
            $records = Loan::all();
            foreach ($records as $loan){
                $current_date = date("Y-m-d H:i:s");
                $scheduled_returned_date = $loan->scheduled_returned_date;
                $current_dateDateTime = new \DateTime($current_date);
                $scheduled_returned_date_dateDateTime = new \DateTime($scheduled_returned_date);
                if($current_dateDateTime > $scheduled_returned_date_dateDateTime ){
                    $interval = $current_dateDateTime->diff($scheduled_returned_date_dateDateTime);
                    if($loan->loan_date != null && $loan->returned_date == null){
                        $loan->update(['overdue_days' => $interval->days ]);
                    }
                }
            }

            $fines = Fine::all();
            $books = Book::all();
            $users = User::all();
            return view('loan.index', compact('records','books','users', 'fines'));
        }
        return redirect()->route('books.index')->with('error','No tienes permisos');

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
        $input_date = new \DateTime($input['scheduled_returned_date']);
        $input_date->modify('+23 hours');
        $input_date->modify('+55 minutes');
        $input['scheduled_returned_date'] = $input_date;
        //$input += (['scheduled_returned_date' => $current_date ]);
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
        if(@Auth::user()->id == $user ){
            $books = Book::all();
            $loans = Loan::all();
            return view('loan.show',compact('user','loans','books'));
        }

        return redirect()->route('books.index')->with('error','No tienes permiso');
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


            $loans = Loan::all();
            foreach ($loans as $loan){
                if($loan->book_id == $book_id && $loan->loan_date == null){
                    $loan->delete();
                }
            }





        return redirect()->route('loans.index')->with('success','Préstamo realizado con éxito');
        } else {


            $book_id = Loan::all()->find($id)->book->id;

            $payment = Book::findOrFail($book_id);
            $payment->available = 1;
            $payment->saveOrFail();

            $loan = Loan::all()->find($id);

            $current_date = date("Y-m-d H:i:s");
            $loan->update(['returned_date' => $current_date ]);

            $scheduled_returned_date = Loan::all()->find($id)->scheduled_returned_date;
            $current_dateDateTime = new \DateTime($current_date);
            $scheduled_returned_date_dateDateTime = new \DateTime($scheduled_returned_date);

            if($current_dateDateTime > $scheduled_returned_date_dateDateTime ){
                $interval = $current_dateDateTime->diff($scheduled_returned_date_dateDateTime);
                $loan->update(['overdue_days' => $interval->days ]);


                $user_id = @Auth::user()->id;
                $fecha_fin_penalizacion = date('Y-m-d H:i:s', strtotime($current_date.' + '.$loan->overdue_days.'days'));

                Fine::create(['user_id' => $user_id ,'loan_id' => $loan->id,
                    'fine_end_date' => $fecha_fin_penalizacion , 'fine_active' => true, ]);

            }

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
        if(@\Illuminate\Support\Facades\Auth::user()->hasRole('admin')){
            try {
                $loan->delete();
            } catch (\Exception $e){
                return redirect()->route('loans.index')
                    ->with('error','No se puede borrar el préstamo ID: ' . $loan->id.' existe una penalización con este préstamo');
            }
            return redirect()->route('loans.index')
                ->with('success','Préstamo rechazado con éxito');
        }
        return redirect()->route('books.index')->with('error','No tienes permisos');


    }
}
