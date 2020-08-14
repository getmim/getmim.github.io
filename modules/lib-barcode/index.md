---
layout: post
title:  "Barcode Generator"
date:   2016-01-25 01:01:02 +0700
categories: ext-module
---

Adalah module untuk menggenerasi barcode.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-barcode
```

## Penggunaan

Module ini membuat satu class library yang bisa digunakan darimana
saja di aplikasi dengan nama `LibBarcode\Library\Barcode`.

```php
use LibBarcode\Library\Barcode;

$result = Barcode::generate([
    'number' => '099908881',
    'type'   => 'TYPE_CODE_39',
    'widthFactor' => 2,
    'height' => 100,
    'color' => [0,0,0],
    'output' => 'svg',
    'file' => '/home/lorem.svg'
]);

// header('Content-Type: image/svg');
echo $result;
```

Tipe output yang didukung adalah `svg`, `jpg`, `png`, dan `html`.

Untuk dukungan tipe, silahkan cek di [sini](https://github.com/picqer/php-barcode-generator).

## Lisensi

Module ini menggunakan library pihak ketika, yaitu
[php-barcode-generator](https://github.com/picqer/php-barcode-generator).
Silahkan mengacu pada library tersebut untuk lisensi.