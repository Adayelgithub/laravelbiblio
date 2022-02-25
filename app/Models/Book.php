<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;


    protected $fillable = ['isbn','nombre','author','publisher','available','category_id'];
    protected $table = "books";

    public function  category(){
        return $this->belongsTo(Category::class);
    }

    public function  loan(){
        return $this->belongsTo(Loan::class);
    }
}
