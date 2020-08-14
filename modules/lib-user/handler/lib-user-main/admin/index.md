---
layout: post
title:  "Admin User"
date:   2016-01-20 01:01:01 +0700
categories: ext-module user admin
---

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install admin-user
```

Sebagai catatan, module ini hanya cocok untuk user handler [lib-user-main](https://github.com/getmim/lib-user-main).

## Injeksi

### Create

Jika ingin menambah form field pada editor create user, tambahkan rule field tersebut pada form `admin.user.create`.
Dengan tambahan property `position` untuk menentukan bagian mana field tersebut akan ditampilkan. Nilai `position` yang
diketahui sampai saat ini adalah `left`, `center`, dan `right`.

```php
return [
    'libForm' => [
        'forms' => [
            'admin.user.create' => [
                '/field/' => [
                    // ...
                    'position' => 'left|center|right',
                    // ...
                ]
            ]
        ]
    ]
];
```

### General

Untuk profile editor form `admin.user.account`, tambahkan rule-rule dengan tambahan property `position` yang menerima
nilai `top-left`, `top-center`, `top-right`, `middle`, `bottom-left` dan `bottom-right`.

Struktur yang sama juga berlaku untuk profile editor dengan form name `admin.user.profile`.