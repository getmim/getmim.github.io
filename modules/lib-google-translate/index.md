---
layout: post
title:  "Lib Google Translate"
date:   2026-05-22 22:05:01 +0700
categories: ext-module
---

Adalah library yang mempermudah proses translasi teks ke berbagai bahasa menggunakan service google

## Instalasi

```
mim app install lib-google-translate
```

## Konfigurasi

Tambahkan konfigurasi seperti di bawah pada konfigurasi aplikasi:

```php
return [
    'libGoogleTranslate' => [
        'apiKey' => '~'
    ]
];
```

## Penggunaan

```php
use LibGoogleTranslate\Library\Translate;

$text = 'How are you?';
$to = 'id';

$res = Translate::translate($to, $text);
```
