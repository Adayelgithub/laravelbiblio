<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'loan_id','fine_start_date','fine_end_date','fine_active','observations'];
    protected $table = "fines";

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function loan(){
        return $this->belongsTo(Loan::class);
    }

}
