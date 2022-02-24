<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;


    protected $fillable = ['book_id', 'user_id','loan_date','scheduled_returned_date','returned_date','overdue_days','observations'];
    protected $table = "loans";

    public function user(){
        return $this->belongsTo(User::class);
    }
}
