---
layout: post
title:  "Memcached"
date:   2016-02-05 01:01:01 +0700
categories: ext-module
---

Library yang memudahkan bekerja dengan memcached.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-memcached
```

## konfigurasi

Module ini membutuhkan konfigurasi tambahan pada level aplikasi sebagai berikut:

```php
return [
    'libMemcached' => [
        'default' => [
            'host' => '127.0.0.1',
            'port' => '11211',
            'weight' => 0, // optional
            'auth' => [    // optional
                'name' => 'iqbal',
                'pass' => '12345'
            ]
        ]
    ]
];
```

## penggunaan

Semua aktifitas dengan memcached dilayani melalu library dengan nama
`LibMemcached\Library\Memcached`.

```php
use LibMemcached\Library\Memcached;

Memcached::$method($conn, $opts);

// mengambil data 
$data = Memcached::get('default', 'name');
```

## method

### getConn(string $name): ?object
### ::$method(string $name, mixed ...$args)

Jika menjalankan perintah yang tidak disediakan oleh library ini, 
maka perintah tersebut akan diteruskan ke objek Memcached().

Untuk perintah-perintah yang didukung, silahkan mengacu pada library
[php-memcached](http://php.net/manual/en/book.memcached.php).

Sebagai catatan, bahwa parameter peratama semua fungsi adalah
nama koneksi db. Parameter selanjutnya akan diteruskan ke method
dengan nama yang sama ke objek Memcached.