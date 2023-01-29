---
layout: post
title:  "Formatter Type"
date:   2016-01-22 01:01:02 +0700
categories: ext-module lib-formatter
---

Di bawah ini adalah semua format yang didukung oleh module ini secara default. Module-module
lain mungkin juga menambahkan format tipe nya masing-masing:

1. [boolean/bool](#booleanbool)
1. [clone](#clone)
1. [custom](#custom)
1. [date](#date)
1. [delete](#delete)
1. [embed](#embed)
1. [interval](#interval)
1. [location](#location)
1. [multiple-text](#multiple-text)
1. [number](#number)
1. [text](#text)
1. [json](#json)
1. [join](#join)
1. [rename](#rename)
1. [router](#router)
1. [switch](#switch)

### boolean|bool

Mengubah nilai menjadi boolean.

```php
'field' => [
    'type' => 'boolean'
]
```

### clone

Mengambil nilai dari properti lain. Salah satu dari `source` atau `sources` harus
diisi. Perbedaan antar keduanya adalah, `source` hanya mengambil satu properti dan
nilai dari properti tersebut menjadi nilai dari field ini. Sementara penggunaan
`sources` akan menguban niai ini menjadi object dengan properti sesuai dengan yang
ditentukan.

```php
'field' => [
    'type' => 'clone',
    'source' => [
        'field' => 'user.name.first',
        'type' => 'text'        // optional
    ],
    'sources' => [
        'name' => [
            'field' => 'user.name.first',
            'type' => 'text'    // optional
        ],
        'age' => [
            'field' => 'user.age',
            'type' => 'number'  // optional
        ]
    ]
]
```

### custom

Mengubah nilai menggunakan custom handler.

```php
'field' => [
    'type' => 'custom',
    'handler' => 'Class::method'
]
```

Custom handler akan di panggil dengan bentuk seperti di bawah:

```php
Class::method($value, $field, $object, $format, $options);
```

Parameter yang dikirimkan sama persis dengan custom handler di atas.

### date

Mengubah nilai properti object menjadi `Date`. Jika nilai `timezone`
tidak diisi, maka nilai dari yang sedang berjalan di aplikasi akan 
digunakan.

```php
'field' => [
    'type' => 'date',
    'timezone' => 'UTC', // Asia/Jakarta // optional
]
```

Object ini kemudian memiliki properti/method sebagai berikut:

```php
$date->format($format);
$date->timezone;
$date->time;
$date->value;
$date->{DateTime fuctions}();
```

### delete

Menghapus properti

```php
'field' => [
    'type' => 'delete'
]
```

### embed

Mengubah nilai properti menjadi URL suatu embed HTML code.

```php
'field' => [
    'type' => 'embed'
]
```

Object ini memiliki beberapa properti sebagai berikut:

```php
$embed->url; // string
$embed->provider; // string
$embed->html; // string
```

### interval

Mengubah nilai properti menjadi object interval.

```php
'field' => [
    'expiration' => 'interval'
]
```

Object ini kemudian memiliki properti/method sebagai berikut:

```php
$date->format($format);
$date->time;
$date->value;
$date->DateTime;
$date->DateInterval;
```

### location

Mengubah nilai properti object menjadi object location.

```php
'field' => [
    'type' => 'location'
]
```

Object ini sekarang memiliki properti berikut:

```php
$loc->long;
$loc->lat;
$loc->embed->google(string $apikey);
```

Nilai yang diharapkan yang bisa diubah menjadi lokasi adalah dalam format
`lat,long`.

### multiple-text

Mengubah nilai properti menjadi array multiple text object. Silahkan
mengacu pada type text untuk detail masing-masing text object.

```php
'field' => [
    'type' => 'multiple-text',
    'separator' => ',' // PHP_EOL, |
]
```

### number

Mengubah nilai menjadi object number.

```php
'field' => [
    'type' => 'number',
    'decimal' => 2  // optional
]
```

Object ini kemudian memiliki properti/method sebagai berikut:

```php
$num->value;
$num->format([$decimal=0, [$decimal_sep=',', [$thousand_sep='.']]]);
```

### text

Menguban nilai menjadi object text

```php
'field' => [
    'type' => 'text',
    'default' => 'DEFAULT VALUE' // optional
]
```

Opsi `default` akan digunakan sebagai pengganti nilai field jika nilai yang sekarang
adalah falsy

Object ini kemudian memiliki properti/method sebagai berikut:

```php
$text->chars($len);
$text->words($len);
$text->safe;
$text->clean;
$text->value;
```

Properti safe dan clean akan mengembalikan object dengan type `text`.

### json

Mengubah nilai properti yang adalah text menjadi array/object dengan fungsi
`json_decode`. Jika properti `format` di set, maka object tersebut akan
teruskan ke formatter dengan tipe sesuai dengan nilai properti tersebut.

```php
'field' => [
    'type' => 'json',
    'format' => '/other-format-name/' // optional
]
```

### join

Menggabungkan nilai properti object atau text menjadi nilai properti ini

```php
'field' => [
    'type' => 'join',
    'fields' => ['My', 'name', 'is', '$name.first'],
    'separator' => ' '
]
```

Untuk mengambil niali properti object, gunakan prefix `$`. Untuk mendapatkan
nilai dari sub-object, masing-masing properti dipisakan dengan titik.

### rename

Mengubah nama properti menjadi sesuatu yang lain:

```php
'field' => [
    'type' => 'rename',
    'to' => 'newfield'
]
```

### router

Opsi untuk mengubah atau membuat nilai properti menjadi url dari router

```php
'field' => [
    'type' => 'router',
    'router' => [
        'name' => 'routerName',
        'params' => [
            'id' => '$id',
            'name' => 'post',
            'slug' => '$user.name'
        ]
    ]
]
```

Nilai `params` akan dikirimkan ke router builder dimana nilai dari array params
tersebut diambil dari object yang sedang di format jika di awali dengan `$`,
atau string.

### switch

Opsi yang memungkinkan suatu field di format dengan tipe format yang berbeda berdasarkan nilai
properti suatu objek.

```php
'field' => [
    'type' => 'switch',
    'case' => [
        'rkey0' => [
            'field' => '/field-name/',
            'operator' => '=',
            'expected' => 1,
            'result' => [
                'type' => 'number'
            ]
        ],
        'rkey1' => [
            'field' => '/field-name/',
            'operator' => '>',
            'expected' => 1,
            'result' => [
                'type' => 'date'
            ]
        ],
        'rkey2' => [
            'field' => '/field-name/',
            'operator' => '<',
            'expected' => 1,
            'result' => [
                'type' => 'delete'
            ]
        ]
    ]
]
```

Pada contoh di atas, nilai properti `field` akan di format berdasarkan nilai dari properti
lain object ini. Jika nilai dari properti `/field-name/` adalah 1, maka format tipe `number`
akan digunakan, jika nilai `/field-name/` lebih besar dari 1, maka format tipe `date` yang
akan digunakan, dan begitu seterusnya.

Perlu diketahui bahwa case format collective akan diproses satu persatu.
