---
layout: post
title:  "Notif FCM"
date:   2016-01-15 01:01:03 +0700
categories: ext-module lib-notif
---

Adalah library yang memungkinan mengirim messangging melalui
google fcm.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-notif-fcm
```

## Konfigurasi

Dapatkan private key untuk 
[sevice account](https://console.firebase.google.com/project/_/settings/serviceaccounts/adminsdk)
google fcm anda dari 
[sini](https://console.firebase.google.com/project/_/settings/serviceaccounts/adminsdk), pilih
salah satu project yang tersedia, atau buatkan satu yang baru. Klik
**Generate New Private Key** dan lanjutkan dengan **Generate Key**. Simpan file tersebut
di folder `etc/cert/lib-notif-fcm/google-fcm.json`.

Dapatkan juga project id dari halaman di atas seperti `myproject-ef5bd`. Tambahkan konfigurasi
seperti di bawah pada konfigurasi aplikasi:

```php
return [
    'libNotifFcm' => [
        'projectId' => 'myproject-ef5bd'
    ]
];
```

Pastikan project bisa digunakan untuk mengirim fcm notifikasi dari halaman
[ini](https://console.developers.google.com/apis/api/fcm.googleapis.com/overview),
jangan lupa memilih project yang benar sebelum membolehkan service 
`Firebase Cloud Messaging API` di halaman tersebut.

## Penggunaan

Module ini membuat library global yang bisa digunakan untuk mengirim notifikasi
melalui google-fcm, library tersebut adalah `LibNotifFcm\Library\Notif`.

```php
use LibNotifFcm\Library\Notif;

Notif::send(
    [
        'message' => [
            'topic' => 'news',
            'notification' => [
                'title' => 'Breaking News',
                'body' => 'New news story available.'
            ],
            'data' => [
                'story_id' => 'story_12345'
            ]
        ]
    ]
);
```

Silahkan mengacu pada dokumentasi [google-fcm](https://firebase.google.com/docs/)
untuk metode pengiriman lainnya.