---
layout: post
title:  "Zenziva SMS"
date:   2016-02-07 01:01:01 +0700
categories: lib-sms
---

Library sender untuk module `lib-sms` menggunakan service zenziva.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-sms-zenziva
```

## Konfigurasi

Pastikan menambahkan informasi koneksi ke zenziva seperti di bawah pada konfigurasi aplikasi:

```php
return [
    'libSmsZenziva' => [
        'userkey' => '...',
        'passkey' => '...'
    ]
];
```