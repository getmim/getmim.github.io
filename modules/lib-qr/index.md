---
layout: post
title:  "QR Generator"
date:   2016-01-24 01:01:02 +0700
categories: ext-module
---

Adalah library untuk menggenerasi QR Code.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-qr
```

## Penggunaan

Module ini membuat satu library class dengan nama `LibQr\Library\Qr`
yang bisa digunakan untuk menggenerasi QR Code image:

```php
use LibQr\Library\Qr;

// save ke file
Qr::render([
    'text' => 'Text to encode',
    'save' => '/path/to/file.png',
    'size' => 35,
    'margin' => 3
]);

// print output
Qr::render([
    'text' => 'Text to encode',
    'size' => 35,
    'margin' => 3
]);
```

## Lisensi

Module ini menggunakan library pihak ketiga, yaitu
[PHP QR Code](http://phpqrcode.sourceforge.net/). Silahkan
mengacu pada library tersebut untuk lisensi.