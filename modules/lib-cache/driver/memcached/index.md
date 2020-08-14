---
layout: post
title:  "Cache Data Memcached"
date:   2016-01-03 01:01:03 +0700
categories: ext-module lib-cache
---

Adalah add-on untuk module `lib-cache` untuk memungkinkan penggunaan
memcached sebagai data penyimpanan cache. Module ini membutuhkan module
`lib-memcached` dan `lib-cache` terinstall.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-cache-memcached
```
## penggunaan

Dikarenakan module ini adalah module addons untuk `lib-cache`, maka penggunaan
pada kontroler tidak berbeda sama sekali dengan `lib-cache`.

Pastikan men-set konfigurasi aplikasi seperti di bawah agar `lib-cache` menggunakan
library ini sebagai storage cache handler.

```php
    ...,
    'libCache' => [
        'driver' => 'memcached'
    ]
    ...,
```

Pastikan juga terdapat koneksi memcached di konfigurasi aplikasi dengan nama `cache`:

```php
return [
    'libMemcached' => [
        'cache' => [
            'host' => '127.0.0.1',
            'port' => '11211'
        ]
    ]
];
```