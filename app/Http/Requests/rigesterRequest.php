<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class rigesterRequest extends FormRequest
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
            'name'=>'required|min:6|max:12|unique:user,name',
            'password'=>'required|min:6|confirmed ',
            'phone'=>[
                'required',
                'regex:/18[123569]{1}\d{8}|15[1235689]\d{8}|188\d{8}/',
                'unique:user,phone'
            ]
        ];
    }

    public function messages(){
        return [
            'name.required'=>"用户名不能为空",
            'name.min'=>"用户名最少六个字符",
            'name.max'=>"用户名最多不超过12个字符",
            'name.unique'=>"用户名已存在",
            'password.min'=>"密码不得少于六个字符",
            "password.confirmed"=>"两次密码输入不相同",
            'password.required'=>"密码不能为空",
            'phone.required'=>"请输入手机号",
            "phone.regex"=>'手机号格式不正确',
            "phone.unique"=>'手机号被注册',
        ];
    }
}
