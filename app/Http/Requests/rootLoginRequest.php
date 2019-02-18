<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class rootLoginRequest extends FormRequest
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
            'name'=>'required|min:3|max:12',
            'password'=>'required|min:6 ',
        ];
    }
    public function messages(){
        return [
            'name.required'=>"用户名不能为空",
            'name.min'=>"用户名最少3个字符",
            'name.max'=>"用户名最多不超过12个字符",
            'password.min'=>"密码不得少于六个字符",
            'password.required'=>"密码不能为空"
        ];
    }
}
