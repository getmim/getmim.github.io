---
layout: post
title:  "Notif Pusher"
date:   2016-01-15 01:01:02 +0700
categories: ext-module lib-notif
---

Adalah library untuk mengirim notifikasi melalui pusher.com. Silahkan
mendaftarkan akun di [pusher.com](https://pusher.com/) untuk mendapatkan
informasi koneksi api.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-notif-pusher
```

## Konfigurasi

Pastikan menambahkan konfigurasi seperti di bawah pada konfigurasi
aplikasi:

```php
return [
    // ...
    'libNotifPusher' => [
        'id' => '000000',
        'key' => 'b8ef99afd9f9sdf9ad9f',
        'secret' => '08b9fa9df9asd9f9asd9',
        'cluster' => 'ap1'
    ]
    // ...
];
```

Konfigurasi tersebut juga ditanyakan oleh cli jika module ini diinstall
melalui cli.

## Pengunaan

Module ini menyediakan satu library yang bisa digunakan untuk berinteraksi
dengan class pusher, class tersebut adalah `LibNotifPusher\Library\Notif`.

Semua fungsi [pusher-http-php](https://github.com/pusher/pusher-http-php) bisa
di panggil dari library ini dengan static function.

```php
use LibNotifPusher\Library\Notif;

// mengirim ke satu channel
Notif::trigger('my-channel', 'my_event', 'hello world');

// Mengirim ke beberapa channel
Notif::trigger(['channel-1', 'channel-2'], 'my_event', 'hello world');

// Mengirim ke banyak
$batch = array();
$batch[] = array('channel' => 'my-channel', 'name' => 'my_event', 'data' => array('hello' => 'world'));
$batch[] = array('channel' => 'my-channel', 'name' => 'my_event', 'data' => array('myname' => 'bob'));
Notif::triggerBatch($batch);
```

Silahkan mengacu pada dokumentasi pusher-http-php untuk informasi lebih
lanjut tentang cara penggunaannya, dan method-method lain.

## Lisensi

Karena module ini menggunakan library yang disediakan oleh pusher, silahkan
mengacu pada library tersebut untuk lisensi.