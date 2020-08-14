---
layout: post
title:  "Markdown"
date:   2016-01-11 01:01:02 +0700
categories: ext-module
---

Adalah module yang menyediakan class [php-markdown](https://github.com/michelf/php-markdown).
Ini adalah module yang langsung menggunakan class yang disediakan oleh php-markdown
tanpa membuatkan handler sendiri, sehingga penggunaannya sama persis dengan
php-markdown.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-markdown
```

## Penggunaan

Untuk penggunaannya, silahkan mengacu pada dokumentasi php-markdown.

```php
use Michelf\Markdown;
$my_html = Markdown::defaultTransform($my_text);
```