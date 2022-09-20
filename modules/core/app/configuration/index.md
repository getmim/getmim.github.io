---
layout: post
title:  "Konfigurasi Aplikasi"
date:   2015-01-03 07:44:45 +0700
categories: aplikasi
---

Konfigurasi aplikasi disimpan di `./etc/config/main.php`. Pada saat nilai file
`./etc/.env` adalah `production` system akan menambahkan juga file
`./etc/config/production.php` jika file tersebut ada. Begitu juga dengan nilai 
`env` lainnya.

## Struktur

Bentuk di bawah adalah bentuk konfigurasi aplikasi minimal, nilai-nilai tersebut
bisa saja bertambah sesuai dengan kebutuhan aplikasi.

```php
// ./etc/config.php
return [
    'name' => 'Mim App',
    'version' => '0.0.1',
    'host' => 'site.mim',
    'timezone' => 'Asia/Jakarta',
    'install' => '2018-05-01 15:39:00',
    'secure' => true,
    'includes' => [
        '/path/to/dir/' => true,
        '/path/to/file/' => true
    ],
    'shared' => '/path/to/shared/modules/',
    'envMap' => [
        'SITE_SECURE' => 'gates.site.secure'
    ],
    
    'gates' => [
        'site' => [
            'host' => [
                'value' => 'HOST'
            ],
            'path' => '/',
            'priority' => 100,
            'secure' => true,
            'middlewares' => [
                'pre' => [
                    'Site\\Middleware\\Pre::auth' => 1
                ],
                'post' => [
                    'Site\\Middleware\\Post::format' => 1
                ]
            ]
        ]
    ],
    'repos' => [
        '/home/user/mim'
    ]
];
```

### name

Nama aplikasi, nilai ini mungkin ( tapi tidak harus ) digunakan di tag `<title>`
html.

### version

Adalah versi aplikasi. Bentuk yang digunakan adalah `NUM.NUM.NUM`. Version yang digunakan
mengikuti spesifikasi [semver](https://semver.org/).

### host

Adalah hostname aplikasi. Nilai ini akan digunakan jika pada `gates.[name].host.value`
menggunakan nilai `HOST`.

### timezone

Adalah nilai default timezone aplikasi.

### install

Nilai ini adalah tanggal dibuatnya aplikasi dalam format `Y-m-d H:i:s`. Tujuannya
sebagai referensi saja.

### secure

Nilai ini menerima nilai type `boolean` yang akan menentukan scheme url pada saat
menggenerasi url. Nilai `true` akan menghasilkan url dengan scheme `https`.

### includes

Menggabungkan konfig dari file lain ke dalam konfigurasi aplikasi.

### shared

Adalah folder dimana module-module shared disimpan. Semua module yang ada di folder
tersebut akan di-load ke dalam aplikasi, dan diperlakukan sebagai module internal.

### envMap

Inject konfigurasi aplikasi dari system env ( `getenv` ). Fungsi ini menerima nilai
array key sebagai system env, dan nilai adalah config key yang dipisahkan dengan `.`
untuk sub-config.

### gates

Konfigurasi ini mendaftarkan semua gate yang ada di aplikasi. Informasi yang ditentukan
di sini adalah hostname suatu gate, path prefix, prioritas, secure ( https atau http ), 
dan daftar middlewares yang akan dipanggil sebelum dan sesudah router handler.

Nilai string `HOST` pada property `gates.[gate].host.value` akan mengambil nilai `host`
pada konfigurasi aplikasi. Nilai ini juga menerima gabungan string dengan nilai
`HOST`, seperti `admin.HOST`.

Penjelasan lebih details tentang gate ada di [Gate Aplikasi](/modules/core/gates/).

Jika nilai `gates.[gate].secure` tidak di set, makan nilai `secure` dari aplikasi
akan digunakan.

### repos

Konfigurasi ini menyimpan daftar folder dimana module-module local disimpan untuk
mempermudah proses install atau update module-module lokal.

## Menindih Konfigurasi Module

Jika developer ingin menindih konfigurasi module, maka cara yang paling benar adalah
dengan menambahkannya di konfigurasi aplikasi. Semua konfigurasi module, yang ada
di konfigurasi aplikasi akan menindih yang ditentukan di konfigurasi module.

Dengan ketentuan seperti ini, sangat memungkinkan menambahkan semua nilai konfigurasi
module di konfigurasi aplikasi.
