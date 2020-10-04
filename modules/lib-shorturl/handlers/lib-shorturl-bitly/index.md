---
layout: post
title:  "Short URL BIT.LY"
date:   2016-01-27 01:01:04 +0700
categories: ext-module lib-shorturl
---

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-shorturl-bitly
```

## Konfigurasi

Tambahkan konfigurasi seperti di bawah pada aplikasi:

```php
return [
    'libShortURLBitly' => [
        'client' => [
            'id' => '...',
            'secret' => '...'
        ],
        'user' => [
            'name' => '...',
            'password' => '...'
        ],
        'group' => [
            'guid' => '...'
        ]
    ]
];
```

Untuk mendapatkan client.(id|secret), buatkan satu aplikasi pada dashboard bitly dari menu
`Menu Kanan Atas > Profile Settings > Registered OAuth Applications`.

Untuk mendapatkan `group.guid`, silahkan panggil url `https://api-ssl.bitly.com/v4/groups`
dengan akses token.