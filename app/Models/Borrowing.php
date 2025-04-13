<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    //public $quarded = [];
    protected $fillable = [
        "book_id",
        "user_id",
        "status",
        "borrow_date",
        "return_date"
    ];

    function book(){
        return $this->belongsTo(Book::class);
    }

    function user(){
        return $this->belongsTo(User::class);
    }
}
