---
layout: post
title:  "Standar Model"
date:   2016-01-23 01:01:02 +0700
categories: ext-module lib-model
---

Model adalah class yang menghubungkan aplikasi dengan driver database.
Masing-masing model di aplikasi mim harus extends dari `Mim\Model`.

Semua model harus memiliki protected properti sebagai berikut:

1. `chains::array` Berisi array field->config pair yang menentukan
hubungan properti tabel dari model ini dengan properti dari tabel
model yang lain.
1. `q::array` Adalah array yang berisi daftar field tabel ini jika
pada kondisi where terdapat array key `q`. Masing-masing field akan
dicocokan dengan operator `LIKE` dengan penghubung `OR`.
1. `table::string` Adalah nama table yang di menej model ini.

Contoh di bawah adalah contoh standar model:

```php

namespace LibUser\Model;
class User extends \Mim\Model
{
    protected static $table = 'user';

    protected static $q = ['name', 'fullname'];
    protected static $chains = [
        'label' => [
            'model' => 'LibUser\\Model\\UserLabel',

            // field penghubung di tabel user_label
            'field' => 'id',

            // field penghubung di tabel ini, nilai
            // default adalah nama field itu sendiri.
            'self'  => 'label', // optional

            // type join yang akan digunakan, nilai
            // default adalah `LEFT`. Nilai ini menerima
            // nilai '' untuk penghubung `JOIN` saja.
            'join' => 'LEFT', // optional
        ]
    ];
}
```