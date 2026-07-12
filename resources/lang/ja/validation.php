<?php

return [
    'required' => ':attributeを入力してください。',
    'email' => ':attributeはメール形式で入力してください。',
    'enum' => '選択した値は有効な選択肢ではありません。', // ← これを追加！

    'attributes' => [
        'email' => 'メールアドレス',
        'password' => 'パスワード',
    ],

    'custom' => [
        'priority' => [
            'enum' => '入力した優先度は存在しません',
        ],
    ],
];