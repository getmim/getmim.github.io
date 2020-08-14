---
layout: post
title:  "Service Request"
date:   2015-01-06 09:44:45 +0700
categories: aplikasi service
---

Service request adalah service yang menyediakan informasi tentang request yang
sedang berlangsung. Service request bisa diakses dari kontroler, service, dan
middleware dengan perintah `$this->req->$prop`.

## Properti

Properti yang dilayani service ini adalah:

### $accept

Konten tipe yang diterima oleh client, properti ini berisi objek dengan tiga properti
yaitu:

1. `encoding`  
   Array yang berisi daftar encoding yang diterima client.
1. `language`  
   Array bahasa yang diharapkan diterima client.
1. `type`  
   Content type yang diharapkan oleh client.

### $agent

Request user agent. Nilai dari properti sama dengan `$_SERVER['HTTP_USER_AGENT']`.

### $gate

Adalah properti yang berisi objek gate yang sedang berlangsung dari request ini.

```php
// Gates
//  'admin' => [
//      'host' => 'website.com',
//      'path' => '/admin'
//  ]
// Request:
// GET https://website.com/admin/statistic

$gate_name = $this->req->gate->name; // admin
$gate_path = $this->req->gate->path; // /admin
$gate_host = $this->req->gate->host; // website.com
```

### $host

Request hostname dari request yang sedang berlangsung.

```php
// Request:
// POST https://website.com/user/name/?page=1&rpp=2

$host = $this->req->host; // website.com
```

### $length

Berisi integer content-length yang dikirim user.

### $method

Berisi request method yang sedang berlangsung. Nilai ini sama dengan nilai yang 
ada pada `$_SERVER['REQUEST_METHOD']`.

```php
// Request:
// POST https://website.com/

$method = $this->req->method; // POST
```

### $param

Properti ini adalah objek yang menyimpan nilai parameter router.

```php
// Router
//  path = /user/:name/:tab
// Request
// GET http://website.com/user/mim/profile

$username = $this->req->param->name; // mim
$usertab  = $this->req->param->tab;  // profile
```

### $path

Berisi full path dari request yang sedang berlangsung dengan menghilangkan scheme,
hostname, dan query parameter. Properti ini juga akan menghilangkan trailing slash.

```php
// Request:
// POST https://website.com/user/name/?page=1&rpp=2

$path = $this->req->scheme; // /user/name
```

### $route

Properti yang menyimpan informasi route yang sedang berlangsung.

```php
// Routes
//  'adminStatistic' => [
//      'path' => '/statistic'
//  ]
// Request:
// GET https://website.com/admin/statistic

$route_path = $this->req->route->path; // /statistic
$route_name = $this->req->route->name; // adminStatistic
```

### $scheme

Request scheme yang sedang berlangsung, mungkin mengembalikan `http`, atau jika
konfigurasi `secure` aktif, maka akan mengembalikan nilai `https`.

```php
// Request:
// POST https://website.com/user/name/?page=1&rpp=2

$scheme = $this->req->scheme; // https
```

### $url

Berisi full url request yang sedang berlangsung.

```php
// Request:
// POST https://website.com/user/name/?page=1&rpp=2

$url = $this->req->url; // https://website.com/user/name/?page=1&rpp=2
```

## Method

Method yang dilayani service ini adalah:

### forward(string $name, array $params): void

Melanjutkan request ke suatu route, ke route lain tanpa melalui proses redirect.
Metode ini biasanya digunakan untuk route alternative suatu route lain.

### get(string $name=null, $def=null)

Method untuk mengambil nilai yang dikirim oleh user secara berurutan dari `_GET`,
`_POST`, `_FILES`, dan `php://input`.

Nilai dari `php://input` akan di parse hanya jika konten yang dikirim user dalam
`Content-Type` `application/json`. Selain itu, konten tidak di parse.

Jika parameter `name` dikosongkan atau `null`, maka semua data akan dikembalikan.
Dan mungkin `null`, string, atau empty array.

Jika nilai parameter `$def` di set, maka nilai tersebut akan dikembalikan jika
hasil pencarian menghasilkan `null`.

Mengambil satu query string, walaupun konten yang diminta ( `retry` ) ada di `_POST`,
konten dari `_GET` akan diutamakan:

```php
// Request
// POST /login?retry=1
//  DATA
//   retry=2&name=mim

$retry = $this->req->get('retry'); // 1.
```

Mengambil single field dari POST body:

```php
// Request
// POST /login?retry=1
//  DATA
//   retry=2&name=mim

$name = $this->req->get('name'); // mim.
```

Mengambil semua data yang dikirim user, fungsi ini akan menggabungkan nilai dari
`_GET`, `_POST`, dan `_FILES`. Jika data dari ketiga sumber tersebut tidak ada,
maka konten dari `php://input` akan dikembalikan.

