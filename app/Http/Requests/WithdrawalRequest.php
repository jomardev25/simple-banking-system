<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseFormRequest;

class WithdrawalRequest extends BaseFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
       return [
            "account" => "required",
            "amount" => "required"
       ];
    }

    public function attributes()
    {
        return [
            "account" => "account",
            "amount" => "amount"
        ];
    }

    public function filters()
    {
        return [
            "account" =>  "trim|escape|cast:int",
            "amount" =>  "trim|escape|cast:int"
        ];
    }
}