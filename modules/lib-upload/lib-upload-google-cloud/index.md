---
layout: post
title:  "Upload Google Cloud"
date:   2016-01-12 01:01:03 +0700
categories: ext-module lib-upload lib-media
---

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-upload-google-cloud
```

## Konfigurasi

Tambahkan konfigurasi seperti di bawah pada aplikasi:

```php
return [
    'libUploadGoogleCloud' => [
        // google cloud bucket name
        'bucket' => 'my-first-bucket',

        // path to service account credentials json file
        'cert_file' => 'etc/cert/credentials.json'
    ]
];
```