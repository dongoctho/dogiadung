<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAccountFormRequest extends FormRequest
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
            'name' => ['required'],
            'birthday' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'phone' => ['required', 'min:10', 'numeric'],
            'password' => ['required', 'min:8'],
            'repassword' => ['required'],
            'phone' => ['required', 'min:10'],
            'country' => ['required'],
            'city' => ['required'],
            'ward' => ['required'],
            'avatar' => ['required'],
            'homenumber' => ['required', 'numeric'],
        ];

    }

    public function messages()
    {
        return [
            'email.required' => 'Không được bỏ trống ô này',
            'email.unique' => 'Email đã tồn tại',
            'email.email' => 'Nhập đúng định dạng ...@gmail.com',
            'password.required' => 'Không được bỏ trống ô này',
            'password.min' => 'Mật khẩu không được nhỏ hơn 8 ký tự',
            'name.required' => 'Không được bỏ trống ô này',
            'repassword.required' => 'Không được bỏ trống ô này',
            'phone.required' => 'Không được bỏ trống ô này',
            'phone.min' => 'Số điện thoại không được nhỏ hon 10 ký tự',
            'country.required' => 'Không được để trống ô này',
            'city.required' => 'Không được để trống ô này',
            'ward.required' => 'Không được để trống ô này',
            'homenumber.required' => 'Không được để trống ô này',
            'birthday.required' => 'Không được để trống ô này',
            'avatar.required' => 'Không được để trống ô này',
            'homenumber.numeric' => 'Yêu cầu nhập số',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $data = $validator->getData();

            if ($data['phone'] <= 0) {
                $validator->errors()->add('phone', 'Yêu cầu nhập số lớn hơn 0 !!!');
            }
            if ($data['homenumber'] <= 0) {
                $validator->errors()->add('homenumber', 'Yêu cầu nhập số lớn hơn 0 !!!');
            }
        });
    }
}