---
layout: post
title:  "User Perm"
date:   2016-01-20 01:01:01 +0700
categories: ext-module
---

Adalah module yang menyediakan fasilitas izin untuk suatu aksi. Umumnya, fitur seperti ini
ada pada dashboard.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-user-perm
```

## Penggunaan

Module ini menambah satu service dengan nama `can_i` yang bisa dipanggil dari aplikasi
dengan perintah `$this->can_i->{perm_name}`.

```php
$can_read_post = $this->can_i->read_post;
```

## Tambahan Kolom

Module ini menambah satu kolom pada tabel `user` dengan nama `role`. User mungkin
diberika permission berdasarkan koneksi user dengan permission itu sendiri, atau
berdasarkan role yang diberika kepada user. Jika nilai kolom `role` bukan `0`, maka
permission yang digunakan adalah berdasarkan role.