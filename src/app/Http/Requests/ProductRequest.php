<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string',
            'price' => 'required|numeric|min:0|max:10000',
            'season' => 'required|array',
            'season.*' => 'in:春,夏、秋、冬',
            'description' => 'required|string|max:120',
            'image' => 'required|image|mimes:png,jpeg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '商品名を入力してください',
            'price.required' => '値段を入力してください',
            'price.numeric' => '数値で入力してください',
            'price.min' => '値段は0円以上で入力してください',
            'price.max' => '値段は10000円以下で入力してください',
            'season.required' => '季節を選択してください',
            'season.array' => '季節を選択してください',
            'season.*.in' => '季節は「春、夏、秋、冬」から選択してください',
            'description.required' => '商品説明を入力してください',
            'description.max' => '商品説明は120文字以内で入力してください',
            'image.required' => '商品画像を登録してください',
            'image.image' => 'アップロードするファイルは画像である必要があります',
            'image.mimes' => '「.png」または「.jpeg」形式でアップロードしてください',
        ];
    }
}
