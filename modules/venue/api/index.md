---
layout: post
title:  "Api Venue"
date:   2016-01-28 01:01:04 +0700
categories: venue
---

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install api-venue
```
## Endpoints

### `GET APIHOST/venue/object`

Mengambil semua object vanue yang terdaftar. Endpoint ini menerima quer parameter ( page, rpp ). Selain itu juga menerima query string `q` untuk memfilter object venue berdasarkan nama.

### `GET APIHOST/venue/object/(id|slug)`