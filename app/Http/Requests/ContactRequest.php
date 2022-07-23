<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=> 'required|max:55',
            'email' => 'required|email',
            'title' => 'required|min:6|max:255',
            'content' => 'required|min:6|max:2000'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên của bạn không được để trống',
            'name.max' => 'Tên của bạn không được quá 55 kí tự',
            'email.required' => 'Email của bạn không được để trống',
            'email.email' => 'Email phải đúng định dạng',
            'title.required' => 'Tiêu đề của bạn không được để trống',
            'title.min' => 'Tên của bạn không được nhỏ hơn 6 kí tự',
            'title.max' => 'Tên của bạn không được quá 55 kí tự',
            'content.required' => 'Nội dung của bạn không được để trống',
            'content.min' => 'Tên của bạn không được nhỏ hơn 6 kí tự',
            'content.max' => 'Tên của bạn không được quá 2000 kí tự',

        ];
    }
}
