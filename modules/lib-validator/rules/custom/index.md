---
layout: post
title:  "Validator Custom Rules"
date:   2016-01-17 01:01:02 +0700
categories: lib-validator
---

Developer di beri kebebasan untuk membuat rule mereka sendiri. Untuk membuat
custom rule, pastikan mendaftarkan pada konfigurasi module seperti di bawah:

```php
return [
    // ...
    'libValidator' => [
        'validators' => [
            'ifirst' => 'MyRule\\Rules\\Custom::ifirst'
        ]
    ]
    // ...
];
```

Kemudian buatkan class dengan static method untuk validator ini:

```php
namespace MyRule\Rules;

class Custom{
    static function ifirst($value, $options, $object, $field, $rules): ?array{
        if(substr($value, 0, 1) === 'i')
            return null;
        return ['20.0'];
    }
}
```

Parameter yang digunakan saat memanggil fungsi ini adalah:

1. `$value` Nilai yang perlu di validasi
1. `$options` Nilai rule options pada kofigurasi, pada contoh di bawah, nilai
ini menjadi `true`.
1. `$object` Object dimana nilai ini diambil.
1. `$field` Nama `$object` properti darimana nilai diambil.
1. `$rules` Daftar semua rules yang juga di test pada nilai ini.

Contoh penggunaan pada aplikasi adalah sebagai berikut:

```php
$rules = [
    'name' => [
        'rules' => [
            'ifirst' => true
        ]
    ]
];
```