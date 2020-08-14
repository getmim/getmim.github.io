---
layout: post
title:  "Validator Rules"
date:   2016-01-17 01:01:02 +0700
categories: ext-module
---

Di bawah adalah daftar rule-rule validator yang dikenali sampai
saat ini.

1. [array](#array)
1. [callback](#callback)
1. [config](#config)
1. [date](#date)
1. [email](#email)
1. [empty](#empty)
1. [in](#in)
1. [ip](#ip)
1. [json](#json)
1. [length](#length)
1. [notin](#notin)
1. [numeric](#numeric)
1. [object](#object)
1. [regex](#regex)
1. [required](#required)
1. [required_on](#required_on)
1. [text](#text)
1. [url](#url)

### array

```php
// ...
    'array' => true
// ...
```

Validator untuk menentukan jika nilai adalah array. Nilai yang
diterima adalah `true` untuk menentukan nilai adalah array. `indexed`
untuk menentukan bahwa nilai adalah indexed array atau `assoc` untuk
menentukan jika nilai adalah array yang bukan indexed array.

### callback

```php
// ...
    'callback' => 'Class::method'
// ...
```

Menggunakan handler lain untuk validasi suatu nilai. Callback diharapkan
tidak mengembalikan nilai apapun jika valid, dan mengembalikan array error dan
tambahan parameter untuk locale.

```php
$errors = ['20.0', ['value' => $value]];
```

Fungsi callback akan di panggil dengan parameters sebagai berikut:

```php
Class::method($value, $options, $object, $field, $rules): ?array;
```

Dimana:

1. `$value` Nilai object yang akan di validasi
1. `$options` Nilai validator rule.
1. `$object` Semua data object yang sedang di validasi dalam satu level parent.
1. `$field` Nama properti dari `$object` yang akan di validasi.
1. `$rules` Semua rules yang sedang di validasi untuk `$value` ini.

### config

```php
// ...
    'config' => [
        'prop' => 'wallet.currency',
        // 'in' => 'wallet.currency',
        // 'is' => 'wallet.currency'
    ]
// ...
```

Membandingkan nilai form dengan data config aplikasi. Validator ini memiliki 3 bentuk, yaitu:

1. `prop` Nilai form harus adalah salah satu properti dari config.
1. `in` Nilai form harus salah satu dari nilai array config.
1. `is` Nilai form harus sama dengan nilai config.

### date

```php
// ...
    'date' => [
        'format' => 'Y-m-d',
        'min' => '+1 days',         // optional
        'min_field' => 'min-date',  // optional
        'max' => '+7 days',         // optional
        'max_field' => 'max-date'   // optional
    ]
// ...
```

Validator untuk nilai date. Penjelasan dari masing-masing properti adalah sebagai berikut:

1. `format` Format tanggal yang diharapkan dikirim oleh client.
1. `min` Nilai minimum tanggal yang diterima, akan menggunakan fungsi `strtotime`.
1. `min_field` Nilai minimum diambil dari field object yang lain, akan dikombinasikan dengan
   properti `min` jika tersedia.
1. `max` Nilai maksimum tanggal yang diterima, akan menggunakan fungsi `strtotime`.
1. `max_field` Nilai maximum diambil dari field object yang lain, akan dikombinasikan dengan
   properti `max` jika tersedia.

### email

```php
// ...
    'email' => true
// ...
```

Validator untuk nilai email. Rule ini hanya menerima nilai `true`.

### empty

Memastikan suatu nilai harus falsy atau bukan.

```php
// ...
    'empty' => false
// ...
```

### in

```php
// ...
    'in' => ['a','b']
// ...
```

Validator untuk memastikan nilai yang dikirim adalah salah satu dari
array.

### ip

```php
// ...
    'ip' => true
    'ip' => '4|6'
// ...
```

Validator untuk memastikan nilai yang dikirim adalah valid ip. Nilai
ini menerima nilai `true` untuk menerima nilai valid ip, atau bisa juga
nilai 4 untuk menerima hanya IPv4, atau 6 untuk menerima hanya IPv6.

### json

```php
// ...
    'json' => true
// ...
```

Memastikan nilai yang dikirim adalah json string yang bisa di `json_decode`.

### length

```php
// ...
    'length' => [
        'min' => :int, // optional if max set.
        'max' => :int  // optional if min set.
    ]
// ...
```

Validator untuk panjang suatu string atau array.

### notin

```php
// ...
    'notin' => ['a','b']
// ...
```

Validator kebalikan dari `in`, rule ini memastikan nilai yang diinput
bukan salah satu dari list.

### numeric

```php
// ...
    'numeric' => true,
    'numeric' => [
        'min' => :int, // optional
        'max' => :int,  // optional
        'decimal' => :int // optional
    ]
// ...
```
Validator untuk nilai numeric. Rule ini bisa menerima nilai
`true` untuk validasi numeric saja, atau bisa juga array dengan
properti `min`, `max`, dan/atau `decimal` untuk menentukan minimal
nilai, maksimal nilai, dan `decimal` untuk banyaknya angka dibelakang
koma.

### object

```php
// ...
    'object' => true
// ...
```

Validator untuk mencek jika nilai adalah object.

### regex

```php
// ...
    'regex' => '!^.+$!'
// ...
```

Validator yang akan mencocokan nilai regex dengan nilai data yang dikirim.

### required

```php
// ...
    'required' => true
// ...
```

Validator untuk memastikan nilai harus ada dan bukan null. Nilai 0, dan
false akan dianggap valid.

### required_on

```php
// ...
    'required_on' => [
        'field' => [
            'operator' => '=',
            'expected' => '2'
        ],
        'field' => [
            'operator' => '!=',
            'expected' => NULL
        ],
        'field' => [
            'operator' => 'in',
            'expected' => [1,2]
        ],
        'field' => [
            'operator' => '!in',
            'expected' => [1,2]
        ]
    ]
// ...
```

Validator untuk memastikan nilai harus ada dan bukan null berdasarkan suatu kondisi
nilai dari kolom lain. Nilai 0, dan false akan dianggap valid. Nilai operator yang dikenali
adalah `=`, `>`, `<`, `>=`, `<=`, `in`, `!in`.

### text

```php
// ...
    'text' => 'alnumdash'
// ...
```

Validator text. Rule ini menerima nilai:

1. `slug` untuk `a-z`, `0-9`, dan `-_`.
1. `alnumdash` untuk `a-z`, `A-Z`, `0-9`, dan `-`.
1. `alpha` untuk `a-z`, dan `A-Z`.
1. `alnum` untuk `a-z`, `A-Z`, dan `0-9`.

### url

```php
// ...
    'url' => true
    'url' => [
        'path' => true, // optional
        'query' => true | ['page', 'rpp'], // optional
    ]
// ...
```

Valiator untuk memastikan nilai yang dikirim adalah valid url.
Rule ini menerima nilai `true` untuk memastikan nilai adalah valid
`url`. Atau bisa juga array yang berisi beberapa sub-properti
untuk memastikan url memiliki kondisi-kondisi lain. Nilai sub-properti
`query` menerima nilai `true` yang memastikan url memiliki query
string, atau array yang memastikan query string memiliki query tersebut.