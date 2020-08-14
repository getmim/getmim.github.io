---
layout: post
title:  "User Main"
date:   2016-01-20 01:01:02 +0700
categories: ext-module lib-user
---

Adalah user provider dari sumber database. Module ini adalah module handler
untuk module `lib-user`.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-user-main
```

## Konfigurasi

Tambahkan konfigurasi seperti di bawah pada aplikasi jika dibutuhkan:

```php
return [
    'libUserMain' => [
        'login' => [
            'by' => [
                'phone' => true,
                'name'  => true,
                'email' => true
            ]
        ]
    ]
];
```

Bentuk konfigurasi seperti di atas menentukan properti apa dari user yang di perbolehkan
login dengan. Dengan bentuk seperti di atas, user boleh login dengan properti `phone`, `name`,
dan `email`. Pastikan properti tersebut sudah ada pada tabel `user`. Sercara default, user
bisa login hanya dengan properti `name`.