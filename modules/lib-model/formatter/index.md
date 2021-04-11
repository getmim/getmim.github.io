---
layout: post
title:  "Model Formatter"
date:   2016-01-23 01:01:02 +0700
categories: ext-module lib-model
---

Jika module `lib-formatter` terpasang, maka module ini menambahkan beberapa tipe format seperti di
bawah yang bisa digunakan untuk mengambil data row tabel lain untuk mengisi suatu properti objek.

## Tipe Format

Beberapa tambahan type format didefinisikan oleh module ini sebagai berikut:

### multiple-object

Mengubah nilai menjadi beberapa object dari database:

```php
'field' => [
    'type' => 'multilple-object',
    'separtor' => ',',
    // ...
    // as of type `object`
]
```

Semua opsi dan keterangan yang di format ini sama dengan format type `object`. Dengan tambahan
opsi `separator` untuk menentukan pemisah antar masing-masing identitas tabel.

Tipe ini mengharapkan nilai properti suatu object yang di format adalah identitas pengenal dari
tabel lain yang dipisahkan oleh suatu karakter. Format tipe ini akan mengubah nilai properti menjadi
array object.

### chain

Menambah properti object dengan sumber data dari tabel lain dengan penghubung kedua tabel
menggunakan tabel ketiga. Sebagai contoh, object `post` yang disimpan di tabel `post` mungkin
memiliki beberapa `tag` yang disimpan di tabel `post_tag`. Sementara, penghubung kedua tabel
di atas menggunakan tabel ketiga, yaitu `post_tag_chain`. Format type ini bertugas mengambil
semua `tag` yang adalah miliki `post` yang sedang di format.

```
# post
+---------+---------------------+
| Field   | Type                |
+---------+---------------------+
| id      | bigint(20) unsigned |
| title   | varchar(50)         |
| content | text                |
| created | timestamp           |
+---------+---------------------+

# post_tag
+---------+---------------------+
| Field   | Type                |
+---------+---------------------+
| id      | bigint(20) unsigned |
| name    | varchar(50)         |
| created | timestamp           |
+---------+---------------------+

# post_tag_chain
+----------+---------------------+
| Field    | Type                |
+----------+---------------------+
| id       | bigint(20) unsigned |
| post     | int(11)             |
| post_tag | int(11)             |
| created  | timestamp           |
+----------+---------------------+

```

Dengan bentuk di atas, untuk membuat satu properti tambahan pada object `post` dengan
nama `tag` yang berisi semua tag-tag yang ter-ikat dengan post tersebut, maka format
yang bisa digunakan adalah sebagai berikut:

```php
'tag' => [
    'type' => 'chain',
    'chain' => [
        'model' => [
            'name' => 'Post\\Model\\PostTagChain',
            'field' => 'post'
        ],
        'identity' => 'post_tag'
    ],
    'model' => [
        'name' => 'Parent\\Model\\Name',
        'field' => 'id'
    ]
    // as of type object
]
```

Semua opsi dan keterangan yang di format ini sama dengan format type `object`, dengan
tambahan sebagai berikut:

1. `chain` Informasi model chain penghubung antar tabel object dan tabel child object.
    1. `model` Berisi informasi model penghubung
        1. `name` Nama model penghubung.
        1. `field` Nama field di model ini yang berisi informasi `$object.id`.
    1. `identity` Nama kolom yang menyimpan pengenal object child object.
1. `model` Menyimpan model child object.
    1. `name` Nama model yang menyimpan child object.
    1. `field` Identity child object yang tersimpan di model chainer.

**PENTING** Objek yang sedang di format harus memiliki properti `id` yang unik.

### children

Mengambil semua object dari tabel lain dimana nilai dari suatu kolom table lain
tersebut adalah `id` dari object yang sedang di format.

**PENTING** Objek yang sedang di format harus memiliki properti `id` yang unik.

```php
'field' => [
    'type' => 'children',
    'model' => [
        'name' => 'Children\\Model\\Name',
        'field' => 'parent'
    ]
    // as of type object
]
```

Pada contoh di atas, properti `field` akan ditambahkan ke object yang sedang
diformat, dimana nilai dari properti tersebut diambil dari model `Children\Model\Name`
dengan nilai kolom `parent` table children tersebut adalah properti `id` dari
object yang sedang di format.

### object

Mengubah nilai properti menjadi object sesuai dengan yang ada di database. Formatter
akan mengambil data dari model lain dengan properti sesuai dengan nilai field yang sedang
di proses. Proses ini mengambil data dengan bentuk `Model::getOne([$model.field => $object.field]);`

```php
'field' => [
    'type' => 'object',
    'model' => [
        'name' => 'Parent\\Model\\Name',
        'field' => 'id',
        'type' => 'number'
    ],
    'field' => [
        'name' => 'field',
        'type' => 'text'
    ],
    'fields' => [
        ['name'=>'field', 'type'=>'text'],
        ['name'=>'field', 'type'=>'number']
    ],
    'format' => 'other-format-name'
]
```

