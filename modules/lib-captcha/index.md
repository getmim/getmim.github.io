---
layout: post
title:  "Captcha"
date:   2025-05-09 01:01:01 +0700
categories: ext-module
---

Module untuk menggenerasi dan validasi captcha dengan gambar sederhana

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-captcha
```

## Penggunaan

### LibCaptcha\Library

1. image(string $token, string $gate): string
2. validate(string $token, string $answer): bool
