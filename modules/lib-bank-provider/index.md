---
layout: post
title:  "Bank Provider"
date:   2016-01-25 01:01:02 +0700
categories: ext-module
---

Adalah module yang menyediakan interface untuk penyedia bank provider.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-bank-provider
```

## Konfigurasi

Tambahkan konfigurasi seperti di bawah pada aplikasi/module untuk mendaftarkan
provider yang akan digunakan.

```php
return [
    'libBankProvider' => [
        'provider' => 'Class'
    ]
];
```

## Provider

Buatkan sebuah library yang mengimplementasikan interface `\LibBankProvider\Iface\Provider`
untuk digunakan sebagai penyedia bank provider. Library tersebut harus
memiliki method sebagai berikut:

### getAll(array $ids=null, string $nama=null): array

Mengambil semua bank provider, optionally filter berdasarkan id atau nama bank.

### getById(int $id): ?object

Mengambil satu object bank provider berdasarkan id.

## Bank Object

Masing-masing bank object harus memiliki property sebagai berikut:

```json
{
    "id": "::int",
    "name": "::str",
    "code": "::str",
    "logo": "::str"
}
```

## Penggunaan

Module ini menambahkan satu library dengan nama `LibBankProvider\Library\Provider`
yang bisa digunakan untuk mengambil daftar bank provider.

```php
use LibBankProvider\Library\Provider;

$banks = Provider::get();
$banks = Provider::get(['name'=>'bc']);
$bank  = Provider::getOne(['id'=>1]);
```