---
layout: post
title:  "Banner"
date:   2015-01-12 07:44:45 +0700
categories: ext-module
---

Adalah module penyedia object banner ( iklan ).

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install banner
```

## Konfigurasi

Tambahkan konfigurasi seperti di bawah untuk preset placement pada editor:

```php
return [
    'banner' => [
        'placements' => [
            'Header',
            // ...
        ]
    ]
];
```

## Tipe

Tipe banner yang didukung sampai saat ini adalah:

1. image. Konten gambar dengan properti `url`, `link`, dan `title`.
1. html. Konten html.
1. google adsense. Konten ads dari google adsense.
1. iframe. URL ke suatu halaman external.