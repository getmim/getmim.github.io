---
layout: post
title:  "Action Log"
date:   2016-01-20 01:01:01 +0700
categories: ext-module
---

Adalah module untuk menyimpan informasi log perubahan object pada aplikasi.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-action-log
```

## Penggunaan

Module ini menambah satu library dengan nama `LibActionLog\Library\Logger` yang memiliki
static method `create`.

### create(array $data): bool

Contoh cara menambahkan satu log adalah sebagai berikut:

```php
use LibActionLog\Library\Logger;

$data = [
    'user' => 1,
    'object' => 1,
    'parent' => 1,
    'method' => 2,
    'type' => 1,
    'original' => (object)[
        'id' => 2,
        'name' => 'user-name',
        'fullname' => 'User Full Name',
        'password' => 'abc',
        'updated' => date('Y-m-d H:i:s'),
        'created' => date('Y-m-d H:i:s')
    ],
    'changes' => (object)[
        'name' => 'new-name',
        'fullname' => 'New User Fullname',
        'password' => 'abc'
    ]
];

if(!Logger::create($data))
    deb( Logger::lastError() );
```

Parameter `$data` fungsi `create` adalah sebagai berikut:

1. `user`  
   Informasi user id yang melakukan perubahan
1. `object`  
   Object id yang berubah/dibuat/dihapus.
1. `parent`  
   Parent id jika ada, atau null jika tidak memiliki parent
1. `method`  
   Metode perubahan. Properti ini menerima nilai `1` untuk create, `2` untuk update, dan `3` untuk hapus.
1. `type`  
   Tipe object yang berubah, contohnya `post`, `post-category`, dan lain-lain.
1. `original`  
   Nilai properti object sebelum berubah, properti ini harus null untuk method `1`, dan object untuk lainnya.
1. `changes`  
   Nilai properti object yang berubah, properti ini harus null untuk method `3` dan object untuk lainnya.

Sebagai catatan, properti `id`, `updated`, dan `created` ( jika ada ) tidak dianggap sebagai perubahan dan pun tidak adak disimpan
sebagai properti perubahan.

### lastError(): ?string