---
layout: post
title:  "Middleware"
date:   2015-01-08 07:44:45 +0700
categories: aplikasi
---

Middleware adalah sesuatu seperti kontroler namun bukan bagian inti untuk menangai
request. Biasanya keberadaan middleware adalah untuk mempermudah proses kontroler
yang mungkin akan digunakan lagi oleh kontroler lain. Oleh sebab itu, satu middleware
biasanya digunakan oleh beberapa route.

Semua middleware di framework mim harus extends dari `Mim\Middleware`.

Sama seperti peraturan kontroler, nama middleware harus diakhiri dengan teks 
`Middleware`. Tapi ketika di daftarkan di route hanya nama saja. Begitu juga
dengan action nya, harus diakhiri dengan `Action`. Lihat contoh di bawah:

```php
// ./modules/[name]/middleware/AuthMiddleware.php

class AuthMiddleware extends \Mim\Middleware
{
    // ...
    public function loginAction(){
        // melanjutkan ke middleware selanjutnya
        // atau ke kontroler
        $this->req->next();
    }
}
```

```php
// ./modules/[name]/config.php

return [
    // ...
    
    'routes' => [
        'site' => [
            'siteUserIndex' => [
                'path' => '/user',
                'handler' => 'User::index',
                'middlewares' => [
                    'pre' => [
                        // penulisan Class tanpa Middleware
                        // dan method tanpa Action
                        'Auth::login' => 1
                    ]
                ]
            ]
        ]
    ]
    
    // ...
];
```

Pada contoh di atas, route dengan nama `siteUserIndex` menggunakan pre middleware
`AuthMiddleware` dengan action `loginAction`, tapi yang ditulis hanya `Auth` dan
`login`.

Pada umumnya, middleware harus memanggil perintah `$this->next()` untuk melanjutkan
request ke middleware selanjutnya, atau ke kontroler yang bertanggungjawab. Walaupun
bisa saja middleware tidak memanggil perintah tersebut karena alasan sesuatu, seperti
menghentikan proses request sebelum sampai ke kontroler karena user belum login.