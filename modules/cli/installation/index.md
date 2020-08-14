---
layout: post
title:  "Instalasi CLI"
date:   2015-01-12 08:44:45 +0700
categories: cli
---

Sebelum melakukan installasi, pastikan applikasi di bawah sudah terpasang
pada system Anda:

1. wget
1. autocomplete
	1. [bash-autocomplete](https://www.cyberciti.biz/faq/add-bash-auto-completion-in-ubuntu-linux/)
	1. [compsys](https://mads-hartmann.com/2017/08/06/writing-zsh-completion-scripts.html)
1. php-readline
1. unzip

Silahkan jalankan perintah di bawah untuk instalasi tools.

```bash
wget http://getmim.github.io/tools/installer.php
php installer.php
```

Sampai di sini, sebagian besar perintah cli sudah bisa digunakan. Perintah di atas
akan memasang module `core`, `cli`, dan `cli-app`. Agar cli bisa bekerja dengan
kompresi file atau module, maka silahkan install module `cli-module` dan 
`cli-compress` di folder instalasi cli:

```bash
mim app install cli-module cli-compress
```

Jalankan perintah `mim version` untuk memastikan cli sudah terpasang dengan benar:

```bash
mim version
Mim: PHP Framework
- cli 0.0.7
- cli-app 0.0.8
- cli-compress 0.0.1
- core 0.0.3
- lib-compress 0.0.1
```