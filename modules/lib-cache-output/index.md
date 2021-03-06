---
layout: post
title:  "Cache Output"
date:   2016-01-03 01:01:02 +0700
categories: ext-module
---

Adalah module yang memungkinkan aplikasi menyimpan cache output. Perintah
`$this->res->setCache` hanya bisa digunakan jika module ini terpasang.

Semua cache akan di simpan di folder `./etc/cache/output`. Module ini juga
akan memparse request dan mengembalikan data dalam compresi yang didukung
browser jika module `lib-compress` terpasang.

Perlu diketahui bahwa module ini tidak akan mencache response jika http status
code bukan 200, dan atau memiliki cookie yang di set. Tapi tetap meresponse ke
user dengan kompresi yang memungkinkan.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-cache-output
```

## Konfigurasi

Module ini menerima tambahan konfigurasi pada aplikasi sebagai berikut:

```php
return [
    'libCacheOutput' => [
        'path' => 'etc/cache/output',
        'query' => [
            'page' => 1,
            'rpp' => 12,
            'q' => true
        ]
    ]
];
```

Properti `path` menentukan dimana semua file cache akan disimpan. Nilai default
adalah `etc/cache/output`. Jika diawali dengan `/`, maka nilai tersebut dianggap
sebagai absolute path. Jika tidak, maka akan ditambahkan prefix constant `BASEPATH`.

Properti `query` pada konfigurasi di atas menentukan daftar query parameter
yang diikutkan pada proses kalkulasi cache output. Sebagai contoh, url dengan
query parameter `?q=a` dianggap berbeda dengan url `?q=b`. Tetapi, url dengan
query parameter `?q=a&sort=s&sord=1` dianggap sama dengan `?q=a`, karena query
parameter yang dihitung hanya `q`. Query parameter ini mungkin menerima nilai
default seperti parameter `page` dan `rpp`, yang mana jika query parameter tersebut
tidak diset, maka nilai default yang akan digunakan, dengan begitu, url dengan
query parameter `?q=a`, `?q=a&page=1`, `?q=a&page=1&rpp=12`, dan `q=a&page=1&sort=s`
dianggap sama.

## Penggunaan

Begitu konten selesai di proses di kontroler, memanggil perintah `$this->res->setCache(int)`
sebelum memanggil `$this->res->send()` akan membuat cache yang akan digunakan oleh system
ketika ada request ke halaman yang sama selanjutnya.

## Hapus

Untuk menghapus suatu output cache dari storage, bisa menggunakan library `LibCacheOutput\Library\Cleaner`.

Ginakan method `router` untuk menghapus berdasarkan suatu route:

```php
use LibCacheOutput\Library\Cleaner;

Cleaner::router('routeName', ['route'=>'param']);
```