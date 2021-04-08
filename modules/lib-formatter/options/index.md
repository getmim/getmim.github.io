---
layout: post
title:  "Formatter Options"
date:   2016-01-22 01:01:01 +0700
---

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

### @rename

Mengubah nama properti menjadi nama lain setelah melakukan proses formatting yang lain.

```php
'field' => [
    'type' => '...',
    '@rename' => 'field-other'
]
```

### @default

Menggunakan nilai default pada suatu properti jika properti tersebut tidak ada
atau properti tersebut bernilai falsy.

```php
'field' => [
    'type' => '...',
    '@default' => 'default-value'
]
```
