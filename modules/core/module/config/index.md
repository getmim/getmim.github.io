---
layout: post
title:  "Konfigurasi Module"
date:   2015-01-11 08:44:45 +0700
categories: module
---

Konfigurasi module disimpan di folder utama module itu sendiri, yaitu 
`./modules/[name]/config.php`. Bentuk umum konfigurasi suatu module adalah
sebagai berikut:

```php
// ./modules/cmod/config.php

return [
    '__name' => 'cmod',
    '__version' => '0.0.1',
    '__git' => 'https://github.com/getmim/cmod.git',
    '__license' => 'MIT',
    '__author' => [
        'name' => 'Author',
        'email' => 'author@email.com',
        'website' => 'author.website.com'
    ],
    '__files' => [
        'modules/cmod' => ['install', 'update', 'remove'],
        'app/cmod' => ['install', 'remove'],
        'etc/log/cmod' => ['remove'],
        'modules/cmod/Cmod.php' => ['opsolete']
    ],
    '__dependencies' => [
        'required' => [
            [ 
                'mod0' => 'https://github.com/getmim/mod0.git'
            ],
            [
                'mod1' => 'https://github.com/getmim/mod1.git',
                'mod2' => 'https://github.com/getmim/mod2.git'
            ]
        ],
        'optional' => [
            [ 
                'mod3' => 'https://github.com/getmim/mod3.git'
            ],
            [
                'mod4' => 'https://github.com/getmim/mod4.git',
                'mod5' => 'https://github.com/getmim/mod5.git'
            ]
        ],
        'composer' => [
            'google/apiclient' => '^2.0'
        ]
    ],
    '__inject' => [
        [
            'name' => 'name',
            'question' => 'Application name',
            'rule' => '!^.+$!'
        ],
        [
            'name' => 'version',
            'question' => 'Application version',
            'default' => '0.0.1',
            'rule' => '!^[0-9]+\.[0-9]+\.[0-9]+$!'
        ],
        [
            'name' => 'host',
            'question' => 'Application hostname ( without scheme )',
            'rule' => '!^[a-z0-9-\.]+$!'
        ],
        [
            'name' => 'timezone',
            'question' => 'Application timezone',
            'default' => 'Asia/Jakarta',
            'rule' => '!^.+$!'
        ],
        [
            'name' => 'install',
            'question' => 'Application installation time',
            'default' => [
                'class' => 'Mim\\Provider\\Cli',
                'method' => 'dInstall'
            ],
            'rule' => '!^.+$!'
        ],
        [
            'name' => 'secure',
            'question' => 'HTTP scheme',
            'default' => 1,
            'options' => [
                1 => 'https',
                2 => 'http'
            ]
        ],
        [
            'name' => '__gitignore',
            'question' => 'Would you like to keep the modules dir in repository',
            'default' => false,
            'rule' => 'boolean',
            'injector' => [
                'class' => 'Mim\\Provider\\Cli',
                'method' => 'iGitIgnore'
            ]
        ],
        [
            'name' => 'gates',
            'children' => [
                [
                    'name' => [
                        'question' => 'Add new gate. Gate name',
                        'rule' => '!^[a-z0-9-]*$!'
                    ],
                    'children' => [
                        [
                            'name' => 'host',
                            'question' => 'New gate host name',
                            'default' => 'HOST',
                            'rule' => '!^.+$!'
                        ],
                        [
                            'name' => 'path',
                            'question' => 'New gate path name',
                            'default' => '/',
                            'rule' => '!^.+$!'
                        ]
                    ]
                ]
            ]
        ],
        [
            'name' => 'logs',
            'children' => [
                [
                    'name' => 'access',
                    'question' => 'Log all access',
                    'rule' => 'boolean'
                ],
                [
                    'name' => 'curl',
                    'question' => 'Log all curl actions',
                    'rule' => 'boolean'
                ],
                [
                    'name' => 'error',
                    'question' => 'Log all error',
                    'rule' => 'boolean'
                ]
            ]
        ]
    ],
    '__gitignore' => [
        'etc/log/cmod' => true
    ],
    'autoload' => [
        'classes' => [
            'Cmod\\Controller\\MainController' => [
                'type' => 'file',
                'base' => 'modules/cmod/controller/MainController.php'
            ],
            'Cmod\\Library' => [
                'type' => 'psr0',
                'base' => 'modules/cmod/library'
            ],
            'Cmod\\ThirdParty' => [
                'type' => 'psr4',
                'base' => 'modules/cmod/third-party/ThirdParty'
            ],
            'Cmod\\Service' => [
                'type' => 'file',
                'base' => 'modules/cmod/system/Service.php',
                'children' => 'modules/cmod/service'
            ],
            '-dont-use-namespace-' => [
                'type' => 'psr0',
                'base' => 'modules/cmod/third-party/Google',
                'prefix' => 'Google'
            ]
        ],
        'files' => [
            'modules/cmod/helper/global.php' => true
        ]
    ],
    'gates' => [
        'site' => [
            'host' => [
                'value' => 'HOST'
            ],
            'path' => [
                'value' => '/'
            ]
        ]
    ],
    'routes' => [
        'site' => [
            'siteCmod' => [
                'path' => [
                    'value' => '/cmod'
                ],
                'handler' => 'Cmod\\Controller\\Main::index'
            ]
        ]
    ],
    'service' => [
        'cmod' => 'Cmod\\Service\\CmodPublic',
        'cmod_p' => 'Cmod\\Service\\CmodPrivate'
    ],
    'server' => [
        // format
        $module => [
            $label => $Class::$method
        ],
        
        // contoh
        'cmod' => [
            'PHP >= 7.2' => 'Cmod\\Server\\PHP::version'
        ]
    ],
    'callback' => [
        '/module/' => [
            '/event/' => [
                'Class::method' => true
            ]
        ]
    ]
];
```

