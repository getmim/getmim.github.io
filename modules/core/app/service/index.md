---
layout: post
title:  "Service"
date:   2015-01-06 07:44:45 +0700
categories: aplikasi
---

Service adalah php class yang harus extends dari `\Mim\Service` dan akan
digunakan setelah membuat object baru dengan perintah `new`. Pada umumnya
service dipanggil dari kontroler, service lain, dan middleware dengan
perintah `$this->$service` dimana `$service` adalah nama service seperti
yang didaftarkan di konfigurasi.

## Konfigurasi

Biasanya, konfigurasi service didaftarkan di konfigurasi module. Walaupun
tetap konfigurasi tersebut bisa saja dibuat di konfigurasi aplikasi.

Contoh di bawah adalah contoh umum untuk mendaftarkan service public dan private:

```php
// ./modules/[name]/config.php

return [
    // ...
    
    'service' => [
        // format
        $name => $Class,
        $namespace => $Class,
        
        // contoh
        'cache' => 'Cache\\Service',
        'req' => 'Http\\Request',
        'admin/can_i' => 'Admin\\Library\\CanI'
    ]
    
    // ...
];
```

Dengan konfigurasi seperti di atas, maka service `cache` akan dibuat dengan
perintah `new Cache\\Service`, yang kemudian bisa diakses dari kontroler,
service, middleware dengan perintah `$this->cache`.

Mungkin juga menambahkan namespace yang hanya digunakan jika service dengan nama
tersebut belum pernah di daftarkan. Seperti contoh di atas, service `admin/can_i`
hanya akan digunakan jika service dengan nama `can_i` belum terdaftar di aplikasi.
Tapi jika sudah pernah di daftarkan, maka nilai tersebut tidak digunakan.