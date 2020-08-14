---
layout: post
title:  "Helper"
date:   2015-01-09 07:44:45 +0700
categories: aplikasi
---

Module core dibarengi dengan beberapa fungsi global untuk membantu mempermudah
proses development:

**alt(...args)**

Fungsi untuk mengambil nilai paling awal yang bernilai *truly*.

```php
$l = alt(0, null, false, 1, true, 'teks');
// $l = 1
```

**autoload_class_exists($class)**

Fungsi untuk mengecek jika suatu class ada di aplikasi, sudah atau belum terload.
Fungsi ini akan mengecek dari autoload konfigurasi aplikasi dan memastikan file-nya
ada.

**array_flatten(array $array, string $prefix=''): array**

Fungsi untuk menjadikan suatu nested array menjadi satu level array dimana key masing-masing
sub-array digabungkan dengan karakter titik.

**arrayfy($data)**

Mengubah variable object menjadi array secara recursive.

**deb(...args)**

Fungsi debug untuk mengeluarkan informasi tentang nilai suatu variabel. Fungsi ini
akan mengakhiri request yang sedang berlansung.

**get_prop_value(object $object, string $fields)**

Mengambil nilai suatu object nested property yang dipisahkan oleh titik. Fungsi ini
akan menjelajahi sampai semua property terpenuhi, atau akan mengembalikan nilai null
jika tidak ditemukan.

**group_by_prop($array, $prop)**

Fungsi untuk mengelompokan array berdasarkan nilai suatu properti dari sub-array.

```php
$l = [
    ['id'=>1, 'name'=>'Mim', 'group'=>'framework'],
    ['id'=>2, 'name'=>'Phun', 'group'=>'framework'],
    ['id'=>3, 'name'=>'jQuery', 'group'=>'library']
];

$lx = group_by_prop($l, 'group');
// $lx = [
//     'framework' => [
//         ['id'=>1, 'name'=>'Mim', 'group'=>'framework'],
//         ['id'=>2, 'name'=>'Phun', 'group'=>'framework'],
//     ],
//     'library' => [
//         ['id'=>3, 'name'=>'jQuery', 'group'=>'library']
//     ]
// ];
```

**hs($string)**

Short-hand untuk perintah `htmlspecialchars($string, ENT_QUOTES);`.

**is_dev()**

Mengecek jika environment aplikasi adalah `development`. Fungsi ini sama dengan
menjalankan perintah `ENVIRONMENT === 'development'`, atau `getenv('MIM_ENV') === 'development'`.

**is_indexed_array($array)**

Fungsi untuk mengecek jika suatu array adalah indexed array.

```php
/* contoh 1 */
$l = [1, ['lorem'=>'ipsum'], (object)['id'=>1], 2];
is_indexed_array($l); // true

/* contoh 2 */
$l = [
    0 => 1,
    1 => ['lorem'=>'ipsum'],
    2 => (object)['id'=>1],
    3 => 2
];
is_indexed_array($l); // true

/* contoh 3 */
$l = [
    1 => 1,
    2 => ['lorem'=>'ipsum'],
    0 => (object)['id'=>1],
    3 => 2
];
is_indexed_array($l); // false

/* contoh 4 */
$l = [
    0 => 1,
    'array' => ['lorem'=>'ipsum'],
    'object' => (object)['id'=>1],
    3 => 2
];
is_indexed_array($l); // false
```

**module_exists($module)**

Fungsi untuk mengecek jika suatu module terinstal atau tidak. Akan mengembalikan
`true` jika terinstal, dan `false` jika tidak.

**object_replace($origin, $new)**

Mengganti atau menambahkan properti ke `$origin` dari `$new`. Fungsi ini hampir
sama dengan perintah `array_replace` tapi sumber data object.

```php
$l1 = (object)[
    'id' => 1,
    'name' => 'Phun'
];
$l2 = (object)[
    'name' => 'Mim',
    'license' => 'MIT'
];

$lx = object_replace($l1, $l2);
// $lx = [
//  'id' => 1,
//  'name' => 'Mim',
//  'license' => 'MIT'
// ]
```

**objectify($arr)**

Mengubah variable array menjadi object secara recursive.

**prop_as_key($array, $prop)**

Menjadikan properti array menjadi array key.

```php
$l = [
    [ 'id' => 1, 'name' => 'Mim' ],
    [ 'id' => 2, 'name' => 'Phun' ],
    [ 'id' => 3, 'name' => 'CodeIgniter' ]
];

$lx = prop_as_key($l, 'id');
// $lx = [
//  1 => [ 'id' => 1, 'name' => 'Mim' ],
//  2 => [ 'id' => 2, 'name' => 'Phun' ],
//  3 => [ 'id' => 3, 'name' => 'CodeIgniter' ]
// ]
```

**to_attr(array $attrs): string**

Mengkonversi nilai array menjadi string berbentuk atribut html.

**to_ns(string $str): string**

Mengubah suatu string menjadi bentuk namespace.

**to_route($opt, object $obj=null): string**

Adalah fungsi untuk mengubah suatu string/array menjadi string route
ke suatu route. Optionally tambahkan opsi `obj` untuk mengambil nilai
dari object tersebut untuk mengganti nilai parameter route yang di awali
dengan karakter `$`.

**to_source($data, $space=0, $escape=true)**

Mengubah object php menjadi nilai php string.