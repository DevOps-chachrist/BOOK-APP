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
        "borrow_date",
        "return_date"
    ];
}
