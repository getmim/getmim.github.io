---
layout: post
title:  "Product Purchase"
date:   2016-01-14 01:01:02 +0700
categories: ext-module product
---

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install purchase
```

## Konfigurasi

Ubah nilai konfigurasi sesuai kebutuhan:

```php
return [
    'purchase' => [
        'invoice' => [
            // prefix invoice
            'prefix' => 'INV-',

            // panjang nya numeric invoice number
            'length' => 10
        ]
    ]
];
```

## Invoice Generator

Untuk membuatkan custom library untuk menggenerasi invoice, buatkan sebuah class
dengan 1 static method dengan nama `generate` yang menerima satu argument object
purchase.

Contoh class tersebut adalah sebagai berikut:

```php
namespace App\Library;

class InvoiceGenerator
{
    public static function generate(object $purchase): ?string
    {
        return 'INV-' . $purchase->id;
    }
}
```

Kemudian tambahkan konfigurasi sebagai berikut pada konfig aplikasi:

```php
return [
    'purchase' => [
        'invoice' => [
            'handler' => 'App\\Library\\InvoiceGenerator'
        ]
    ]
];
```
