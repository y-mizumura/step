<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditStep extends FormRequest
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
            'score' => 'required|numeric|between:0,99999.99',
            'memo' => 'max:20',
        ];
    }

    public function attributes()
    {
        return [
            'score' => 'スコア',
            'memo' => 'メモ',
        ];
    }
}
