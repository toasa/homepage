<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

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
        // 現在実行しているアクション名を取得
        // アクション名により、どのルールを使うのか場合分けをしておく
        $action = $this->getCurrentAction();

        $rules['post'] = [
            'id'         => 'integer|nullable',              // 整数・null でもOK
            'title'      => 'required|string|max:255',       // 必須・文字列・最大値（255文字まで）
            'content'    => 'required|string|max:10000',     // 必須・文字列・最大値（10000文字まで）
        ];

        $rules['delete'] = [
            'id'         => 'required|integer'     // 必須・整数
        ];

        return array_get($rules, $action, []);
    }

    public function messages()
    {
        // 表示されるバリデートエラーメッセージを個別に編集したい場合は、ここに追加する
        // 項目名.ルール => メッセージという形式で書く
        // プレースホルダーを使うこともできる
        // 下記の例では :max の部分にそれぞれ設定した値（255, 10000）が入る
        return [
            'id.integer'          =>    '記事IDは整数でなければなりません',
            'title.required'      =>    'タイトルは必須です',
            'title.string'        =>    'タイトルは文字列を入力してください',
            'title.max'           =>    'タイトルは:max文字以内で入力してください',
            'content.required'    =>    '本文は必須です',
            'content.string'      =>    '本文は文字列を入力してください',
            'content.max'         =>    '本文は:max文字以内で入力してください',
        ];
    }

    // 現在実行中のaction名を取得
    public function getCurrentAction()
    {
        // App\Http\Controllers\AdminBlogController@post のような返り値が返ってくるので @ で分割
        $route_action = Route::currentRouteAction();
        list(, $action) = explode('@', $route_action);
        return $action;
    }
}
