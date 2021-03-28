---
layout: post
title:  "Lib HTML5"
date:   2016-02-02 01:01:01 +0700
categories: ext-module
---

Adalah module yang menyediakan library [Masterminds/html5-php](https://github.com/Masterminds/html5-php) untuk mempermudah proses pekerjaan dengan HTML5.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-html5
```

## Penggunaan

```php
<?php

use Masterminds\HTML5;

$html = new HTML5();
$dom  = $html->loadHTMLFragment('<p>lorem</p>');
$result = $html->saveHTML($dom);
```

## Filter

Module ini menambahkan satu validator filter yang bisa digunakan untuk memfilter
html dari konten yang dikirimkan user untuk hanya menerima tag dan atribut yang
diperbolehkan saja:

```php
    'content' => [
        'type' => 'textarea',
        'rules' => [...],
        'filters' => [
            'a' => ['href', 'target'],
            'p' => ['class'],
            'b' => [],
            'i' => []
        ]
    ]
```

## Lisensi

Module menggunakan library dari [Masterminds/html5-php](https://github.com/Masterminds/html5-php).
Silahkan mengacu pada library tersebut untuk lisensi
