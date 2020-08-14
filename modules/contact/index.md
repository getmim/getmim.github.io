---
layout: post
title:  "Contact"
date:   2017-01-02 01:01:01 +0700
categories: ext-module
---

Adalah module yang menangani contact page site. Setiap kontak masuk akan menambahkan pada tabel `contact` dan akan mengirim ke email admin juga.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install contact
```

## Konfigurasi

Pada umumnya, email yang dikirim ke admin berisi link untuk me-reply pesan tersebut. Tambahkan nama router yang
akan digunakan sebagai link:

```php

return [
    'contact' => [
        'replyRoute' => 'adminContactReply'
    ]
];
```

## Penggunaan

Module ini menambah satu library yang bisa didunakan untuk menambah konten kontak dan mengirim email
jika diperlukan. Library tersebut adalah `Contact\Library\Contact`:

```php
use Contact\Library\Contact;

$new_contact = [
    'fullname' => 'Iqbal Fauzi',
    'email'    => 'iqbal@localhost',
    'subject'  => 'Minta Kotak Advertizer',
    'content'  => '...'
];

Contact::add($new_contact);
```

Kemudian library tersebut juga digunakan untuk menambahkan reply dari admin:

```php
use Contact\Library\Contact;
use Contact\Model\Contact as MContact;

$new_reply = [
    'user'  => 1,
    'reply' => '...'
];

$contact = MContact::getOne(['id'=>1]);

Contact::reply($contact, $new_contact);
```