1. `model` Berisi informasi model yang akan digunakan untuk mengambil data
    1. `name` Nama model yang akan digunakan.
    1. `field` Nama field table yang dicocokan dengan nilai field object.
    1. `type` Opsi untuk menset tipe `field` jika object tidak difetch dari db.
    yang sedang di format.
1. `field` Opsi opsional untuk mengambil hanya satu field dari table tersebut.
    1. `name` Nama field yang akan diambil.
    1. `type` Type format yang akan diimplementasikan ke data tersebut.
1. `fields` Opsi opsional untuk mengambil beberapa field dari tabel tersebut.
    1. `name` Nama fiel yang akan diambil.
    1. `type` Type format yang akan diimplementasiksn ke data tersebut.
1. `format` Opsi opsional untuk mengimplementasikan format lain ke object tersebut.

### object-switch

Penggunaan fitur switch untuk model object. Opsi ini memungkinkan aplikasi menggunakan
model yang berbeda untuk masing-masing kolom berdasarkan nilai kolom objek yang lain.

**PENTING** Objek yang sedang di format harus memiliki properti `id` yang unik.

```php
'field' => [
    'type' => 'object-switch',
    'field' => 'type',
    'cases' => [
        1 => [
            'model' => [
                // as of type `object`
            ],
            // as of type `object`
        ],
        2 => [
            // ...
        ]
    ]
]
```

### partial

Mengambil data dari model lain dengan pengenal object id. Data akan diambil dari
model lain dengan bentuk `Model::getOne([$model.field = $object.id]);`. Perbedaan
yang paling terlihat antara format type `partial` dan `object` adalah, format type
ini menambah field baru pada object yang sedang di format dengan sumber data dari
model lain dengan indentitas pembanding adalah properti `id` pada object yang sedang
di format.

```php
'field' => [
    'type' => 'partial',
    // ...
    // as of type `object`
]
```

Semua opsi dan keterangan yang di format ini sama dengan format type `object`.

## Opsi

Secara default, format tipe `object`, dan `multiple-object` akan mengubah nilai
properti parent menjadi object atau array object dengan satu properti, yaitu `id`
yang diambil dari nilai properti sebelumnya. Jika di format, maka hasilnya akan
menjadi seperti di bawah:

```php
$object = (object)[
    'user' => 2,
    'members' => '2,1'
];
$object = Formatter::format('name', $object);

// $object = (object)[
//     'user' => (object)['id'=>2],
//     'members' => [
//         (object)['id'=>2],
//         (object)['id'=>1]
//     ]
// ];
```

Aksi di atas tidak mengambil data dari database, hanya melakukan perubahan saja. Agar
formatter mengambil data asli dari database, pastikan menambakan parameter ketiga perintah
`format` dengan daftar properti yang ingin di ambil dari table:

```php
$object = (object)[
    'user' => 2,
    'members' => '2,1'
];
$object = Formatter::format('name', $object, ['user']);

// $object = (object)[
//     'user' => (object)[
//         // as of table
//     ],
//     'members' => [
//         (object)['id'=>2],
//         (object)['id'=>1]
//     ]
// ];
```

Pada contoh di atas, opsi formatter menggunakan satu nilai, yaitu `user`. Dengan bentuk
seperti ini, maka formatter akan mengambil data dari tabel. Sementara properti `members`
tetap berbentuk seperti semula karena tidak ditambahkan pada opsi.

Pada suatu kondisi, mungkin membutuhkan mengambil data lebih dalam lagi. Untuk kondisi
seperti ini, masing-masing properti harus dituliskan sebagai nilai opsi:

```php
$object = Formatter::format('name', $object, [
    'user' => [
        'profile',
        'email' => [
            'verification'
        ]
    ]
]);
```

Dengan bentuk seperti di atas, maka properti `user` dari objek utama akan diambil dari suatu table.

Object dari properti `user` diharapkan memiliki dua properti yang juga akan diambil dari tabel lain,
yaitu properti `profile`, dan `email`.

Karena properti `email` adalah object, dan memiliki properti `verification`, maka properti tersebut
dari object `email` juga diambil dari suatu tabel.

Format bentuk di atas akan menghasilkan bentuk kurang lebih seperti di bawah:

```php
$object = (object)[
    // other props
    'user' => (object)[
        // other props
        'profile' => (object)[
            // user.profile properties
        ],
        'email' => (object)[
            // other props
            'verification' => (object)[
                // user.email.verification properties
            ]
            // other props
        ]
        // other props
    ]
    // other fields
];
```
Walaupun penggunaan nested opsi seperti ini sangat mempermudah developer, tapi sangat
disarankan untuk meminimalisir proses yang tidak dibutuhkan karena proses nested seperti
ini mungkin membutuhkan resource yang tidak sedikit.

Selain itu, sangat disarankan melakukan format untuk beberapa object yang sama sekaligus,
dibanding masing-masing object di format satu persatu.

Untuk menambahkan kondisi where tambahan pada final object, tambahkan opsi `_where` pada
formatter seperti di bawah:

```php
$object = Formatter::format('name', $object, [
    'user' => [
        '_where' => [
            'status' => 2
        ]
    ]
]);
```

Bentuk seperti di atas akan mengambil object user dengan properti `status` adalah 2.
