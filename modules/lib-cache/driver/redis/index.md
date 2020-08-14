---
layout: post
title:  "Cache Data Redis"
date:   2016-01-03 01:01:02 +0700
categories: ext-module lib-cache
---

Adalah add-on untuk module `lib-cache` untuk memungkinkan penggunaan
redis sebagai data penyimpanan cache. Module ini membutuhkan module
`lib-redis` dan `lib-cache` terinstall.

## instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-cache-redis
```

## penggunaan

Dikarenakan module ini adalah module addons untuk `lib-cache`, maka penggunaan
pada kontroler tidak berbeda sama sekali dengan `lib-cache`.

Pastikan men-set konfigurasi aplikasi seperti di bawah agar `lib-cache` menggunakan
library ini sebagai storage cache handler.

```php
    ...,
    'libCache' => [
        'driver' => 'redis'
    ]
    ...,
```

Pastikan juga terdapat koneksi redis di konfigurasi aplikasi dengan nama `cache`:

```php
return [
    'libRedis' => [
        'cache' => [
            // 'socket' => '/tmp/redis.sock',
            'host' => '127.0.0.1',
            'port' => '6379',
            'password' => '',
            'db' => 2,
            // key prefix
            'prefix' => ''
        ]
    ]
];
```

## Penting

Walaupun cache dengan redis terkesan sangat cepat ( karena mindset dari yang sudah-sudah ),
bukan berarti kondisi seperti ini berlaku di framework mim. Perlu diketahui bahwa speed cache
build-in dibuat dengan mengedepankan speed sehingga sangat optimize. Di bawah ini adalah
perbandingan ab test antara cache dengan driver file ( build-in `lib-cache` ) dengan cache
dengan media penyimpanan redis:

```
ab -n2000 -c100 http://site.mim/
```

Info                             | File    | Redis   | Redis (pconnect)
---------------------------------|---------|---------|-----------------
Time taken for tests ( seconds ) | 0.273   | 0.390   | 0.339
Requests per second ( [#/sec] )  | 7331.27 | 5127.71 | 5894.25
Time per request ( [ms] )        | 13.640  | 19.502  | 16.966
Transfer rate ( [Kbytes/sec] )   | 1081.08 | 756.14  | 869.17

Perhatikan bahwa walaupun redis menggunakan persistant connection, masih tetap
tidak bisa melewati kecepatan cache dengan file. Kondisi terakhir yang perlu
dipertimbangkan adalah I/O server.