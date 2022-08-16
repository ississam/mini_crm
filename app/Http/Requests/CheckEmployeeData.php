<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckEmployeeData extends FormRequest
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
        $rulesList =  [
            "name" => 'required',
            "password" => 'required',
            "adress" => 'required',
            "tel" => 'required|int',
            "born_date" => 'required|date',
        ];

        return $rulesList;
    }
}
