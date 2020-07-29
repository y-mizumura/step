<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMission extends FormRequest
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
            'name' => 'required|max:20',
            'category_id' => 'required',
            'color' => 'required',
            'score_unit' => 'required|max:10',
            'memo' => 'max:100',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'ミッション名',
            'category_id' => 'カテゴリ',
            'color' => '色',
            'score_unit' => '単位',
            'memo' => 'メモ',
        ];
    }
}
