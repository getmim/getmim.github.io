---
layout: post
title:  "Pengunaan"
date:   2016-01-23 01:01:04 +0700
categories: ext-module lib-model
---

## Method

Di bawah ini adalah daftar semua method yang bisa digunakan dari sebuah model:

### autocommit(bool $mode, string $conn='write'): bool;

Menyalakan atau mematikan aksi autocommit pada database, hanya bisa digunakan 
pada engine yang mendukung autocommit.

```php
Model::autocommit(false);
```

### avg(string $field, array $where=[]): int|double;

Mengambil nilai rata-rata suatu field pada tabel.

```php
$average = Model::avg('balance');
```

### commit(string $conn='write'): bool

Mengeksekusi pending transaksi.

```php
Model::commit();
```

### count(array $where=[]): int;

Menghitung jumlah baris pada tabel.

```php
$total = Model::count();
```

### countGroup(string $field, array $where=[]): array;

Menghitung jumlah baris pada tabel yang dikelompokan berdasarkan nilai suatu kolom.

```php
$total_user_per_status = Model::countGroup('status');
// [
//  1 => 12,
//  2 => 23,
//  ...
// ]
```

### create(array $row, bool $ignore=false): ?int;

Menambah satu baris baru pada tabel. Fungsi ini mengembalikan id baris yang bari
ditambahkan. Set properti `ignore` menjadi `true` untuk menggunakan query
`INSERT IGNORE`.

```php
$id = Model::create(['name'=>'mim']);
```

### createMany(array $rows, bool $ignore=false): bool;

Menambahkan banyak baris sekaligus. Fungsi ini mengembalikan
nilai true jika berhasil, dan false jika gagal. Set properti `ignore` menjadi
`true` untuk menggunakan query `INSERT IGNORE`.

```php
$rows = [
    ['name' => 'mim'],
    ['name' => 'php'],
    ['name' => 'framework']
];

Model::createMany($rows);
```

### dec(array $fields, array $where=[]): bool;

Mengurangi nilai kolom tabel sebanyak nilai yang ditentukan.

```php
Model::dec(['quota'=>5], $where);
```

Pada fungsi di atas, nilai kolom `quota` pada tabel akan dikurangi
sebanyak 5 dari nilai sebelumnya.

### escape(string $str): string;

Fungsi meng-escape suatu string sebelum digunakan pada query.

```php
$str = Model::escape($str);
```

### getOne(array $where=[], array $order=['id'=>false]): ?object;

Mengambil satu baris pada tabel

```php
$row = Model::getOne($cond);
```

### get(array $where=[], int $rpp=0, int $page=1, array $order=['id'=>false]): ?array;

Mengambil beberapa baris pada tabel

```php
$rows = Model::get($cond);
```

### getConnection(string $target='read');

Fungsi untuk mengambil nama object resource koneksi yang digunakan
oleh model untuk melakukan aktifitas dengan database.

```php
$mysql = Model::getConnection('write');
```

### getConnectionName(string $target='read'): ?string;

Mengambil nama koneksi yang digunakan oleh model untuk membuat object
resource koneksi ke database.

```php
$mysql = Model::getConnectionName('write');
```

### public function getDBName(string $target='read'): ?string;

Mengambil nama database untuk suatu suatu model pada target koneksi.

```php
$dbname = Model::getDBName();
```

### getDriver(): ?string;

Fungsi untuk mengetahui tipe driver suatu model.

```php
$driver = Model::getDriver();
```

### getModel(): ?string;

Fungsi untuk mengambil nama model yang sedang digunakan pada driver ini.

```php
$model = Model::getModel();
```

### getTable(): string;

Fungsi untuk mengambil nama tabel yang ditangani oleh model ini.

```php
$tabel = Model::getTable();
```

### inc(array $fields, array $where=[]): bool;

Fungsi untuk menambahkan suatu nilai pada kolom. Fungsi ini adalah
kebalikan dari `dec`.

```php
Model::inc(['quota'=>5], $where);
```

Pada fungsi di atas, nilai `quota` pada tabel model akan ditambah sebanyak
5 dari nilai sebelumnya.

### lastError(): ?string;

Mengembalikan nilai error yang terjadi pada query sebelumnya.

```php
$error = Model::lastError();
```

### lastId(): ?int;

Mengembalikan id ( auto_increment ) dari tabel dari aktifitas `create`
sebelumnya.

```php
$id = Model::lastId();
```

### lastQuery(): ?string;

Mengembalikan query yang dieksekusi sebelumnya.

```php
$query = Model::lastQuery();
```

### max(string $field, array $where=[]): int;

Mengembalikan nilai tertinggi suatu kolom pada tabel.

```php
Model::max('pageview');
```

### min(string $field, array $where=[]): int|double;

Mengambil nilai paling kecil suatu kolom pada tabel.

```php
$min = Model::min('balance');
```

### remove(array $where=[]): bool;

Menghapus baris pada tabel.

```php
Model::remove(['id'=>12]);
```

### rollback(string $conn='write'): bool

Membatalkan transaksi terakhir.

```php
Model::rollback();
```

### set(array $fields, array $where=[]): bool;

Mengubah nilai kolom pada tabel.

```php
$where = ['id'=>1];
$column = [
    
    'balance' => 20000,

    'name' => 'mim',

    // below content converted to string with json_encode
    'location' => [
        'city' => 'Jakarta',
        'provincy' => 'DKI Jakarta'
    ],

    // increase pageviews column by 12.
    'pageviews' => ['__inc', 12],

    // decrease quota column by 5
    'quota' => ['__dec', 5]
];

$success = Model::set($column, $where);
```

Perhatikan pada contoh di atas, bahwa proses set bisa menggunakan beberapa
tipe data.

1. `null|bool|int|str` Akan di simpan seperti apa adanya.
1. `object|array` Akan diconversi menjadi string dengan perintah `json_encode`.
1. `array __inc` Sama dengan perintah `inc`.
1. `array __dec` Sama dengan perintah `dec`.

### sum(string $field, array $where=[]): int|double;

Menjumlahkan nilai suatu kolom pada tabel.

```php
$sum = Model::sum('pageview');
```

### sumFs(array $fields, array $where=[]): ?array

Menjumlahkan beberapa field.

```php
$sums = Model::sumFs(['pageviews','likes','comments']);
```

### truncate(string $target='write'): bool;

Fungsi untuk mengosongkan tabel.

```php
$sum = Model::truncate();
```