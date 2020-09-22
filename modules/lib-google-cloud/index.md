---
layout: post
title:  "Lib Google Cloud"
date:   2016-02-02 01:01:01 +0700
categories: ext-module
---

Adalah module yang mempermudah proses pengenerasian OAuth2 token google
cloud dengan custom scope.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-google-cloud
```

## Penggunaan

Module ini menambah satu library dengan nama `LibGoogleCloud\Library\Auth`
yang bisa digunakan untuk menggenerasi OAuth2 access token google cloud:

```php
use LibGoogleCloud\Library\Auth;

$scope = 'https://www.googleapis.com/auth/devstorage.full_control';
$token = Auth::get($scope);
```

Module ini menggunakan library `lib-jwt`, pastikan menambahkan file `.json`
client service google di folder `./etc/cert/lib-google-cloud.json`, dan file
`./etc/cert/lib-jwt/(private|public).pem`. Silahkan mengacu pada library
tersebut cara menggenerasi file tersebut. Nilai dari file `private.pem` diambil
dari file `.json` client service google.