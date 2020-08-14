---
layout: post
title:  "Gate"
date:   2015-01-04 07:44:45 +0700
categories: aplikasi
---

Satu aplikasi mungkin memiliki beberapa base endpoint spesial. Contohnya, satu
aplikasi mungkin memiliki base endpoint untuk user, admin, dan api. Ketiga base
endpoint ini memiliki respon yang mungkin berbeda, aset yang berbeda, dan struktur
yang berbeda.

Pada framework mim, ketiga base endpoint ini disebut dengan istilah gate.

Pada saat suatu server diakses melalui suatu jaringan, maka koneksi ke server
selalu melalui suatu port. Nilai port ini yang akan digunakan oleh server untuk
menentukan siapa yang bertugas menangani koneksi tersebut. Ketika koneksi masuk
melalui port 80 atau 443, maka koneksi tersebut diteruskan ke apache atau nginx.

Prinsip ini juga yang digunakan pada istilah gate di framework mim. Masing-masing
gate memiliki pengenal `host` dan `path` yang akan menentukan base kontroler
mana yang digunakan untuk menangani request tersebut.

Pada umumnya, konfigurasi gate ditentukan di konfigurasi aplikasi, tapi tidak
menutup kemungkinan konfigurasi gate juga ditentukan oleh module.

## Struktur

Contoh di bawah adalah bentuk konfigurasi gate di aplikasi:

```php
// ./etc/config.php

return [
    // ...
    
    'gates' => [
        // format
        $name => [
            'host' => [                 // arr, required
                'value' => $host,
                'params' => []
            ]
            'path' => [                 // arr, required
                'value' => $path,
                'params' => []
            ],
            'asset' => [                // arr, optional
                'host' => $host 
            ],
            'priority' => $priority,    // int, default 1000
            'middlewares' => [          // arr, optional
                'pre' => [              // arr, optional
                    $Class::$method => $order
                ],
                'post' => [             // arr, optional
                    $Class::$method => $order
                ]
            ]
        ],
        
        // contoh #1
        'site' => [
            'host' => [
                'value' => 'HOST',
            ]
            'path' => [
                'value' => '/'
            ],
            'asset' => [
                'host' => 'HOST'
            ],
            'priority' => 1,
            'middlewares' => [
                'pre' => [
                    'Site\\Middleware\\User::auth' => 1,
                    'Site\\Middleware\\User::form' => 2,
                ],
                'post' => [
                    'Site\\Middleware\\Formatter::format' => 1
                ]
            ]
        ],
        
        // contoh #2
        'admin' => [
            'host' => [
                'value' => 'admin.HOST'
            ],
            'path' => [
                'value' => '/admin'
            ]
        ],
        
        // contoh #3
        'user_web' => [
            'host' => [
                'value' => '(:name).HOST',
                'params' => [
                    'name' => 'slug'
                ]
            ],
            'path' => [
                'value' => '/'
            ]
        ]
    ]
    
    // ...
];
```

### gates.$name

Nilai `$name` di sini adalah nama gate. Beberapa contoh nama gate yang umum digunakan
adalah `site`, `admin`, dan `api`.

### gates.$name.host

Adalah properti yang menyimpan filter hostname request. Properti ini berisi dua
properti, yaitu `value` dan `params`.

### gates.$name.host.value

Adalah nilai hostname untuk gate ini. Jika nilai ini tidak di set, maka nilai
`host` aplikasi akan digunakan. Jika nilai ini mengandung string `HOST`, maka nilai
tersebut akan diganti dengan nilai `host` pada konfigurasi aplikasi. Properti ini
mungkin berisi variabel dengan prefix `:` yang akan mencocokan dengan request
yang sedang berlangusung.

Nilai ini mungkin menerima nilai `CLI` yang artinya gate akan cocok jika request
berasal dari CLI.

### gates.$name.host.params

Nilai filter parameter variabel di hostname. Filter nilai ini sama dengan filter
yang ada pada [path router](/modules/core/app/routes/#routesgateroute_namepathparams).

### gates.$name.path

Adalah properti yang menyimpan filter request path. Properti ini berisi dua properti
yaitu `value` dan `params`.

### gates.$name.path.value

Adalah request path prefix yang digunakan untuk filter gate. Nilai standar website
pada umumnya adalah `/` sehingga semua request dianggap cocok. Jika nilai yang 
diisi adalah `/admin`, maka hanya request dengan prefix path `/admin` yang cocok.

Jika nilai `path` adalah `/api`, maka request di bawah dianggap cocok:

1. `/api`
1. `/api/me`
1. `/api/auth`
1. `/api/logout`

Sementara nilai di bawah dianggap tidak cocok:

1. `/home`
1. `/me`
1. `/auth`
1. `/apix`

Dengan begitu, suatu aplikasi mungkin memiliki gate yang berbeda untuk `http://web.com/`
dan `http://web.com/admin`.

### gates.$name.path.params

Nilai filter parameter variabel di path. Filter nilai ini sama dengan filter
yang ada pada [path router](/modules/core/app/routes/#routesgateroute_namepathparams).

### gates.$name.asset

Adalah konfigurasi asset static file suatu gate. Jika nilai ini tidak di set, maka system akan
menggunakan informasi host sesuai dengan properti `host.value`.

### gates.$name.asset.host

Adalah hostname asset static file suatu gate. Properti ini menerima variabel seperti properti `host.value`
dan nilai masing-masing variabel akan diambil dari request yang sedang berlangsung sesuai dengan nilai
`host.params`.

### gates.$name.priority

Nilai ini digunakan untuk mengurutkan gate mana yang akan di proses terlebih dahulu
pada saat proses penentuan request gate. Jika tidak di set, maka nilai yang digunakan
adalah `1000`.

### gates.$name.middlewares

Properti ini menentukan daftar middleware yang akan dijalankan ketika request melalui
gate ini. Konfigurasi ini memiliki dua properti yaitu `pre` yang akan dijalankan
sebelum kontroler router dijalankan, dan `post` yang akan dijalankan setelah
kontroler router dijalankan dan hanya jika kontroler router memanggil perintah
`$this->next()`.

Nilai masing-masing key `pre` dan `post` adalah key-value pair dimana `key` nya adalah
nama class dengan method yang akan di panggil, dan nilai `value` nya adalah urutan
middleware tersebut di panggil.