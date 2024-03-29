---
layout: post
title:  "PG GudangVoucher"
date:   2016-01-24 01:01:02 +0700
categories: ext-module lib-pg
---

Adalah library payment gateway gudangvoucher

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-pg-gv
```

## Konfigurasi

Tambahkan konfigurasi pada aplikasi sebagai berikut:

```php
return [
    'libPgGv' => [
        'merchant' => [
            'id' => ::Numberic,
            'key' => ::String
        ]
    ]
];
```

## Classes

### LibPgGv\Library\Gv

1. lastError(): ?array
1. makeCustom(bool $reset = false)
1. makeSignature(array $rules)
1. call(array $signs, string $uri, array $body): ?array

### LibPgGv\Library\GvEmoney

1. lastError(): ?array
1. DirectRegister(array $data): ?array
1. ?UpgradeToVerified
1. ?DisconnectAccount
1. InquiryAccount(array $data): ?array
1. BalanceInquiry(array $data): ?array
1. ?TransactionHistory
1. ?PurchaseTransaction
1. InquiryUsername(array $data): ?array
1. ?TransferFund
1. ?CheckStatusTransaction
1. InquiryQR(array $data): ?array
1. PaymentQR(array $data): ?array
1. CheckPaymentQR(array $data): ?array
