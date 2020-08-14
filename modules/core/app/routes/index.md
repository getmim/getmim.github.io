---
layout: post
title:  "Routes"
date:   2015-01-05 07:44:45 +0700
categories: aplikasi
---

Routes adalah peraturan-peraturan request method, path, dan domain yang menentukan
handler yang akan dijalankan. Handler dan middleware masing-masing module harus
terikat pada suatu route agar bisa dijalankan oleh aplikasi.

Pada umumnya, routes didaftarkan di konfigurasi module. Walaupun tidak menutup
kemungkinan peraturan-peraturan route di daftarkan di konfigurasi aplikasi untuk
menindih konfigurasi module.

Masing-masing route harus berada di bawah suatu gate.

## Struktur

Contoh di bawah adalah bentuk pendaftaran route yang umum:

```php
// ./modules/[name]/config.php

return [
    // ...
    
    'routes' => [
        // format
        $gate => [
            '404' => [
                'handler' => $Class::$method
            ],
            '500' => [
                'handler' => $Class::$method
            ],
            $route_name => [
                'info' => $description,
                'path' => [
                    'value' => $path,
                    'params' => [
                        $param_name => $param_type 
                    ]
                ],
                'method' => $method,
                'modules' => [
                    $module_name => $module_include
                ],
                'handler' => $Class::$method,
                'middlewares' => [
                    'pre' => [
                        $Class::$method => $order
                    ],
                    'post' => [
                        $Class::$method => $order
                    ]
                ]
            ]
        ],
        
        // contoh
        'site' => [
        
            'siteHome' => [
                'path' => [
                    'value' => '/'
                ],
                'handler' => 'Site::index'
            ],
            
            'siteSingleUser' => [
                'info' => 'Show single user profile',
                'path' => [
                    'value' => '/user/(:name)/(:tab)',
                    'params' => [
                        'name' => 'slug',
                        'tab' => ['profile', 'inbox']
                    ]
                ],
                'method' => 'GET',
                'handler' => 'User::single',
                'middlewares' => [
                    'pre' => [
                        'User::auth' => 1,
                        'User::validate' => 2
                    ],
                    'post' => [
                        'Formatter::format' => 1
                    ]
                ]
            ]
        ]
    ]
    
    // ...
];
```

Keterangan masing-masing properti adalah sebagai berikut:

### routes.$gate

Nilai `$gate` di sini adalah nama [gate](/modules/core/gates/)
di mana route ini didaftarkan. Route yang didaftarkan di bawah gate ini hanya bisa
diakses melalui gate tersebut.

### routes.$gate.404

Adalah route khusus untuk menangani error 404. Umumnya, gate controller memiliki
method `show404` yang akan memanggil handler yang didaftarkan di bawah route ini.

### routes.$gate.500

Adalah route khusus untuk menangani error 500. Umumnya, gate controller memiliki
method `show500(info)` yang akan memanggil handler yang didaftarkan di bawah route
ini.

### routes.$gate.$route_name

Nilai `$route_name` di sini adalah nama unik route ini, nilai keunikan ini harus
sampai antar gate. Itu artinya, satu nama route hanya bisa digunakan dalam satu 
aplikasi, nama yang sama tidak boleh di daftarkan di gate yang lain.

Tujuan utama adanya nama route adalah untuk mempermudah menggenerasi url ke suatu
route dari mana saja. Umumnya, perintah yang digunakan untuk menggenerasi url ke 
suatu route adalah `$this->router->to($name, $params, $query)`.

### routes.$gate.$route_name.info

Nilai dari property ini adalah informasi tentang gate ini, sebagai referensi saja.
Tapi pada CLI nilai ini yang akan ditampilkan pada saat user menjalankan `mim help`.

Pada route yang bukan cli, niali ini tidak digunakan.

### routes.$gate.$route_name.path

Nilai ini menyimpan filter path request. Nilai ini memiliki dua properti, yaitu
`value` dan `params`.

### routes.$gate.$route_name.path.value

Nilai ini menyimpan rule yang akan dicocokan dengan path request. Nilai properti
ini bisa menyimpan variabel jika di awali dengan `:`. Pada contoh di atas, nilai
`(:name)` bisa menerima custom value yang di tentukan oleh params.

### routes.$gate.$route_name.path.params

Daftar rule parameter path. Nilai dari properti ini adalah array `key-value` pair
yang mana `key` adalah nama parameter, dan `value` adalah rule yang akan di cocokan
dengan nilai url.

Rule yang dikenali sejauh ini adalah:

1. `any`  
   Menerima semua karakter. Atau dalam regex menjadi `.+`.
1. `slug`  
    Menerina karakter `A-Z`, `a-z`, `0-9`, `_`, dan `-`. Atau dalam regex menjadi
    `/[A-Za-z0-9_-]/`.
1. `number`  
    Hanya menerima karakter `0-9`. Atau dalam regex menjadi `/[0-9]/`.
1. `rest`  
    Menerima karakter apa saja, dan sampai path terakhir. Nilai ini akan cocok
    dengan semua karakter `/` di url.
1. `array`  
    Jika nilai adalah array, maka nilai yang diterima adalah salah satu dari
    opsi yang disediakan.

### routes.$gate.$route_name.method

Properti ini menyimpan request method yang akan dicocokan. Nilai yang diterima
adalah `POST`, `GET`, `PUT`, dan `DELETE`. Jika method yang diterima lebih dari
satu, maka pisahkan masing-masing method dengan `|`, contohnya, untuk menerima
method `POST` dan `PUT`, gunakan `POST|PUT`. Jika properti ini tidak di set,
maka nilai `GET` akan digunakan.

### routes.$gate.$route_name.modules

Properti ini bertujuan sebagai kondisional jika route ini diberlakukan atau tidak
dari keberadaan module lain. Route tidak digunakan jika salah satu atau semua
daftar module yang diset di properti ini tidak terinstall.

Properti ini berisi array `key-value` pair dimana `key` adalah nama module, dan
`value` adalah boolean.

### routes.$gate.$route_name.handler

Properti yang berisi nama class dan method yang akan dipanggil jika route tersebut
cocok dengan request yang sedang berlangsung.

### routes.$gate.$route_name.middlewares

Adalah daftar middleware yang akan ikut tereksekusi jika route ini cocok dengan
request yang sedang berlangsung. Konfigurasi ini memiliki dua properti yaitu
`pre` yang berisi daftar middleware yang akan dijalankan sebelum kontroler, dan
properti `post` yang berisi daftar middleware yang akan dijalankan setelah
kontroler dan hanya jika kontroler memanggil perintah `$this->next()`.