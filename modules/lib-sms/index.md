---
layout: post
title:  "SMS Sender"
date:   2016-02-07 01:01:01 +0700
categories: ext-module
---

Adalah library untuk mengirim SMS teks ke suatu nomor handphone.
Module ini tidak bisa bediri sendiri, dibutuhkan module sender yang bertugas
menghubungkan aplikasi dengan pihak pengirim SMS.

Jika terdapat beberapa library sender, maka semua library tersebut akan dipanggil
sampai ada library yang mengembalikan nilai `true`, proses pengiriman sms akan 
dihentikan di sini.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-sms
```

## Penggunaan

Module ini menambahkan satu libray yang bisa digunakan aplikasi untuk mengirim SMS
dengan nama `LibSms\Library\Sms`.

```php
use LibSms\Library\Sms;

$phone   = '0857100111111';
$message = 'Message to send';

if(!Sms::send($phone, $message))
    deb(Sms::lastError());
```

Jika ingin membatasi pengiriman SMS hanya menggunakan suatu library atau beberapa
library saja, maka tambahkan parameter ketiga list library yang akan digunakan:

```php
use LibSms\Library\Sms;

$phone   = '0857100111111';
$message = 'Message to send';
$libs    = ['zenziva', 'twilio'];

if(!Sms::send($phone, $message, $libs))
    deb(Sms::lastError());
```

Perintah di atas akan mengirimkan SMS menggunakan library `zenziva`, dan hanya jika
module tersebut mengembalikan nilai false, maka library `twilio` akan digunakan.

## SMS Sender

Module sender harus memiliki satu library untuk digunakan oleh module ini
untuk mengirim SMS. Library tersebut harus mengimplementasikan interface 
`LibSms\Iface\Sender`. Library tersebut harus memiliki method sebagai berikut:

### send(string $phone, string $message): bool

### lastError(): ?string

### lastErrno(): ?int

## Konfigurasi

Masing-masing library sender harus mendaftarkan library mereka didalam konfigurasi module/aplikasi
dengan cara seperti di bawah:

```php

return [
    'libSms' => [
        'senders' => [
            '$name' => '$class',
            'zenziva' => 'LibSmsZenziva\\Library\\Sender'
        ]
    ]
];
```