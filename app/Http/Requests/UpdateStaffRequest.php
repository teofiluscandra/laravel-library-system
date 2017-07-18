<?php

namespace App\Http\Requests;

class UpdateStaffRequest extends StoreStaffRequest
{
    public function rules()
    {
        $rules = parent::rules();
        $rules['email'] = 'required|unique:users,email,' . $this->route('staff');
        return $rules;
    }
}

