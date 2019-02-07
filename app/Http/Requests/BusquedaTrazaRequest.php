<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusquedaTrazaRequest extends BusquedaRequest
{
  
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge( $this->rules, [
            'user_id'=> 'integer|nullable'
        ]);
    }
}
