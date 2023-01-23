<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseFormRequest;

class TransferRequest extends BaseFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
       return [
            "account1" => "required",
            "account2" => "required",
            "amount" => "required"
       ];
    }

    public function attributes()
    {
        return [
            "account1" => "account1",
            "account2" => "account2",
            "amount" => "amount"
        ];
    }

    public function filters()
    {
        return [
            "account1" =>  "trim|escape|cast:int",
            "account2" =>  "trim|escape|cast:int",
            "amount" =>  "trim|escape|cast:int"
        ];
    }
}