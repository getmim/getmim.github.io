---
layout: post
title:  "Kontroler"
date:   2015-01-07 07:44:45 +0700
categories: aplikasi
---

Kontroler adalah bagian inti yang akan menangani request user. Sebagian besar logik
route berada di sini. Setiap ada request, objek kontroler baru akan dibuat untuk
menangani request tersebut. Semua kontroler di framework mim harus extends dari
class `Mim\Controller`.

Pada umumnya, masing-masing gate memiliki
[main kontroler](/modules/core/app/controller/gate/), dan route di
bawahnya extends dari main kontroler tersebut. Pada kondisi seperti ini, maka main 
kontroler gate yang harus extends dari `Mim\Controller`.

Nama kontroler harus berakhiran `Controller`, sementara yang di daftarkan di route
hanya nama tanpa teks `Controller`. Begitu juga dengan nama method untuk handling
route, harus diakhiri dengan `Action`. Lihat contoh di bawah:

```php
// ./modules/[name]/controller/UserController.php
class UserController extends \Mim\Controller
{
    // ...
    public function indexAction(){
        // logic
    }
}
```

```php
// ./modules/[name]/config.php
return [
    // ...
    
    'routes' => [
        'site' => [
            'siteUserList' => [
                'path' => '/user',
                // penulisan Class tanpa Controller
                // dan method tanpa Action
                'handler' => 'User::index'
            ]
        ]
    ],
    
    // ...
];
```

Pada contoh di atas, route dengan nama `siteUserList` menggunakan class `UserController`
dengan method `indexAction`, tapi yang dituliskan hanya `User` dan `index`.