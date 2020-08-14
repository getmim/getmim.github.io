---
layout: post
title:  "reCAPTCHA"
date:   2016-02-08 01:01:01 +0700
categories: ext-module
---

Library untuk bekerja dengan google reCAPTCHA v3.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-recaptcha
```

## Konfigurasi

Tambahkan konfigurasi seperti di bawah pada konfigurasi aplikasi yang
berisi informasi site key untuk reCAPTCHA. Dapatkan sitekey di [sini](https://g.co/recaptcha/v3).
Pastikan memilih versi 3.

```php
return [
    'libRecaptcha' => [
        'sitekey' => '...',
        'sitesecret' => '...'
    ]
];
```

## Penggunaan

Tambahkan script seperti berikut di template untuk menambahkan captcha di suatu halaman:

```php
<form method="POST">
    <input type="hidden" id="recaptcha" name="recaptcha">
</form>

<?php $sitekey = $this->config->libRecaptcha->sitekey; ?>

<script src="https://www.google.com/recaptcha/api.js?render=<?= $sitekey ?>"></script>
<script>
    grecaptcha.ready(() => {
        let opts = {
            action: 'homepage' // homepage, login, social, e-commerce
        }
        grecaptcha.execute('<?= $sitekey ?>', opts)
            .then(token => {
                document.querySelector('#recaptcha').value = token
            })
    });
</script>
```

Perhatikan bahwa kita menyimpan token dari recaptcha ke input hidden. Nilai
tersebut akan digunakan untuk verifikasi request dari backend.

Module ini menambah satu library dengan nama `LibRecaptcha\Library\Validator`
yang bisa digunakan untuk memverifikasi suatu request:

```php

use LibRecaptcha\Library\Validator;

    // ...
    $token = $this->req->getPost('recaptcha');

    if(is_null(Validator::validate($token)))
        die('You\'re robot');

    echo 'Welcome';
    // ...
```