---
layout: post
title:  "API Object Filter"
date:   2016-01-28 01:01:04 +0700
categories: ext-module api
---

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install api-object-filter
```

## Penggunaan

Module ini menerima filter object lain yang disediakan oleh module lain.
Untuk library penyedia object filter, harus mendaftarkan diri pada konfigurasi
aplikasi seperti di bawah dan membuatkan class yang mengimplementasikan
interface `\ApiObjectFilter\Iface\ObjectFilter`:

```php
return [
    'apiObjectFilter' => [
        'filters' => [
            'handlers' => [
                '/name/' => '/Class/',
                'timezone' => 'ApiObjectFilter\\Library\\TimezoneFilter'
            ]
        ]
    ]
];
```

Masing-masing object provider harus memiliki method sebagai berikut:

### filter(array $cond): ?array

### lastError(): ?string

## Endpoints

### APIHOST/-/object/filter?{type,q,...}

## Timezone Filter

Module ini menambahkan timezone filter dengan query string sebagai berikut:

1. type  Harus selalu `timezone`
1. q  Filter berdasarkan timezone name.
1. what  Filter berdasarkan [group](https://www.php.net/manual/en/class.datetimezone.php).
1. country  Dua karakter nama negara sesuai dengan ISO 3166-1