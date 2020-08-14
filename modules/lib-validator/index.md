---
layout: post
title:  "Validator"
date:   2016-01-17 01:01:02 +0700
categories: ext-module
---

Adalah module yang bertugas mem-validasi suatu data. Module ini juga
yang digunakan oleh `lib-form` untuk validasi form.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-validator
```

## Penggunaan

Module ini menyediakan satu library dengan nama `LibValidator\Library\Validator`
yang digunakan untuk mem-validasi data.

```php
use LibValidator\Library\Validator;

$rules = [
    'id' => [
        'rules' => [
            'required' => true
        ],
        'filters' => [
            'number' => true
        ],
        'message' => [
            'required' => 'other_locale_message_key_alternative'
        ]
    ],
    'name' => [
        'rules' => [
            'required' => true,
            'array' => true
        ],
        'children' => [
            'first' => [
                'rules' => [
                    'required' => true,
                    'text' => 'alnum'
                ]
            ],
            'last' => [
                'rules' => [
                    'required' => true,
                    'text' => 'alnum'
                ],
                'filters' => [
                    'string' => true
                ]
            ]
        ]
    ],
    'team' => [
        'rules' => [
            'array' => true
        ],
        'children' => [
            '*' => [
                'rules' => [
                    'array' => true,
                ],
                'children' => [
                    'name' => [
                        'required' => true
                    ]
                ]
            ]
        ]
    ]
];

$object = [
    'id' => '12',
    'name' => [
        'first' => 'Mim',
        'middle' => 'PHP',
        'last' => 'Framework'
    ],
    'team' => [
        ['name' => 'Worker'],
        ['name' => 'cURL']
    ]
];

list($result, $errors) = Validator::validate(objectify($rules), objectify($object));

// $result berisi informasi object setelah melewati validator
// dan filters
// #errors berisi informasi errors masing-masing fields.

```

Pada contoh di atas, masing-masing field memiliki nilai array yang
memiliki array key `rules`. Properti ini berisi daftar rules yang
akan di coba ke nilai nya.

Untuk indexed array, nilai `*` pada `children` property menandakan
rules-rules tersebut di test ke masing-masing data di dalam array
tersebut.

## Test

Jalankan perintah di bawah untuk unit test:

```bash
phpunit test
```