---
layout: post
title:  "Kondisi Where"
date:   2016-01-23 01:01:03 +0700
categories: ext-module lib-model
---

Pada beberapa method model memiliki parameter `$where` yang adalah array.
Di bawah ini adalah penjelasan tentang bagaimana penulisan kondisi where
yang benar.

Jika nilai suatu kondisi adalah array, maka system akan memproses data tersebut
yang mungkin dianggap spesial seperti di bawah. Untuk melewati proses inspeksi
nilai array, tambahkan nilai `__!` pada bagian paling belakang array. Nilai
`__!` tersebut akan dibuang, dan nilai awal array digunakan pada query `IN`
tanpa memproses nilai-nilai lainnya.

## Standar

Kondisi paling umum adalah kondisi field->value pair yang artinya where
field adalah value. Masing-masing field digabungkan dengan operator `=`
dan penghubung `AND`.

```php
$where = [
    'id' => 1,
    'name' => 'mim'
];
// `id` = 1 AND `name` = 'mim'
```

## IN Query

Untuk mencari baris dimana nilai yang dicari lebih dari satu, bisa menggunakan
array:

```php
$where = [
    'id' => [1,2,3],
    'name' => ['mim','php','framework'],
    'status' => 1
];
// `id` IN (1,2,3)
//      AND `name` IN ('mim','php','framework')
//      AND `status` = 1
```

## Operator

Nilai field bisa juga menerima array yang adalah pendanda operator seperti di bawah:

```php
$where = [
    'id' => ['__op', '>', 12],
    'status' => 1,
    'user' => ['__op', '!=', null],
    'deleted' => ['__op', '=', null],
    'slug' => ['__op', 'NOT IN', ['one','two']]
];
// `id` > 12 AND 
//  `status` = 1 AND
//  `user` IS NOT NULL AND
//  `deleted` IS NULL AND
//  `slug` NOT IN ('one','two')
```

Operator yang dikenal adalah `>`, `<`, `<=`, `>=`, `=`, `!=`, dan `NOT IN`.

## Between

Untuk mendapatkan row dengan nilai field diantara dua nilai, gunakan operator
array `__between`:

```php
$where = [
    'id' => ['__between', 1, 5],
    'status' => 1
];
// ( `id` BETWEEN 1 AND 2 ) AND `status` = 1
```

## Like

Penggunaan like juga menggunakan bentuk array operator dengan operator array `__like`:

```php
$where = [
    'name' => ['__like', 'mim', 'left']
];
// `name` LIKE '%mim'

$where = [
    'name' => ['__like', 'mim', 'right']
];
// `name` LIKE 'mim%'

$where = [
    'name' => ['__like', 'mim']
];
// `name` LIKE '%mim%'

$where = [
    'name' => ['__like', 'mim', 'none']
];
// `name` LIKE 'mim'

$where = [
    'name' => ['__like', 'mim', 'both']
];
// `name` LIKE '%mim%'

$where = [
    'name' => ['__like', 'mim', null, 'NOT']
];
// `name` NOT LIKE 'mim'
```

Nilai field juga bisa menerima array value:

```php
$where = [
    'name' => ['__like', ['mim', 'php', 'framework']]
];
// ( `name` LIKE '%mim%' OR `name` LIKE '%php%' OR `name` LIKE '%framework%' )
```

## AND

Untuk menghubungkan beberapa kondisi where dengan penghubung `AND`, gunakan
nama field `$and`:

```php
$where = [
    'status' => 1,
    '$and' => [
        [
            'created' => ['__op', '!=', NULL]
        ],
        [
            'created' => ['__op', '>', '2018-09-30']
        ]
    ]
];
// `status` = 1
//      AND (
//          ( `created` IS NOT NULL )
//          AND
//          ( `created` > '2018-09-30' )
//      )
```

## OR

Untuk menghubungkan beberapa kondisi where dengan penghubung `OR`, gunakan
nama field `$or`:

```php
$where = [
    'status' => 1,
    '$or' => [
        [
            'name' => 'mim'
        ],
        [
            'name' => 'php'
        ]
    ]
];
// `status` = 1
//      AND (
//          ( `name` = 'mim' )
//          OR
//          ( `name` = 'php' )
//      )
```

## Dari Tabel Lain

Memungkinkan juga mengambil data where dari tabel lain jika informasi
chain disimpan di properti model:

```php
class User extends \Mim\Model{
    protected static $table = 't_user';
    // ...
}

class Post extends \Mim\Model{
    protected static $tabel = 't_post';
    protected static $chains = [
        'user' => [
            'model' => 'User',
            'field' => 'id',
            'self'  => 'creator'
        ]
    ];
}

$where = [
    'status' => 1,
    'user.name' => 'mim'
];

// `t_post`.`status` = 1 AND `t_user`.`name` = 'mim'
```

Keterangan masing-masing properti adalah sebagai berikut:

1. `user` Nama kolom yang akan dibandingkan dengan tabel lain.
2. `user.model` Nama model untuk mendapatkan data dari tabel chain
3. `user.field` Nama kolom di tabel chain yang akan digunakan sebagai penghubung.
4. `user.self` Optional. Nama kolom di tabel model ini yang akan dibandingkan sebagai
penghubung. Jika tidak di set, maka nama kolom properti akan digunakan, pada contoh
di atas akan menggunakan kolom `user` jika properti `user.self` tidak diset.

Dengan contoh di atas, maka bentuk join yang akan terbuat adalah:

```sql
FROM t_post LEFT JOIN t_user ON t_post.creator = t_user.id;
```