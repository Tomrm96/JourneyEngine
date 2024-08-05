<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class MapsValidator extends FormRequest
{

    public function rules()
    {
        return [
            'origin' => 'required',
            'destination' => 'required',
            'traffic_model' => 'required',
            'departure_time' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'origin.required' => 'the origin is required',
            'destination.required' => 'the destination is requried',
            'traffic_model.required' => 'the traffic model is required',
            'departure_time.required' => 'the departure time is required',
        ];
    }

    public function failedValidation(Validator $validator)
    {

        $response = response()->json([
            'success' => false,
            'message' => 'Validation Errors',
            'errors' => $validator->errors()
        ], 422);

        throw new HttpResponseException($response);
    }
}
