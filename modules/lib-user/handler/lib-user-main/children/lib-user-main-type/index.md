---
layout: post
title:  "User Main Type"
date:   2016-01-20 01:01:02 +0700
categories: lib-user lib-user-main
---

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-user-main-type
```

## Konfigurasi

Tambahkan konfigurasi seperti di bawah pada aplikasi untuk menentukan
daftar type akun user yang didukung:

```php
return [
    'libEnum' => [
        'enums' => [
            'user.type' => [
                1 => 'General',
                2 => 'Special',
                3 => 'Other Special'
            ]
        ]
    ]
];
```