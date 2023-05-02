<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Запуск

Запуск через Docker

- Запускаем файл docker-compose.yml
- sail artisan migrate
- sail artisan app:pars-courses (рапсим файл bm_rates.dat и записываем выгодный курс для каждой пары валют)

## REST API

API_TOKEN = dqwd454d5qwd45qwd4qwd5

- http://localhost/api/courses (получаем все выгодный курс для каждой пары валют), также можем передать GET параметры (send_currency либо receive_currency)
- http://localhost/api/course/19/10 (получаем курс по выбраной паре)
