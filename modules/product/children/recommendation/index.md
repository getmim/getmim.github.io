---
layout: post
title:  "Product Recommendation"
date:   2016-01-14 01:01:02 +0700
categories: ext-module product
---

Adalah module yang menyediakan library untuk pengambilan produk rekomendasi.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install product-recommendation
```

## Penggunaan

Module ini menambahkan satu library dengan nama `ProductRecommendation\Library\Recommendation`
yang bisa digunakan untuk mengambil produk rekomendasi.

Sebagai catatan, secara default, library tersebut mengambil produk random.
Silahkan mengubah konten file `app/product-recommendation/library/Recommendation.php`
untuk menentukan bagaimana produk rekomendasi ditentukan.

```php
use ProductRecommendation\Library\Recommendation;

$products = Recommendation::get($rpp, $page, $additional_cond);
```