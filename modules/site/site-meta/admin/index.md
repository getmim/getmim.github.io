---
layout: post
title:  "Admin Site Meta"
date:   2016-02-04 01:01:01 +0700
categories: ext-module site site-meta
---

Adalah module untuk mempermudah pengerjaan dengan site-meta dari panel admin.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install admin-site-meta
```

## Penggunaan

Module ini menambah satu library dengan nama `AdminSiteMeta\Library\Meta` yang bisa
digunakan untuk memproses form untuk object meta data seperti schema type, meta title,
meta description, dan meta keywords.

Library ini memiliki 2 method, yaitu:

### function parse(object &$object, string $key): void

Memparse properti meta object menjadi field-field object dengan prefix `meta-`. Nilai
ini kemudian yang bisa digunakan pada form html.

### function combine(object &$object, string $key): void

Menggabungkan nilai-nilai yang ter-parse menjadi satu properti. Nilai akhir dari fungsi
ini yang bisa disimpan ke database.