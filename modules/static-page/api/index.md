---
layout: post
title:  "Api Static Page"
date:   2017-01-01 01:01:01 +0700
categories: static-page
---

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install api-static-page
```

## Endpoints

### `GET APIHOST/page`

Mengambil semua halaman yang terdaftar. Endnpoint ini menerima pagination query ( page, rpp ). Selain itu juga menerima query string `q` untuk memfilter halaman dari properti `title`.

### `GET APIHOST/page/(id|slug)`

Mengambil properti lengkap suatu halaman.