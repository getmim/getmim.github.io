---
layout: post
title:  "User Api"
date:   2016-01-28 01:01:04 +0700
categories: admin lib-user
---

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install api-user
```

## Konfigurasi

```php
return [
    'apiUser' => [
        'formatter' => [
            // hapus suatu property user
            // sebelum dikembalikan ke client
            'remove' => [
                'email' => true,
                'phone' => true
            ]
        ]
    ]
];
```

## Endpoints

### `GET APIHOST/user?{q,rpp,page}`

### `GET APIHOST/user/(id|name)`

### `POST APIHOST/user {name,fullname,password}`

With `user-create` scope.
