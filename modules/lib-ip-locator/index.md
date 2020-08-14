---
layout: post
title:  "IP Locator"
date:   2016-02-06 01:01:01 +0700
categories: ext-module
---

Menejer untuk ip locator provider. Module ini bertujuan menstandarisasi semua penyedia
ip locator. Oleh karena itu, module ini tidak bisa berdiri sendiri. Dibutuhkan provider yang
mengeksekusi pencarian lokasi suatu ip. Salah satu module yang bisa digunakan sebagai provider
adalah `lib-ip-db`.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-ip-locator
```

## Konfigurasi

Provider harus mendaftarkan library mereka masing-masing untuk finder dan keeper.

```php
return [
    'libIpLocator' => [
        'finder' => [
            'Module\\Namespace\\Class'  => 100,
            'Module2\\Namespace\\Class' => 200,
            $module                     => $priority
        ],
        'keeper' => [
            'Module\\Namespace\\Class' => 100
        ]
    ]
];
```

### finder

Adalah library yang akan dipanggil untuk mencari lokasi suatu IP. Jika suatu finder mengembalikan 
nilai `null`, maka proses akan dilanjutkan ke library selanjutnya berdasarkan urutan prioritas dari
yang paling besar ke yang paling kecil, tapi jika finder mengembalikan nilai object, maka library
selanjutnya tidak akan dipanggil.

Mengacu pada contoh di atas, maka library `Module2\\Namespace\\Class` akan dipanggil terlebih dahulu,
dan hanya jika library ini mengembalikan nilai `null`, maka class `Module\\Namespace\\Class` akan
dipanggil kemudian.

Masing-masing library ini akan dipanggil dengan static method `find(string $ip)`.

Class finder harus mengimplementasikan interface `LibIpLocator\\Iface\\Finder`.

### keeper

Adalah library yang akan dipanggil ketika suatu ip berhasil ditemukan dan sebelum nilai tersebut
dikembalikan ke aplikasi. Urutan pemanggilan juga sama dengan `finder` diurutkan berdasarkan
nilai prioritas paling tinggi ke yang paling rendah.

Masing-masing library ini akan dipanggil dengan static method `keep(string $finder, string $ip, object $result)`.
Dimana `finder` adalah class name yang berhasil mendapatkan lokasi ip, `ip` adalah ip yang dicari,
dan `result` adalah object lokasi ip.

Library ini cocok digunakan untuk menyimpan cache jika dibutuhkan.

Class keeper harus mengimplementasikan interface `LibIpLocator\\Iface\\Keeper`.

## Penggunaan

Module ini mendaftarkan satu library yang bisa digunakan aplikasi untuk mencari lokasi suatu IP.
Library tersebut adalah `LibIpLocator\\Library\\Locator`.

```php
use LibIpLocator\Library\Locator;

$iploc = Locator::find($user_ip);
// $iploc = (object)[
//  'city' => 'City Name',
//  'state' => (object)[
//      'name' => '',
//      'code' => ''
//  ],
//  'country' => (object)[
//      'name' => '',
//      'code' => ''
//  ],
//  'continent' => (object)[
//      'code' => '',
//      'name' => ''
//  ],
//  'timezone' => ''
// ];
```

## Method

### find(string $user_ip): ?object

Mencari lokasi suatu IP dan mengembalikan data objek lokasi IP.