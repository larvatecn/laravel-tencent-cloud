<?php

return [
    //公用的 secret_id 和 secret_key
    'secret_id' => env('TENCENT_SECRET_ID'),
    'secret_key' => env('TENCENT_SECRET_KEY'),
    'region' => '',//默认地域

    'drivers' => [
        'api' => [
            'base_url' => '',
            'secret_id' => '',
            'secret_key' => '',
        ],
        'api_gateway' => [
            'secret_id' => env('TENCENT_SECRET_ID'),
            'secret_key' => env('TENCENT_SECRET_KEY'),
        ],
        'cdn' => [
            'secret_id' => env('TENCENT_SECRET_ID'),
            'secret_key' => env('TENCENT_SECRET_KEY'),
        ],
        'cms' => [
            'secret_id' => env('TENCENT_SECRET_ID'),
            'secret_key' => env('TENCENT_SECRET_KEY'),
        ],
        'dns' => [
            'secret_id' => env('TENCENT_SECRET_ID'),
            'secret_key' => env('TENCENT_SECRET_KEY'),
        ],
        'domain' => [
            'secret_id' => env('TENCENT_SECRET_ID'),
            'secret_key' => env('TENCENT_SECRET_KEY')
        ],
        'httpdns' => [
            'secret_id' => env('TENCENT_SECRET_ID'),
            'secret_key' => env('TENCENT_SECRET_KEY')
        ],
        'nlp' => [
            'secret_id' => env('TENCENT_SECRET_ID'),
            'secret_key' => env('TENCENT_SECRET_KEY')
        ],
        //如果对应的服务需要使用不同的 secret_id 和 secret_key，请单独在 drivers 的对应服务中设置，否则将使用默认的。
    ],

];