Semua properti konfigurasi yang diawali denga dua underscore (`__`) tidak akan
diikutkan dalam penggabungan dengan konfigurasi aplikasi, dan tidak bisa diakses
melalui service [config](/modules/core/app/service/config/).

Keterangan nilai dari masing-masing konfigurasi adalah sebagai berikut:

**__name**

Adalah nama module, nama module hanya boleh menggunakan karakter `a-z`, `0-9`, `-_.`.
Nama folder module harus sama persis dengan nama module.

**__version**

Properti ini menyimpan versi module dengan format `NN.NN.NN`. Tidak adak spesifikasi
khusus untuk pengaturan bagaimana suatu versi dinaikan. Semuanya diserahkan kepada
developer.

**__git**

Properti ini menyimpan alamat repository di mana module ini disimpan.

**__license**

Adalah lisensi module ini.

**__author**

Properti ini berisi informasi developer yang membuat module ini. Properti ini
berisi tiga properti yaitu `name`, `email`, dan `website`.

**__files**

Berisi daftar file module dan rule-rule nya pada saat instalasi. Properti ini
menyimpan nilai array key-value pair di mana `key` adalah nama file atau folder,
sementara `value` adalah array rule yang adalah gabungan `install`, `update`,
`remove`, dan `obsolete`.

1. `install`  
    File/folder akan dimasukan ke aplikasi pada saat instalasi, tapi tidak menindih jika
    file sudah ada.
1. `update`  
    File/folder akan dimasukan ke aplikasi pada saat update module, dan akan menindih
    jika file sudah ada.
1. `remove`  
    File/folder akan dihapus dari aplikasi pada saat module dihapus.
1. `opsolete`  
    File/folder akan dihapus dari aplikasi pada saat update module.

**__dependencies**

Berisi daftar module yang dibutuhkan, atau pendukung yang mungkin akan ditanyakan
untuk diinstal berbarengan dengan instalasi suatu module. Semua module yang didaftarkan
di properti `required` akan selalu diinstal, sementara daftar module yang ada
di bawah properti `optinal` akan ditanyakan kepada user sebelum diinstal.

Pada suatu kondisi, mungkin ada kebutuhan harus menginstal salah satu dari beberapa
module yang ada, maka masing-masing module di tambahkan pada array seperti contoh
module `mod1` dan `mod2` di atas. Contoh seperti ini mungkin ada ketika menginstal
driver cache di mana driver harus diinstal, tapi boleh menggunakan driver apa saja,
seperti driver file atau driver redis, dan lain-lain.

Properti `composer` adalah module composer yang perlu di install menggunakan
`composer`, pastikan `composer` terpasang di sistem. Semua module pada properti
ini  akan selalu di instal.

**__inject**

Adalah daftar konfigurasi yang akan diinjek ke konfigurasi aplikasi pada saat
instalasi. Ketika memasang module dengan perintah `cli app install /module/`,
daftar konfigurasi ini akan ditanyakan ke user untuk dituliskan ke konfigurasi
aplikasi.

Properti akhir juga menerima properti `default` yang akan dijadikan nilai standar
jika user tidak mengisi data. Nilai dari properti ini juga bisa array class/method
yang akan dipanggil oleh cli untuk menentukan nilai default.

Jika nilai yang diberikan user masih perlu di proses, maka bisa menambahkan opsi
`injector` yang berisi class dan method yang akan di panggil dengan parameter
pertama nilai konfigurasi aplikasi, dan parameter kedua adalah nilai yang diinput
user dari pertanyaan ini.

Nilai yang diterima properti `rule` adalah seperti berikut di bawah:

1. `boolean`
2. `any`
3. `number`
4. `regex`
5. `array`

