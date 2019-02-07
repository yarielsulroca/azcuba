<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class BusquedaUnidadRequest extends BusquedaRequest
    {
        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules()
        {
            return array_merge( $this->rules, [
                'cai_id'=>'integer|nullable',
                'tipo_id'=>'integer|nullable'
            ]);
        }
    }