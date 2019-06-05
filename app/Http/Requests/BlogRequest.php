<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'title'     => 'required|string|max:255',       // 必須・文字列・最大値（255文字まで）
            'content'   => 'required|string|max:10000',     // 必須・文字列・最大値（10000文字まで）
        ];
    }

    public function messages()
    {
        // 表示されるバリデートエラーメッセージを個別に編集したい場合は、ここに追加する
        // 項目名.ルール => メッセージという形式で書く
        // プレースホルダーを使うこともできる
        // 下記の例では :max の部分にそれぞれ設定した値（255, 10000）が入る
        return [
            'title.required'      =>    'タイトルは必須です',
            'title.string'        =>    'タイトルは文字列を入力してください',
            'title.max'           =>    'タイトルは:max文字以内で入力してください',
            'content.required'    =>    '本文は必須です',
            'content.string'      =>    '本文は文字列を入力してください',
            'content.max'         =>    '本文は:max文字以内で入力してください',
        ];
    }
}
