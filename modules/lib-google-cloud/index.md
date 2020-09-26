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
$cert  = '/path/to/credentials.json';
$token = Auth::get($cert, $scope);
```