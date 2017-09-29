<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Book extends Model
{
    protected $fillable = ['kode_buku','title', 'author_id', 'amount','tahun_terbit','penerbit','deskripsi','no_rak','category_id'];

   

    public function author()
    {
        return $this->belongsTo('App\Author');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function borrowDetails()
    {
        return $this->hasMany('App\BorrowDetail');
    }

    public function getBorrowedAttribute()
    {
        return $this->amount ;
    }
}
