---
layout: post
title:  "Formatter Options"
date:   2016-01-22 01:01:01 +0700
---

### @default

Menggunakan nilai default pada suatu properti jika properti tersebut tidak ada
atau properti tersebut bernilai falsy.

```php
'field' => [
    'type' => '...',
    '@default' => 'default-value'
]
```

### @rename

Mengubah nama properti menjadi nama lain setelah melakukan proses formatting yang lain.

```php
'field' => [
    'type' => '...',
    '@rename' => 'field-other'
]
```

### @rest

Mengimplementasikan suatu format ke properti object yang mana properti tersebut tidak
didefinisikan di format.

```php
    'format-name' => [
        '@rest' => [
            'type' => 'delete'
        ],
        'field' => [
            'type' => '...'
        ]
    ]
```

### @unauthorized

Adalah opsi untuk mengganti nilai properti object ke nilai yang lain jika diminta
oleh request tanpa credentials user. Format tipe ini hanya digunakan jika module
`lib-user` terinstall.

```php
'field' => [
    'type' => '...',
    '@unauthorized' => 'new value'
]
```
