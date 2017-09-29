<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => 'required',
            'title'     => 'required|unique:books,title',
            'author_id' => 'required|exists:authors,id',
            'tahun_terbit'    => 'required|numeric',
            'amount'    => 'required|numeric',
            'penerbit' => 'required',
            'no_rak' => 'required'
        ];
    }
}
