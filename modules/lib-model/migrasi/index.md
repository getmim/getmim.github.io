---
layout: post
title:  "Migrasi Model"
date:   2016-01-23 01:01:03 +0700
categories: ext-module lib-model
---

Semua file migrate masing-masing module tersimpan di folder module masing-masing dengan nama
`modules/[name]/migrate.php`, dengan isi sebagai berikut:

```php
return [
    'LibModule\\Model\\Name' => [
        'fields' => [
            'id' => [
                'index' => 1,
                'type' => 'INTEGER',
                'lenght' => 11, // optional
                'attrs' => [ // optional
                    'null' => false,
                    'unique' => true,
                    'primary_key' => true,
                    'auto_increment' => true
                ]
            ],
            'preface' => [
                'index' => 10,
                'type' => 'VARCHAR',
                'length' => 250,
                'attrs' => [
                    'null' => true,
                    'default' => '/text/'
                ]
            ],
            'status' => [
                'index' => 12,
                'type' => 'ENUM',
                'options' => ['a','b','c'],
                'attrs' => []
            ],
            'content' => [
                'index' => 15,
                'type' => 'TEXT'
            ]
        ],
        'indexes' => [
            'by_content' => [
                'type' => 'FULLTEXT',
                'fields' => [
                    'content' => []
                ]
            ],
            'by_slug' => [
                'fields' => [
                    'preface' => [
                        'length' => 10
                    ]
                ]
            ],
            'by_user_status' => [
                'fields' => [
                    'user' => [],
                    'status' => []
                ]
            ]
        ],
        'data' => [
            'slug' => [
                'slug-1' => [ 'status'=>1, 'content'=>'Content #1'],
                'slug-2' => [ 'status'=>1, 'content'=>'Content #2']
            ]
        ]
    ]
];
```

Jika file `etc/migrate.php` ada, maka file tersebut juga akan digunakan pada proses migrasi.

## Properties

Di bawah ini adalah semua properti pada masing-masing model migrasi:

### fields

Berisi daftar field suatu tabel. Masing-masing field harus/boleh memiliki
properti-properti berikut:

1. `index::INT` Urutan kolom. Sebaiknya masing-masing index kolom dipisahkan dengan jarak
yang cukup jauh untuk memungkinkan module lain menginjek kolom tabel ini.
1. `type::STRING`. Tipe kolom. Nilai yang dikenali sampai saat ini adalah:
    1. Teks
        1. `CHAR`
        1. `ENUM`
        1. `LONGTEXT`
        1. `SET`
        1. `TEXT`
        1. `TINYTEXT`
        1. `VARCHAR`
    1. Numeric
        1. `BIGINT`
        1. `BOOLEAN`
        1. `DECIMAL`
        1. `DOUBLE`
        1. `FLOAT`
        1. `INTEGER`
        1. `MEDIUMINT`
        1. `SMALLINT`
        1. `TINYINT`
    1. Tanggal
        1. `DATE`
        1. `DATETIME`
        1. `TIMESTAMP`
        1. `TIME`
        1. `YEAR`
1. `length::STRING|INT`. Panjang kolom. Nilai ini harus ada pada tipe `VARCHAR`, `CHAR`,
DAN `DOUBlE`.
1. `options:ARRAY`. Nilai opsi untuk tipe `ENUM` dan `SET`.
1. `attrs::ARRAY`. Tambahan atribut untuk masing-masing kolom. Properti ini mungkin memiliki
properti sebagai berikut:
    1. `null::BOOLEAN`. False untuk menambahkan atribut `NOT NULL` pada kolom tersebut.
    1. `default::MIXED`. Nilai default kolom.
    1. `update::MIXED`. Nilai default untuk update kolom. Akan menambahkan atribut `ON UPDATE`.
    1. `unsigned::BOOLEAN`. Menambahkan atribut `UNSIGNED` pada kolom.
    1. `unique::BOOLEAN`. Menmabahkan atribut `UNIQUE` pada kolom.
    1. `primary_key::BOOLEAN`. Menjadikan kolom ini primary key.
    1. `auto_increment::BOOLEAN`. Menjadikan kolom ini auto_increment.

Sebagai catatan bahwa semua kolom dengan tipe koleksi teks akan menggunakan attribute
`COLLATE utf8_unicode_ci`. Sementara tabel akan dibuat dengan atribut
`DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci`.

### indexes

Berisi semua index suatu tabel. Masing-masing index harus/boleh memiliki properti
properti berikut:

