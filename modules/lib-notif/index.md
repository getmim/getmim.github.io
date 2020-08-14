---
layout: post
title:  "Notif"
date:   2016-01-15 01:01:03 +0700
categories: ext-module
---

Adalah module untuk penengah pengiriman notifikasi.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-notif
```

## Penggunaan

Module ini menambah satu library dengan nama `LibNotif\Library\Notif` yang bertugas untuk
mengirimkan notifikasi:

```php
use LibNotif\Library\Notif;

// ...
$meta = [
    'target' => [1,2,3],
    // 'target' => 12,
    'title'  => 'New Friend Request',
    'info'   => 'You have new friend request. Tap here for more info'
];
$data = ['a' => 'b'];
$providers = null;

Notif::send($meta, $data, $providers);
// ...
```

## Handler

Module ini hanya bertugas sebagai penengah antara aplikasi dan notif provider seperti gcm,
pusher, dll. Masing-masing provider harus membuatkan satu library yang mengimplementasikan
interface `LibNotif\Iface\Handler` dan mendaftarkan pada konfigurasi aplikasi/module seperti
di bawah:

```php
return [
    'libNotif' => [
        'handlers' => [
            'name' => 'Namespace\\Library\\Class'
        ]
    ]
];
```

Library handler harus memiliki method sebagai berikut:

### static function send(array $meta, $data): bool

### static function lastError(): ?string