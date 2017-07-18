<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Book extends Model
{
    protected $fillable = ['kode_buku','title', 'author_id', 'amount','tahun_terbit','penerbit','deskripsi'];

    public static function boot()
    {
        parent::boot();

        self::deleting(function($book)
        {
            if ($book->borrowLogs()->count() > 0) {
                Session::flash("flash_notification", [
                    "level"=>"danger",
                    "message"=>"Buku $book->title sudah pernah dipinjam."
                ]);
                return false;
            }
        });
    }

    public function author()
    {
        return $this->belongsTo('App\Author');
    }

    public function borrowLogs()
    {
        return $this->hasMany('App\BorrowLog');
    }

    public function getBorrowedAttribute()
    {
        return $this->amount ;
    }
}