1. `type::STRING` Type index. Nilai yang diterima adalah `UNIQUE`, `FULLTEXT`, dan `SPATIAL`, `BTREE` dan `HASH`.
Nilai default adalah `BTREE`.
1. `fields::ARRAY` Daftar fields yang akan digabungkan pada index ini. Masing-masing field
ini mungkin memiliki properti `length` yang menentukan jumlah karakter awal yang dijadikan index.
Properti length hanya bisa digunakan jika kolom tersebut adalah kolom tipe teks ( `TEXT`, `VARCHAR`, etc ). Jika menggunakan
index pada kolom dengan tipe `VARCHAR`, pastikan menambahkan properti `length` dengan nilai maksimal 191.

### data

Berisi preset data yang akan ditambahkan ke tabel dimana array key dari nilai ini adalah kolom pembanding
yang akan dicek di tabel sebelum meng-insert.

Berdasarkan contoh di atas, system akan melakukan pengecekan di tabel jika baris dengan `slug` `slug-1`
dan `slug-2` sudah ada. Jika belum, maka data tersebut akan dibuatkan.

## CLI

Ketika module `lib-model` di pasang, maka perintah di bawah bisa digunakan di folder
aplikasi:

### migrate test

Menguji jika terdapat perbedaan pada data tabel dengan tabel di database.

```
php index.php migrate test
```

### migrate start

Menjalankan proses migrasi dari data tabel ke database.

```
php index.php migrate start
```

### migrate schema (dirname)

Menjalakan proses migrasi dari data tabel ke database, tapi SQL query tidak dijalankan
ke database, melainkan memasukan bentuk query ke file `(dirname)/(dbname)`.

```
php index.php migrate schema (dirname)
```

## Migrator

Masing-masing migrator class pada masing-masing driver database harus mengimplementasikan
interface `LibModel\Iface\Migrator`. Class ini akan dibuat dengan perintah seperti di bawah:

```php
$migrator = new LibModule\Library\Migrator('LibModule\\Model\\Name', $data);
```

Parameter yang dikirimkan adalah nama model yang peri di migrate, dan array daftar
konfigurasi model, seperti fields, indexes dan preset data. Masing-masing migrator
harus memiliki method sebagai berikut:

### lastError(): ?string

Mengembalikan error yang terjadi.

### schema(string $file): bool

Menguji perbedaan antara data tabel dengan tabel di database dan menggenerasi file
sql untuk penyesuaian.

### start(): bool

Menjalankan proses migrasi dari data tabel ke tabel database.

### test(): ?array

Menguji jika terdapat perbedaan antara data tabel dengan tabel di database dan mengembalikan perbedaan
tersebut jika terdapat perbedaan, atau mengembalikan `NULL` jika tidak terdapat perbedaan.

Fungsi ini akan mengembalikan nilai `null` jika tidak ditemukan perbedaan antara database dan schema. Atau
akan mengembalikan nilai array seperti di bawah jika ditemukan perbedaan:

```php
$result = [
    'table_create'  => [
        // table index lists
        [
            'id' => [
                'index' => 1,
                'type' => 'INTEGER',
                // ...
            ]
        ],
        // ...
    ],
    'column_create' => [
        // table index lists
        [
            'id' => [
                'index' => 1,
                'type' => 'INTEGER',
                // ...
            ]
        ],
        // ...
    ],
    'column_delete' => [
        // tabel index lists
        [
            'id' => [
                'index' => 1,
                'type' => 'INTEGER',
                // ...
            ]
        ],
        // ...
    ],
    'column_update' => [
        // table index lists
        [
            'id' => [
                'index' => 1,
                'type' => 'INTEGER',
                // ...
            ]
        ],
        // ...
    ],
    'index_create'  => [
        // index lists
        [
            'type' => 'FULLTEXT',
            'fields' => [
                'content' => []
            ],
            'name' => 'by_content'
        ],
        // ...
    ],
    'index_delete'  => [
        // index lists
        [
            'type' => 'BTREE',
            'fields' => [
                'preface' => []
            ],
            'name' => 'by_preface'
        ],
        // ...
    ],
    'index_update'  => [
        // index lists
        [
            'type' => 'BTREE',
            'fields' => [
                'slug' => [
                    'length' => 20
                ]
            ],
            'name' => 'by_slug_len'
        ],
        // ...
    ],
    'data_create'   => [
        [ 'slug' => 'slug-1', 'status'=>1, 'content'=>'Content #1'],
        [ 'slug' => 'slug-2', 'status'=>1, 'content'=>'Content #2']
    ]
];
```