Jika menggunakan array class/method, maka nilai yang dikembalikan oleh fungsi
diharapkan dalam format array sebagai berikut:

```php
return [
    'value' => "New value to use",
    'error' => 'Error description'
];
```

Dimana nilai dari `value` adalah nilai yang akan digunakan di config, dan nilai
dari error adalah string deskripsi error jika tidak valid, atau `false` jika valid.

**__gitignore**

Daftar konten yang akan ditambahkan ke file `.gitignore` aplikasi. Masing-masing
module mungkin memiliki file-file aplikasi yang tidak perlu diikutkan ke repository.
Pada konfigurasi ini didaftarkan semua rule-rule `.gitignore`. Konfigurasi ini
tidak bisa diakses dari service [config](/modules/core/app/service/config/).

**autoload**

Properti ini berisi daftar autoload file atau class. Semua daftar file yang ada
di properti `files` akan diload pada saat aplikasi dijalankan jika nilai konfigurasi
tersebut adalah `true`. Sementara konten yang ada di properti `classes` diload
hanya jika dibutuhkan.

Dukungan autoload untuk saat ini adalah `file`, `psr0` dan `psr4`.

Jika target base adalah folder, maka nama class yang didefinisikan di konfigurasi
dianggap sebagai prefix namespace.

Jika target adalah file, dan memiliki properti `children`, maka semua file di dalam
folder `children` akan dianggap menggunakan parent namespace yang didaftarkan di sini.

Jika namespace prefix di awali dan diakhiri dengan `-`, maka namespace tersebut tidak
diikutkan pada class namespace.

Untuk `psr0`, properti `prefix` bisa digunakan untuk prefix class name.

Untuk tipe `file` atau `psr4`, nilai `base` dan `children` boleh menggunakan array jika
class tersimpan di tempat yang berbeda, seperti `app/[module]/controller` dan `modules/[module]/controller`.

**gates**

Sebuah module diperbolehkan membuat gate sendiri, atau menggunakan gate yang sudah
disediakan oleh aplikasi. Konfigurasi ini berisi informasi gate yang didaftarkan
oleh module. Silahkan mengacu pada [gate](/modules/core/gates/)
untuk informasil lebih lanjut tentang konfigurasi ini.

**routes**

Adalah daftar routes yang dilayani module ini. Silahkan mengacu pada 
[route](/modules/core/app/routes/) untuk informasi lebih lanjut
tentang konfigurasi ini.

**service**

Adalah daftar service yang disediakan oleh module. Silahkan mengacu pada
[service](/modules/core/app/service/) untuk informasi lebih lanjut
tentang konfigurasi ini.

**server**

Konfigurasi ini meyimpan daftar test server yang akan digunakan oleh
cli untuk menentukan apakah instalasi server sudah bisa digunakan untuk
menjalankan aplikasi. Sebaiknya masing-masing module menyimpan test server
di sub konfigurasi dengan nama modulenya masing-masing.

Properti `$label` akan ditampilkan ke user, dan `$Class::$method` adalah class
handler yang akan dipanggil untuk menentukan apakah server sudah sesuai atau belum.

Nilai `$Class::$method` akan dipanggil secara static. Nilai yang dikembalikan oleh
pemanggilan fungsi tersebut harus array dengan dua key, yaitu `success` yang berisi
boolean `true` jika berhasil, atau `false` jika gagal. Key yang kedua adalah `info`
yang berisi informasi hasil test, nilai ini boleh empty string.

```php
// ./modules/cmod/server/PHP.php

namespace Cmod\Server;

class PHP {
    static function version(){
        return [
            'success' => version_compare(PHP_VERSION, '7.2', '>='),
            'info' => PHP_VERSION
        ];
    }
}
```

**callback**

Adalah bagian yang menyimpan informasi callback yang akan dipanggil ketika suatu event terjadi
pada aplikasi. Beberapa module/event yang sudah ada adalah:

1. `app`
    1. `reconfig` Callback yang akan dipanggil ketika aplikasi sedang membuat ulang konfigurasi
    aplikasi dengan perintah `mim app config`.
1. `core`
    1. `ready` Dipanggil ketika system sudah siap dijalankan, tapi belum masuk ke router
    1. `printing` Dipanggil ketika system sudah selesai menggenerasi view, dan siap mengirimkan
    response kembali ke user. Jika salah satu callback disini mengembalikan nilai `false`, maka
    system akan membatalkan pengiriman konten ke client.

Class handler akan di panggil dengan perintah:

```php
$Class::$method($configs, $here);
```

Dimana `$configs` adalah semua konfig yang sudah terkumpul, dan `$here` adalah folder aplikasi
dimana proses konfig ini berjalan.

Di bawah ini adalah contoh reconfig yang benar:

```php
class Class{
    static function reconfig(object &$configs, string $here) {
        $configs->lorem = 'ipsum';
    }
}
```