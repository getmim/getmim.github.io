---
layout: post
title:  "Validator Filters"
date:   2016-01-17 01:01:02 +0700
categories: lib-validator
---

Filters adalah fungsi-fungsi yang bertugas mengubah nilai suatu object.

Di bawah ini adalah daftar filters yang sudah ada di module init:

1. `array` Mengubah nilai menjadi array.
1. `boolean` Mengubah nilai menjadi boolean.
1. `emptystr2null` Mengubah nilai empty string menjadi null.
1. `float` Mengubah nilai menjadi float.
1. `integer` Mengubah nilai menjadi integer.
1. `lowercase` Mengubah nilai menjadi lowercase.
1. `object` Mengubah nilai menjadi object.
1. `round` Membulatkan nilai suatu nilai float. Nilai konfig ini adalah jumlah angka dibelakang koma.
1. `string` Mengubah nilai menjadi string.
1. `ucwords` Mengimpelmentasikan fungsi `ucwords` ke nilai.
1. `uppercase` Mengubah nilai menjadi uppercase.

## Custom Filters

Jika filter yang tersedia masih kurang, maka developer di perbolehkan
menambahkan filter buatannya sendiri. Pastikan membuat sebuah class dengan
static method yang mengembalikan nilai akhir yang akan dikirimkan ke 
controler. Contoh di bawah adalah contoh sederhana filter yang mengubah
suatu nilai menjadi integer:

```php
namespace MyFilter\Filter;

class Custon
{
    static function int($value, $options, $object, $field, $filters){
        return (int)$value;
    }
}
```

Kemudian tambahkan filer tersebut ke konfigurasi module dengan cara berikut:

```php
return [
    // ...
    'libValidator' => [
        'filters' => [
            'int' => 'MyFilter\\Filter\\Custom::int'
        ]
    ]
    // ...
];
```

Fungsi ini akan di panggil oleh validator dengan parameters:

1. `$value` Nilai yang perlu di proses.
1. `$options` Nilai properti filters di konfigurasi. Pada contoh di bawah,
nilai dari `$options` adalah `true`.
1. `$object` Object darimana nilai ini diambil.
1. `$fields` Nama properti dari nilai ini pada `$object`.
1. `$filters` Daftar filters yang lain yang juga di implementasikan
ke nilai ini.

Filter tersebut kemudian bisa digunakan di validator dengan bentuk seperti:

```php
$rules = [
    'age' => [
        'rules' => [...],
        'filters' => [
            'int' => true
        ]
    ]
];
```