```php
// Request
// POST /login?retry=1&password=123
//  DATA
//   - retry = 2
//   - name = mim

$name = $this->req->get(); // ['retry'=>1, 'name'=>'mim', 'password'=>'123']
```
Mengambil satu properti json dari body yang dikirim, system hanya akan memparse
JSON jika properti `Content-Type` adalah `application/json`:

```php
// Request
// Content-Type: application/json
// POST /login
//  DATA
//   {"retry": 2, "name": "mim"}

$name = $this->req->get('retry'); // 2
```

Mengambil semua data JSON yang dikirim:

```php
// Request
// Content-Type: application/json
// POST /login
//  DATA
//   {"retry": 2, "name": "mim"}

$name = $this->req->get(); // ['retry'=>2, 'name'=>'mim']
```
Mengambil konten body yang dikirim, jika header `Content-Type` bukan `application/json`,
maka konten akan dikembalikan apa adanya:

```php
// Request
// POST /login
//  DATA
//   NOT_JSON&WITHOUT_CONTENT_TYPE

$name = $this->req->get(); // NOT_JSON&WITHOUT_CONTENT_TYPE
```

### getBody($name=null, $def=null)

Method untuk mengambil satu nilai dari data body yang dikirimkan user. Fungsi ini
hanya bisa mengembalikan satu nilai jika konten yang dikirim menggunakan format
`application/json`. Jika konten tidak ditemukan, maka nilai parameter `$def` akan
dikembalikan. Jika parameter `$name` tidak di set, maka semua data akan dikembalikan
dalam format array.

Method ini hanya bisa memparse konten json. Jika body yang dikirim bukan json, dan
parameter `$name` di set, maka method ini akan selalu mengembalikan parameter `$def`.
Tapi jika parameter `$name` tidak di set, maka konten akan dikembalikan apa adanya
dari `php://input`.

### getCond(array $queries): array

Mengambil kondisi `where` dengan struktur model dari query string.

### getCookie(string $name, $def=null): ?string

Method untuk mengambil nilai cookie yang dikirimkan bersamaan dengan request yang
sedang berlangsung. Fungsi ini sama dengan perintah `$_COOKIE[$name]`. Jika cookie 
tidak ditemukan, maka `null` atau nilai dari parameter `$def` akan dikembalikan.

### getFile(string $name): array

Fungsi untuk mengambil data file yang dikirimkan. Fungsi ini sama dengan perintah
`$_FILES[$name]`.

### getIP()

Method untuk mengambil ip user dari http header yang dikirim. Nilai dari properti
ini diambil dari header di bawah secara berurutan:

1. HTTP_CLIENT_IP
1. HTTP_X_FORWARDED_FOR
1. HTTP_X_FORWARDED
1. HTTP_FORWARDED_FOR
1. HTTP_FORWARDED
1. REMOTE_ADDR

### getPager(int $rpp_default=12, int $rpp_max=24): array

Method untuk mengambil nilai pager suatu halaman. Nilai ini diambil dari query string `page` untuk
page dan `rpp` untuk result per page. Nilai yang dikembalikan cocok dengan fungsi `list` dimana nilai
pertama adalah `page`, dan nilai kedua adalah `rpp`.

### getPost(string $name=null, $def=null)

Method untuk mengambil satu nilai dari data yang dikirimkan melalu request body.
Jika konten tidak ditemukan, maka nilai dari parameter `$def` akan dikembalikan.
Jika parameter `$name` tidak diset, maka semua data akan dikembalikan dalam format
array. Method ini sama dengan memanggil perintah `$_POST[$name]`. Method ini tidak
akan memparse konten `php://input` walaupun konten tipe yang dikirim adalah
`application/json`.

### getQuery(string $name=null, $def=null)

Method untuk mengambil satu nilai dari query parameter. Jika konten tidak 
ditemukan, maka nilai dari parameter `$def` akan dikembalikan. Jika parameter
`$name` tidak di set, maka semua data akan dikembalikan dalam format array. Method
ini sama dengan memanggil perintah `$_GET[$name]`.

### getServer(string $name, string $def=null): ?string

Method untuk mengambil satu nilai dari `_SERVER`. Fungsi ini sebenarnya sama dengan
memanggil perintah `$_SERVER[$name]`. Jika konten tidak ditemukan, maka nilai dari
parameter `$def` akan dikembalikan.

### isAjax(): bool

Method untuk mengecek jika request yang berlangsung adalah dari ajax.

### isCLI(): bool

Method untuk mendapatkan informasi jika request yang berlangsung berasal dari CLI.

### setProp(string $name, $object): void

Fungsi untuk mengeset suatu properti ke service request yang kemudian bisa diambil
menggunakan perintah `$this->req->$name`.