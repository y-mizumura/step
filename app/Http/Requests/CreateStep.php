<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateStep extends FormRequest
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
            'date' => [
                'required',
                // 複数カラムでのユニークチェック
                Rule::unique('steps')->ignore($this->input('id'))->where(function($query) {
                    $query->where('mission_id', $this->mission->id);
                }),
            ],
            'score' => 'required|numeric|between:0,99999.99',
            'memo' => 'max:20',
        ];
    }

    public function attributes()
    {
        return [
            'date' => '実施日',
            'score' => 'スコア',
            'memo' => 'メモ',
        ];
    }

}
