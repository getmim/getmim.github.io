---
layout: post
title:  "CLI"
date:   2015-01-12 07:44:45 +0700
categories: cli
---

Sebagian besar aktifitas development dengan framework mim tidak bisa terlepas dari
penggunaan CLI. Banyak pekerjaan-pekerjaan yang dipermudah, dan banyak juga pekerjaan
hanya bisa dikerjakan melalui CLI.

## Instalasi

```
wget http://getmim.github.io/tools/installer.php
php installer.php
```

Fungsi di atas akan mendownload installer tools ini dan memasangnya pada pc. Module
yang dipasang dengan menjalankan perintah di atas adalah module `core`, `cli`, dan
`cli-app`.

## Perintah

Di bawah ini adalah perintah-perintah yang didukung oleh module ini secara default.
Untuk mendukung perintah-perintah lainnya, silahkan memasang module yang bersangkutan.

```
mim apps
mim help
mim version

# Jika module cli-app terinstall

mim app config
mim app env (production|development|testing|...)
mim app gitignore
mim app init
mim app install (module[ ...]) | -
mim app list
mim app module
mim app remove (module[ ...]) | -
mim app server
mim app update (module[ ...]) | -

# Jika module cli-app-model terinstall

mim [--table=...,...] app migrate db
mim [--table=...,...] app migrate schema (:dirname)
mim [--table=...,...] app migrate start
mim [--table=...,...] app migrate test

# Jika module cli-app-worker terinstall

mim app worker start
mim app worker stop
mim app worker status
mim app worker pid

# Jika module cli-module terinstall

mim module init
mim module controller (name)
mim module git
mim module helper (name)
mim module interface (name)
mim module library (name)
mim module middleware (name)
mim module model (name)
mim module service (name)
mim module watch (target[ ...])
mim module sync (target[ ...])

# Jika module cli-compress terinstall

mim compress (all|gzip|brotli|webp) (file[ ...])
```