---
layout: post
title:  "SMS Viro"
date:   2016-02-07 01:01:01 +0700
categories: lib-sms
---

Library sender untuk module `lib-sms` menggunakan service smsviro.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-sms-viro
```

## Konfigurasi

Pastikan menambahkan informasi koneksi ke smsviro seperti di bawah pada konfigurasi aplikasi:

```php
return [
    'libSmsViro' => [
        'apikey' => 'smsviro-apikey',
        'senderid' => 'SENDER_ID'
    ]
];
```
