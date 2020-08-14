---
layout: post
title:  "IPAPI"
date:   2016-02-06 01:01:03 +0700
categories: lib-ip-locator
---

Adalah salah satu library untuk penyedia data lokasi ip dari API [ipapi.co](https://ipapi.co/). Module ini harus digunakan sebagai finder dari module [lib-ip-locator](https://github.com/getmim/lib-ip-locator).

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-ip-ipapi
```

## Konfigurasi

Jika menggunakan API premium, silahkan tambahkan API KEY pada konfigurasi aplikasi sebagai berikut:

```php
return [
    'libIpIpapi' => [
        'apikey' => 'YOUR IPAPI-CO API KEY'
    ]
];
```