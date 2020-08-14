---
layout: post
title:  "Site"
date:   2016-01-30 01:01:04 +0700
categories: ext-module
---

Module yang menyediakan standar halaman depan site.

## instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install site
```

Module ini mendefinisikan class `Site\Controller` untuk digunakan
oleh semua module yang menggunakan gate `site`. Untuk dukungan output,
perlu juga menginstall module `lib-view`.

Untuk dukungan output cache, perlu juga memasang module `lib-cache-output`.

Module ini membuat satu gate dengan nama `site` dengan `host` adalah `HOST`, 
dan `path` adalah `/`.

## Konfigurasi

Jika module `lib-robot` terpasang, maka module bisa mendaftarkan link untuk
ditambahkan ke daftar link rss feed dan sitemap global dengan menambahkan
konfigurasi seperti di bawah:

```php
return [
    'site' => [
        'robot' => [
            'feed' => [
                'Class::method' => true
            ],
            'sitemap' => [
                'Class::method' => true
            ]
        ]
    ]
];
```

Method `Class::method` harus mengembalikan nilai array sesuai dengan struktur
rss/sitemap pada lib-robot.