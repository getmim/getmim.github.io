---
layout: post
title:  "Cache Data Custom Driver"
date:   2016-01-03 01:01:03 +0700
categories: ext-module lib-cache
---

Jika ingin menggunakan custom driver, maka pastikan menambahkan konfigurasi seperti 
di bawah pada konfigurasi module:

```php
    ...,
    'libCache' => [
        'handlers' => [
            'driver-name' => 'HandlerClass'
        ]
    ]
    ...,
```

Kemudian, pada konfigurasi aplikasi, tambahkan konfigurasi seperti di bawah:

```php
    ...,
    'libCache' => [
        'driver' => 'driver-name'
    ]
    ...,
```

Untuk handler cache, pastikan implement interface `LibCache\Iface\Driver`.

Silahkan cek module [lib-cache-redis](https://github.com/getmim/lib-cache-redis)
untuk contoh implementasi class handler cache.