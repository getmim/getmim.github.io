---
layout: post
title:  "PHPMailer"
date:   2016-01-10 01:01:02 +0700
categories: ext-module lib-mail
---

Adalah sender module untuk module `lib-mail`. Module ini menggunakan
library [PHPMailer](https://github.com/PHPMailer/PHPMailer) untuk
mengirim email yang mendukung pengiriman dengan SMTP/POP.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-mail-phpmailer
```

## Konfigurasi

Tambahkan konfigurasi seperti di bawah pada aplikasi yang berisi informasi
auth server pengiriman email:

```php
return [
    'libMailPhpMailer' => [
        'SMTP'          => true,
        'Host'          => 'smtp.gmail.com',
        'SMTPAuth'      => true,
        'Username'      => 'mail@gmail.com',
        'Password'      => '/secret/',
        'SMTPSecure'    => 'tls',
        'Port'          => 587,
        'FromEmail'     => 'mail@gmail.com',
        'FromName'      => 'My Name'
    ]
];
```

## Lisensi

Module ini menggunakan library [PHPMailer](https://github.com/PHPMailer/PHPMailer).
Silahkan mengacu pada library tersebut untuk lisensi.