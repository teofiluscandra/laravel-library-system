<?php

namespace App\Http\Requests;

class UpdateBookRequest extends StoreBookRequest
{
    public function rules()
    {
        $rules = parent::rules();
        $rules['kode_buku'] = 'required|unique:books,kode_buku,' . $this->route('book');
        $rules['title'] = 'required|unique:books,title,' . $this->route('book');
        $rules['amount'] = 'required | numeric';
        return $rules;
    }
}

