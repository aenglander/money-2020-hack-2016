<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PerformerFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'card_number' => 'required',
            'address_1' => 'required',
            'address_2' => 'required',
            'state' => 'required',
            'postal_code' => 'required',
            'exp_year' => 'required',
            'exp_month' => 'required',
        ];
    }
}
