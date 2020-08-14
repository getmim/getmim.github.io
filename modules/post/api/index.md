---
layout: post
title:  "Api Post"
date:   2016-01-14 01:01:02 +0700
categories: ext-module post
---

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install api-post
```

## Endpoints

### `GET APIHOST/post{?rpp,page,q}`

Mengambil semua post yang terdaftar. Endnpoint ini menerima pagination query ( page, rpp ). Selain itu juga menerima query string `q` untuk memfilter post dari properti `title`.

### `GET POSTHOST/post/random{?rpp}`

Mengambil random post sebanya rpp.

### `GET APIHOST/post/read/(id|slug)`

Mengambil properti lengkap suatu post.