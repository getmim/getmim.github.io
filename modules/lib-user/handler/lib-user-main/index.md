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
        ],
        'verifier' => [
            'name' => 'Auth\\By\\Otp'
        ]
    ]
];
```

Konfigurasi `login` menentukan properti dari user yang digunakan untuk identifikasi
user. Dengan bentuk seperti di atas, maka user boleh login dengan properti `phone`,
`name`, dan `email`. Secara default, user hanya bisa login menggunakan properti
`name`.

Konfigurasi `verifier` adalah daftar handler yang akan dipanggil untuk verifikasi
password user jika kombinasi identifier dan password gagal. Class handler harus
implement interface `LibUserMain\Iface\Verifier`.
