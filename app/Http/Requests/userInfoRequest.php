<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class userInfoRequest extends FormRequest
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
            'nicheng'=>'required|min:4|max:12|unique:user,nicheng',
            'sex'=>'required',
            'year'=>'required',
            'month'=>'required',
            'day'=>'required',
            'province'=>'required',
            'city'=>'required',
            'county'=>'required',
            'headImg'=>'required'
        ];
    }
    public function messages(){
        return [
            'nicheng.required'=>"昵称不能为空",
            'nicheng.min'=>"昵称最少4个字符",
            'nicheng.max'=>"昵称最多不超过12个字符",
            'nicheng.unique'=>"昵称已存在",
            'sex.required'=>'性别不能为空',
            'year.required'=>'年份不能为空',
            'month.required'=>'月份不能为空',
            'day.required'=>'日期不能为空',
            'province.required'=>'省不能为空',
            'city.required'=>'市不能为空',
            'county.required'=>'县不能为空',
            'headImg'=>'required'
        ];
    }
}
