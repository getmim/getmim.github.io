---
layout: post
title:  "Custom Driver"
date:   2016-01-23 01:01:05 +0700
categories: ext-module lib-model
---

Module `lib-model` tidak bisa bekerja sendiri, dibutuhkan handler yang
akan menghubungkan aplikasi dengan database yang mengimplementasikan
ketentuan dari module ini.

Semua class handler/driver harus mengimplementasikan interface `LibModel\Iface\Driver`.

Selain itu, handler tersebut harus didaftarkan pada konfigurasi module seperti di bawah:

```php
return [
    // ...
    'libModel' => [
        'drivers' => [
            '/driver-name/' => '/Class/',
            'mysql' => 'LibModelMySQL\\Driver\\MySQL'
        ],
        'migratros' => [
            '/migrator-name/' => '/Class/',
            'mysql' => 'LibModelMysql\\Migrator\\MySQL'
        ]
    ]
    // ...
];
```

Setiap kali model digunakan, satu object baru model driver akan dibuat dengan memanggil
perintah sebagai berikut:

```php
$modelDriver = new Driver([
    'model' => 'App\\Model\\Name',
    'table' => 'table_name',
    'chains' => [ ... ],
    'q_field' => [ ... ],
    'connections' => [
        'read' => [ ... ],
        'write' => [ ... ]
    ]
]);
```

Sebagai referensi, silahkan membuka source code module `lib-model-mysql`.