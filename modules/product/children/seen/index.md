---
layout: post
title:  "Product Last Seen"
date:   2016-01-14 01:01:02 +0700
categories: ext-module product
---

Module penyedia data last seen user terhadap suatu produk.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install product-last-seen
```

## Penggunaan

Module ini menambahkan satu library dengan nama `ProductLastSeen\Library\Seen` 
yang bisa digunakan untuk menambahkan informasi last seen product dari kontroler
product.

Setiap data yang ditambahkan melalui perintah `add` akan menambahkan data pada tabel
`product_last_seen`, jika sudah pernah ada, maka hanya akan menambah nilai kolom `seen`
dan meng-update kolom `updated`.

```php
use ProductLastSeen\Library\Seen;

// ...
Seen::add($user_id, $product_id);
// ...
```