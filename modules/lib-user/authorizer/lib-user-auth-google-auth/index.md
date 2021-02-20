---
layout: post
title:  "User Auth Google Authenticator"
date:   2016-01-20 01:01:03 +0700
categories: ext-module lib-user
---

Adalah module yang memungkinkan identifikasi user berdasarkan google authenticator.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-user-auth-google-auth
```

## Penggunaan

Module ini menambah satu library dengan nama `LibUserAuthGoogleAuth\Library\Auth`
yang bisa digunakan untuk menggenerasi dan memvalidasi token google authenticator.

```php
use LibUserAuthGoogleAuth\Library\Auth;
use LibUser\Library\Fetcher;

$user = Fetcher::getOne(['id' => 1]);

// get QR code for registration
$qr_url = Auth::getQRUrl($user);
// <img src=" $qr_url ">

// other state
// check user submited OTP
$code = $_POST['code'];
$valid = Auth::validate($user, $code);
```
