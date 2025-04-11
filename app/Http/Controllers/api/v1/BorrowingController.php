<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function borrow(Request $request){
        $bookId = $request->bookId;
        $userId = $request->user()->id;

        $borrow = Borrowing::create([
            "book_" => $bookId,
            "user_id" => $userId,
            "borrow_date" => now()
        ]);

        return $userId;
    }
}
