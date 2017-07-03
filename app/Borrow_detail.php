<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Borrow_detail extends Model
{
    protected $fillable = ['borrow_id', 'book_id'];

    public function borrow()
    {
        return $this->belongsTo('App\BorrowLog');
    }

    public function book()
    {
        return $this->belongsTo('App\Book');
    }

}
