<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest {
    /**
    * Determine if the user is authorized to make this request.
    *
    * @return bool
    */

    public function authorize() {
        return true;
    }

    /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */

    public function rules() {
        return [
            'first_name' => [ 'required' ],
            'last_name' => [ 'required' ],
            'gender' => [ 'required' ],
            'email' => [ 'required', 'email' ],
            'phone1' => [ 'required', 'max:5' ],
            'phone2' => [ 'required', 'max:5' ],
            'phone3' => [ 'required', 'max:5' ],
            'address' => [ 'required' ],
            'building' => [ 'nullable' ],
            'category_id' => [ 'required', 'max:5' ],
            'detail' => [ 'required', 'max:120' ],
        ];
    }

    public function messages() {
        return [
            'first_name.required' => '性を入力してください',
            'last_name.required' => '名を入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスはメール形式を入力してください',
            'phone1.required' => '電話番号を入力してください',
            'phone2.required' => '電話番号を入力してください',
            'phone3.required' => '電話番号を入力してください',
            'phone1.max' => '電話番号は5桁までの数字で入力してください',
            'phone2.max' => '電話番号は5桁までの数字で入力してください',
            'phone3.max' => '電話番号は5桁までの数字で入力してください',
            'address.required' => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を入力してください',
            'detail.required' => 'お問い合わせ内容を入力してください',
            'detail.max' => 'お問い合わせは120文字以内で入力してください',
        ];
    }
}
