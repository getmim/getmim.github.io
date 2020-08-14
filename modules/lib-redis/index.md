---
layout: post
title:  "Redis"
date:   2016-01-04 01:01:01 +0700
categories: ext-module
---

Library yang menyediakan koneksi dan interaksi dengan db redis.

## instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-redis
```

## konfigurasi

Module ini membutuhkan konfigurasi tambahan pada level aplikasi sebagai berikuta:

```php
return [
    'libRedis' => [
        'default' => [
            // 'socket' => '/tmp/redis.sock',
            'host' => '127.0.0.1',
            'port' => '6379',
            'password' => '',
            'db' => 1,
            // key prefix
            'prefix' => ''
        ]
    ]
];
```

Jika nilai `socket` diisi, maka nilai selain `db` tidak lagi digunakan.

## penggunaan

Semua aktifitas dengan redis dilayani melalu library dengan nama
`LibRedis\Library\Redis`.

```php
use LibRedis\Library\Redis;

Redis::$method($conn, $opts);

// mengambil data 
$data = Redis::get('default', 'data');
```

## method

### getConn(string $name): ?object
### ::$method(string $name, mixed ...$args)

Jika menjalankan perintah yang tidak disediakan oleh library ini, 
maka perintah tersebut akan diteruskan ke objek Redis().

Untuk perintah-perintah yang didukung, silahkan mengacu pada library
[php-redis](https://github.com/phpredis/phpredis).

Sebagai catatan, bahwa parameter peratama semua fungsi adalah
nama koneksi db. Parameter selanjutnya akan diteruskan ke method
dengan nama yang sama ke objek Redis.