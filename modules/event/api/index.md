---
layout: post
title:  "Api Event"
date:   2016-01-22 01:01:01 +0700
categories: event api
---

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install api-event
```
## Endpoints

### `GET APIHOST/event/object`

Mengambil semua object vanue yang terdaftar. Endpoint ini menerima quer parameter ( page, rpp, month ). Selain itu juga menerima query string `q` untuk memfilter object event berdasarkan nama.

### `GET APIHOST/event/object/(id|slug)`