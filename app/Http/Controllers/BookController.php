<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BookController extends Controller
{
    function store()
    {
       Book::create($this -> validateRequest());
    }
    function update(BOOK $book)
    {
        $book -> update($this -> validateRequest()) ;
    }

    function validateRequest()
    {
        return request()->validate([
            'title' => 'required',
            'author' => 'required',
        ]);
    }

}
