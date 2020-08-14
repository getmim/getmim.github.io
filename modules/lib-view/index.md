---
layout: post
title:  "View"
date:   2016-01-06 01:01:02 +0700
categories: ext-module
---

Adalah module yang menangani template renderer. Secara default, module ini
menyediakan renderer `.phtml`, untuk dukungan renderer lain, silahkan install
juga module renderer yang tersedia.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-view
```

## Penggunaan

Module `core` pada service `response` memiliki method `render` yang
akan menggunakan module ini, contoh penggunaan pada kontroler:

```php
// body method kontroler
    $this->res->render('post/single', ['post'=>$post]);
```

## phtml

Jika menggunakan renderer bawaan ( `phtml` ), maka method-method di bawah bisa digunakan
di dalam template:

### partial(string $view, array $params=[], string $gate=null): ?string

### asset(string $path, int $version=0): string

## Custom Renderer

Jika ingin membuatkan custom renderer, pastikan renderer mengimplementasikan
interface `LibView\Iface\Renderer`.

Pastikan juga mendaftarkan renderer tersebut di konfigurasi dengan cara sebagai berikut:

```php
return [
    // ...
    'libView' => [
        'handlers' => [
            'renderer-name' => 'Renderrer\\Class'
        ]
    ],
    // ...
];
```

Kemudian pada aplikasi, tambahan konfigurasi sebagai berikut:

```php
return [
    // ...
    'libView' => [
        'renderer' => 'renderer-name'
    ]
    // ...
];
```

Sehingga masing-masing renderer harus memiliki method:

### render(string $view, array $params=[], string $gate=null): string

Konten yang dirender oleh renderer tidak boleh diteruskan ke output buffer,
semuanya harus dikembalikan ke handler dalam bentuk string.