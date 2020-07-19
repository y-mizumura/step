<?php

return [
    'between' => [
        'numeric' => ':attribute は :min〜:max の間で入力してください。',
    ],
    'max' => [
        'string' => ':attribute は :max 文字以内で入力してください。',
    ],
    'required' => ':attribute は必須項目です。',
    'date'     => ':attribute には日付を入力してください。',
    'confirmed'            => ':attribute が確認欄と一致していません。',
    'email'                => ':attribute には有効な形式のメールアドレスを入力してください。',
    'min'                  => [
        'string'  => ':attribute は:min文字以上で入力してください。',
    ],
    'string'               => ':attribute には文字を入力してください。',
    'unique'               => '入力いただいた :attribute はすでに使用されています。',
    'attributes' => [
        'email' => 'メールアドレス',
        'password' => 'パスワード',
        'token' => 'トークン',
    ],
];
