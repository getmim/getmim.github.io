---
layout: post
title:  "Purchase Payment"
date:   2016-01-14 01:01:02 +0700
categories: ext-module product
---

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install purchase-payment
```

## Payment Method Handler

Module ini membutuhkan informasi handler untuk payment method yang akan digunakan
Buatkan sebuah class yang mengimplementasikan interface `PurchasePayment\Iface\MethodInterface`
yang akan menangani semua urusan dengan payment method. Class tersebut harus memiliki
method sebagai berikut:

### Methods

#### public static function create(object $purchase, float $total, string $id): ?object

Create new payment object. This method should return array with below data:

```php
$result = [
    'type' => '/Group/',
    '...' => '...',
    'meta' => [...]
];
```
#### public static function exists(object $purchase, string $id): bool

Mengecek jika id payment method yang diberikan boleh digunakan untuk melakukan
pembayaran untuk purchase yang diberikan.

#### public static function getInstruction(object $purchase, object $payment)

Mengembalikan instruksi pembayaran. Nilai yang dikembalikan akan diteruskan ke
client.

#### public static function getMethods(object $purchase): ?array

Mengambil semua payment method yang didukung untuk suatu purchase. Nilai ini mengharapkan
mengembalikan nilai array berbentuk sebagai berikut:

```php
$result = [
    '/Group/' => [
        [ /* ... */ ],
        // ...
    ],
    'Bank Transfer' => [
        [
            'id' => 'unique id',
            'name' => 'BCA',
            'image' => 'http://...',
            'fee' => ::int
        ],
        // ...
    ]
];
```

#### public static function lastError(): ?array;

Mengembalikan kejadian error yang terjadi dalam bentuk array.

### Konfigurasi

Daftar handler tersebut pada konfigurasi aplikasi/module dengan cara sebagai berikut:

```php
return [
    'purchasePayment' => [
        'handlers' => [
            '/name/' => '/ClassHandler/',
            'bca' => 'Bca\\Library\\Handler'
        ]
    ]
];
```
