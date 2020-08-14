---
layout: post
title:  "Model Validator"
date:   2016-01-23 01:01:03 +0700
categories: ext-module lib-model
---

Jika module `lib-validator` terpasang, maka module ini mendaftarkan tipe-tipe validasi
seperti di bawah:

## unique

```php
// ...
    'unique' => [
        'model' => 'LibModule\\Model\\Name',
        'field' => 'username',
        'where' => [/* additional where condition */]
    ]
// ...
```

Struktur di atas memastikan data yang disubmit user tidak ada pada model `LibModule\Model\Name`
pada kolom `username`. Jika data tersebut ada di tabel, maka error `14.0` akan dikembalikan.

**Harus Unik Kecuali Sesuai Nilai Service**

```php
// ...
    'unique' => [
        'model' => 'LibModule\\Model\\Name',
        'field' => 'username',
        'where' => [/* additional where condition */],
        'self' => [
            'service' => 'user.id',
            'field' => 'xid'
        ]
    ]
// ...
```

Sama dengan kondisi sebelumnya, hanya saja jika nilai dari service `$this->user->id` sama
dengan nilai dari `$row->xid`, maka nilai dianggap unik, dan tidak akan mengembalikan
nilai error.

## exists

Memastikan data yang diberikan ada di database.

```php
// ...
    'exists' => [
        'model' => 'LibModule\\Model\\Name',
        'field' => 'name',
        'where' => [/* additional where condition */]
    ]
// ...
```

Perintah di atas akan mengecek keberadaan nilai yang diberikan di database.

## exists-list

Memastikan semua data yang diberikan ( dalam format array ) ada di database.

```php
// ...
    'exists-list' => [
        'model' => 'LibModule\\Model\\Name',
        'field' => 'name',
        'where' => [/* additional where condition */]
    ]
// ...
```

Tipe ini memastikan semua data yang dikirim ada di database.