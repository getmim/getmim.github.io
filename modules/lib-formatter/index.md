---
layout: post
title:  "Formatter"
date:   2016-01-22 01:01:01 +0700
categories: lib-formatter
---

Adalah module yang bertugas memformat suatu object atau multiple object
dalam array menjadi suatu bentuk atau properti tipe yang diharapkan. Ini
adalah module yang mungkin digunakan sebelum meneruskan data ke view atau
response api agar data yang dikirimkan siap diproses oleh masing-masing
handler.

Walaupun library ini cukup powerfull, tapi sangat disarankan untuk menggunakannya
hanya sekali dalam satu request untuk meminimalisir penggunaan resource server.
Jika beberapa object yang sama akan di format dengan bentuk yang sama, sangat
disarankan untuk memformatnya secara bersamaan.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-formatter
```

## Konfigurasi

Semua konfigurasi formatter disimpan di module masing-masing dengan bentuk
seperti di bawah:

```php
return [
    // ...
    'libFormatter' => [
        'formats' => [
            '/format-name/' => [
                '/field-name/' => [
                    'type' => '/format-prop-type/',
                    'format' => '/other-format-name/'
                ],
                'id' => [
                    'type' => 'number'
                ],
                'about' => [
                    'type' => 'text'
                ]
            ]
        ]
    ]
    // ...
];
```

## Penggunaan

Module ini membuat satu library `LibFormatter\Library\Formatter` yang bisa
digunakan dari mana saja di aplikasi:

```php
use LibFormatter\Library\Formatter;

$options = []; // additional options

$object = (object)[...];
$result = Formatter::format('format-name', $object, $options);

$objects = [(object)[...], ...];
$result  = Formatter::formatMany('format-name', $objects, $options, $askey);
```

Library ini memiliki method sebagai berikut:

### format(string $name, object $object, array $options=[]): ?object

### formatMany(string $name, array $objects, array $options=[], string $askey=null) ?array

Secara umum, fungsi ini akan mengembalikan indexed array dari object yang dikirim, untuk membuat
salah satu properti object menjadi array key, isikan nilai properti tersebut pada parameter `$askey`.

## Custom Handler

Formatter memungkinkan menerima custom handler untuk memformat suatu properti, silahkan daftarkan
handler tersebut di konfigurasi module dengan bentuk seperti di bawah:

```php
return [
    // ...
    'libFormatter' => [
        'handlers' => [
            '/name/' => [
                'handler' => 'Class::method',
                'collective' => false // true | '_MD5_' | $field,
                'field' => 'id', // for collective=true|$field only
            ]
        ]
    ]
    // ...
];
```

Nilai `collective` menentukan apakah semua object dikirimkan sekaligus, atau di proses
satu per satu. Metode ini cocok untuk penanganan multiple object properti dalam satu
eksekusi seperti pengambilan data dari db untuk meminimalisir eksekusi query database.

Nilai `true` pada properti `collective` akan menggunakan nilai dari properti itu sendiri
sebagai key array pengembalian data hasil proses oleh formatter. Jika mengharapkan properti
lain dari object tersebut sebagai key array, gunakan nama properti tersebut sebagai nilai
dari properti ini.

Selain nilai `true` dan nama field, properti tersebut juga menerima nilai string `_MD5_`
yang mengharapkan nilai pengembalian formatter menggunakan struktur `md5(value) => proc(value)`.
Metode seperti ini cocok jika konten yang akan diproses terlalu panjang untuk dijadikan
array key.

### collective

Untuk type collective, nilai masing-masing object akan dikelompokan terlebih dahulu,
kemudian meneruskan ke handler dengan bentuk seperti di bawah:

```php
$result = Handler::method(array $values, string $field, array $object, object $format, mixed $options);
```

Nilai yang dikembalikan dari fungsi ini diharapkan array key-value dimana key array adalah
nilai lama object tersebut, dan value adalah nilai baru yang akan ditindihkan ke object.
Kondisi ini berlaku jika nilai properti formatter `collective` adalah `true`.

Pada kondisi tertentu, nilai dari properti lama mungkin tidak bisa digunakan. Untuk kasus
seperti ini, maka nilai format `collective` bisa diubah menjadi nama properti lain dari object
yang akan digunakan sebagai key array.

Jika nilai yang dikembalikan adalah null, maka nilai object tidak akan diubah.

Parameter fungsi tersebut adalah:

1. `values` Array list semua nilai properti object.
1. `field` String nama field properti yang sedang di proses.
1. `object` Array object semua object yang sedang di proses.
1. `format` Object format yang sedang di implementasikan.
1. `options` Mixed opsi yang dikirimkan ke formatter tentang field ini.

Khusus untuk formatter `collective`, tambahan properti `field` dibutuhkan seperti pada
contoh di atas. Nilai dari properti ini yang akan dikelompokan dan dikirim ke handler.
Jika nilai `field` adalah `null`, nilai properti object yang sedang di format yang akan
dikelompokan.

### non collective

Untuk type non collective, masing-masing object dipanggile satu persatu. Handler
tersebut dipanggil dengan bentuk:

```php
$result = Handler::method(mixed $value, string $field, object $object, object $format, mixed $options);
```

Jika nilai yang dikembalikan adalah null, maka nilai object yang lama tidak akan diubah.
Callback ini dipanggil dengan parameter sebagai berikut:

1. `values` Mixed nilai properti object
1. `field` String nama field properti yang sedang di proses.
1. `object` Object yang sedang di proses.
1. `format` Object format yang sedang di implementasikan.
1. `options` Mixed opsi yang dikirimkan ke formatter tentang field ini.

Contoh di bawah adalah contoh handler yang digunakan untuk menambahkan prefix `_` pada
properti object.

```php
class CustomHandler
{
    static function addPrefixNonCollective($value, $field, &$object, $format, $options): void{
        return '_' . $value;
    }

    static function addPrefixForCollective($values, $field, &$object, $format, $options): void{
        $result = [];
        foreach($values as $val)
            $result[$val] = '_' . $val;
        return $resut;
    }
}
```