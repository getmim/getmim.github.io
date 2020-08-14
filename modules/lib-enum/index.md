---
layout: post
title:  "Enum"
date:   2016-01-21 01:01:01 +0700
categories: ext-module
---

Adalah penyedia dan pembuat object enum. Library ini biasanya digunakan
pada form, dan formatter.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-enum
```

## Konfigurasi

Semua enum disimpan di konfigurasi aplikasi/module dengan bentuk seperti
di bawah:

```php
return [
    // ...
    'libEnum' => [
        'enums' => [
            '/enum-name/' => [
                '/enum-value/' => '/enum-label/',
                // ...
            ]
        ]
    ],
    // ...
];
```

## Penggunaan

Module ini membuat library `LibEnum\Library\Enum` yang bisa digunakan
untuk membentuk object enum dengan cara seperti di bawah:

```
use LibEnum\Library\Enum;

$enum = new Enum('enum-name', 'current-value');
echo $enum->value; // 'current-value'
echo $enum->label; // 'enum-label'
echo $enum; // 'enum-label';
echo json_encode($enum); // {"value": "current-value", "label": "enum-label"}
$options = $enum->options;
```

Untuk mendapatkan options suatu object, bisa juga menggunakan static method
dari class di atas dengan method `getOptions(string $name)`

## Formatter

Jika module `lib-formatter` terpasang, module ini menambah dua format type,
yaitu:

### enum

Mengubah nilai menjadi object enum.

```php
'field' => [
    'type' => 'enum',
    'enum' => 'enum-name',
    'vtype' => 'int' // optional
]
```

### multiple-enum

Mengubah nilai menjadi beberapa object enum.

```php
'field' => [
    'type' => 'multiple-enum',
    'separator' => ',', // json
    'enum' => 'enum-name',
    'vtype' => 'str' // optional
]
```

Properti `vtype` diatas memastikan type `value` akan dikonversi menjadi type
yang disebutkan. Nilai yang diterima adalah `int` dan `str`.

Nilai separator juga bisa menerima nilai `json` untuk menggunakan fungsi `json_decode`
sebagai pemisah nilai. Selain itu, fungsi `explode` akan digunakan.

## Validator

Jika module `lib-validator` terpasang, maka module ini mendaftarkan tipe validasi seperti di bawah:

### enum

```php
// ...
    'field' => [
        'rules' => [
            'required' => true,
            'enum' => 'enum-key'
        ]
    ]
// ...
```

Memastikan nilai yang dikirimkan oleh user adalah salah satu dari yang di daftarkan pada suatu enum.