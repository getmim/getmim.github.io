---
layout: post
title:  "Email Subscriber"
date:   2016-01-18 01:01:01 +0700
categories: ext-module
---

Adalah module penengah email subsciber. Module ini tidak bisa berdiri
sendiri, harus ada module lain yang bertugas berhubungan langsung dengan
provider email subscriber. Module lain yang mungkin bisa digunakan untuk
saat ini adalah:

1. [lib-esub-mailchimp](https://github.com/getmim/lib-esub-mailchimp)
1. [lib-esub-kirim-email](https://github.com/getmim/lib-esub-kirim-email)

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-esub
```

## Module Penghubung

Module penghubung harus mendaftarkan diri pada konfigurasi tentang 
keberadaanya dengan cara seperti di bawah:

```php
return [
    // ...
    'libEsub' => [
        'handler' => 'Class'
    ]
    // ...
];
```

Hanya boleh satu handler email subscriber yang ditangani oleh module ini.

Masing-masing handler harus mengimplemenetasikan interface `LibEsub\Iface\Handler`.
Dengan begitu masing-masing handler harus memiliki method-method seperti di bawah:

### get(int $rpp, int $page): object

Mengambil semua daftar email subscriber dengan bentuk response seperti di bawah:

```php
$result = (object)[
    'total' => :int,
    'emails' => [
        (object)[
            'id' => :mixed,
            'email' => :string,
            'name' => (object)[
                'full' => :string,
                'first' => :string,
                'last' => :string
            ],
            'created' => :string(Y-m-d H:i:s)
        ],
        ...
    ]
];
```

### addMember(string $email, string $fname=null, string $lname=null): ?object

Menambahkan satu email subscriber, fungsi ini mengembalikan object subscriber
sama seperti method `getMember` jika berhasil, atau `null` jika gagal.

### getMember(string $email): ?object

Mengambil satu subscriber berdasarkan email, fungsi ini mengembalikan object
seperti di bawah jika berhasil, atau null jika gagal.

```php
$result = (object)[
    'id' => :mixed,
    'email' => :string,
    'name' => (object)[
        'full' => :string,
        'first' => :string,
        'last' => :string
    ],
    'created' => :string(Y-m-d H:i:s)
];
```

### removeMember(string $email): bool

### lastError(): ?string

## Penggunaan

Module ini membuka satu class dengan nama `LibEsub\Library\Subsciber` yang bisa
digunakan untuk memenej email subscriber:

```php
use LibEsub\Library\Subsciber;

Subsciber::get($rpp, $page);
Subsciber::addMember($email, $fname, $lname);
```