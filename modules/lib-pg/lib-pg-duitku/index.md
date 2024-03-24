---
layout: post
title:  "PG DUITKU"
date:   2016-01-24 01:01:02 +0700
categories: ext-module lib-pg
---

Adalah library payment gateway duitku

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-pg-duitku
```

## Konfigurasi

Tambahkan konfigurasi pada aplikasi sebagai berikut:

```php
return [
    'libPgDuitku' => [
        'merchantCode' => '',
        'apiKey' => '',
        'host' => ''
    ]
];
```

## Classes

### LibPgDuitku\Library\Duitku

1. createBill($data)
1. getInstruction($code)
1. getPaymentMethods($amount)
1. lastError()
