<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class UserRegisterRequest extends FormRequest
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
            'email'        =>  'unique:users|required|string|email|max:255|unique:users,email',
            'firstname'    =>  'required|string|max:300',
            'lastname'     =>  'required|string|max:300',
            'password'     =>  'required|required_with:password_confirmation|same:confirm|string|min:8',
            'confirm'      =>  'required|string|min:8',
            'gender'       =>  'required|size:1',
            'country_code' =>  'required|size:5'
            'language_code'=>  'required|size:5'
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        if($this->wantsJson())
        {
            $response = response()->json([
                'error' => true,
                'message' => $validator->errors()->first()
            ]);            
        }else{
            $response = redirect()
                ->route('guest.login')
                ->with('message', 'Ops! Some errors occurred')
                ->withErrors($validator);
        }
        
        throw (new ValidationException($validator, $response))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}