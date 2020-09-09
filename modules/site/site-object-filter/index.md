---
layout: post
title:  "Site Object Filter"
date:   2016-01-30 01:01:04 +0700
categories: ext-module site
---

Penyedia route untuk object filter.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install site-object-filter
```

## Penggunaan

Module ini menerima filter object lain yang disediakan oleh module lain. Untuk library
penyedia object filter, harus mendaftarkan diri pada konfigurasi aplikasi seperti di bawah
dan membuatkan class yang mengimplementasikan interface `\SiteObjectFilter\Iface\ObjectFilter`:

```php
return [
    'siteObjectFilter' => [
        'filters' => [
            'handlers' => [
                '/name/' => '/Class/',
                'timezone' => 'SiteObjectFilter\\Library\\TimezoneFilter'
            ]
        ]
    ]
];
```

Masing-masing object provider harus memiliki method sebagai berikut:

### filter(array $cond): ?array

### lastError(): ?string

## TimeZone Filter

Module ini menambahkan satu library untuk memfilter `timezone`. Library ini menerima query string:

1. `query` filter berdasarkan name
1. `what` filter berdasarkan continent
1. `country` filter berdasarkan negara ( ISO 3166-1 )