<?php


namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class GetArrDepBoardWithDetValidator extends Formrequest
{
    public function rules()
    {
        return [
            'crs' => 'required',
            'numRows' => 'nullable|integer',
            'filterCrs' => 'nullable',
            'filterType' => 'nullable',
            'timeOffset' => 'nullable|integer',
            'timeWindow' => 'nullnullable|integerable',

        ];
    }


    public function messages()
    {
        return [
            'crs.required' => 'crs is required.',
            'numRows.required' => 'numRows is required.',
            'filterCrs.required' => 'filterCrs is required.',
            'filterType.required' => 'filterType is required.',
            'timeOffset.required' => 'timeOffset is required.',
            'timeWindow.required' => 'timeWindow is required.',

        ];
    }


    public function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'success' => false,
            'message' => 'Validation Errors',
            'error' => $validator->errors(),
        ], 422);

        throw new HttpResponseException($response);
    }
}
