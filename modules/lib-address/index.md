---
layout: post
title:  "Address"
date:   2016-01-29 01:01:04 +0700
categories: ext-module
---

Module untuk menambah database alamat, dan menyediakan object filter.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-address
```

## Object Filters

Module ini menyediakan object filter sebagai berikut:

1. `addr-country`
1. `addr-state`
1. `addr-city`
1. `addr-district`
1. `addr-village`
1. `addr-zip`

Semua filter di atas menerima property `query` untuk memfilter berdasrakan
`name`. Selain filter `addr-country`, filter tersebut juga menerima query string:

1. `parent` Filter berdasarkan parent object.
1. `pfn` Gunakan field `name` untuk memfilter parent, atau `id` jika tidak diset.

Endpoint yang didukung untuk sementara adalah:

1. `admin`.