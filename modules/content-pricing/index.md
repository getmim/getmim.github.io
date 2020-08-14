---
layout: post
title:  "Content Pricing"
date:   2017-01-02 01:01:01 +0700
categories: ext-module
---

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install content-pricing
```

## Konfigurasi

Masing-masing object yang akan ditambahkan ke dalam content pricing harus menambahkan formatter
dan enum sebagai berikut:

```php
return [
    'libEnum' => [
        'enums' => [
            'content-pricing.type' => [
                'post' => 'Post'
            ]
        ]
    ],
    'libFormatter' => [
        'formats' => [
            'content-pricing' => [
                'object' => [
                    'cases' => [
                        '/type/' => [
                            'model' => [
                                'name' => '/model-name/',
                                'field' => '/field-name/'
                            ],
                            'format' => '/format-name/'
                        ],
                        'post' => [
                            'model' => [
                                'name' => 'Post\\Model\\Post',
                                'field' => 'id'
                            ],
                            'format' => 'post'
                        ]
                    ]
                ]
            ]
        ]
    ],
    'contentPricing' => [
        'active' => [
            'post' => true
        ],
        'objects' => [
            'post' => [
                'model' => 'Object\\Model\\Object',
                'format' => '/format-name/',
                'fields' => [
                    'id'      => '/id/',      // int
                    'user'    => '/user/',    // object(user)
                    'title'   => '/title/',   // object(text)
                    'created' => '/created/', // object(date)
                    'status'  => '/status/'   // string
                ]
            ]
        ]
    ]
];
```