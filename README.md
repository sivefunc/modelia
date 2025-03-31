# :art: Modelia
<div align="center">
    <img align="center"
        src="https://raw.githubusercontent.com/sivefunc/modelia/refs/heads/master/public/readme/Hero.png"
        style="width: 100%; max-width: 600px"
        alt="Hero page of Modelia "><br>
</div>
<p align="center">
    <a href="https://laravel.com">
        <img alt="Laravel v12.x" src="https://img.shields.io/badge/Laravel-v12.x-FF2D20?style=for-the-badge&logo=laravel">
    </a>
    <a href="https://vuejs.org">
        <img alt="VueJS v3.x" src="https://img.shields.io/badge/VueJS-v3.x-4FC08D?style=for-the-badge&logo=vue.js">
    </a>
    <a href="https://php.net">
        <img alt="PHP 8.2.x" src="https://img.shields.io/badge/PHP-8.2.x-777BB4?style=for-the-badge&logo=php">
    </a>
    <a href="https://filamentphp.com">
        <img alt="Filament 3.x" src="https://img.shields.io/badge/Filament-3.x-FDAE4B?style=for-the-badge&logo=filament">
    </a>
    <a href="https://tailwindcss.com">
        <img alt="Tailwind 3.x" src="https://img.shields.io/badge/Tailwind-3.x-06B6D4?style=for-the-badge&logo=tailwind css">
    </a>
    <a href="https://inertiajs.com">
        <img alt="Inertia 2.x" src="https://img.shields.io/badge/Inertia-2.x-9553E9?style=for-the-badge&logo=inertia">
    </a>
</p>

# :bookmark: Table of contents
1. [About](#about)
2. [Features](#features)
3. [Installation](#installation)
4. [Run](#run)

## :question: About <a name="about"></a>
Modelia is a web based program that generates images using the company [Stability](https://stability.ai/) stable diffusion based models through their RESTful API, although it currently just supports that company, it can expands to more generative models like [Dall-E 3](https://openai.com/index/dall-e-3/) or [MidJourney](https://www.midjourney.com/).

Modelia is not only a front-end to these generative models but also a back-end, allowing to save and manage images made by users.

## :gift: Features <a name="features"></a>
### Back-end
#### StatOverview
<div align="center">
    <img align="center"
        src="https://raw.githubusercontent.com/sivefunc/modelia/refs/heads/master/public/readme/StatOverview.png"
        style="width: 100%; max-width: 600px"
        alt="Stat Overview"><br>
</div>

#### Resources
<div align="center">
    <img align="center"
        src="https://raw.githubusercontent.com/sivefunc/modelia/refs/heads/master/public/readme/Resources.png"
        alt="Stat Overview"><br>
</div>

#### List/Create/View/Edit/ a Resource
| Create | Edit |
| :---:  		        | :---:    		        |
| ![1](https://raw.githubusercontent.com/sivefunc/modelia/refs/heads/master/public/readme/Create.png)| ![2](https://raw.githubusercontent.com/sivefunc/modelia/refs/heads/master/public/readme/Edit.png) |

| List | View |
| :---:  		        | :---:    		        |
| ![3](https://raw.githubusercontent.com/sivefunc/modelia/refs/heads/master/public/readme/List.png)| ![4](https://raw.githubusercontent.com/sivefunc/modelia/refs/heads/master/public/readme/View.png) |

### Front-end
| Create | Index |
| :---:  		        | :---:    		        |
| ![1](https://raw.githubusercontent.com/sivefunc/modelia/refs/heads/master/public/readme/ImageCreate.png)| ![2](https://raw.githubusercontent.com/sivefunc/modelia/refs/heads/master/public/readme/ImageIndex.png) |

## :file_folder: Installation <a name="installation"></a>
```sh
git clone https://github.com/sivefunc/modelia
composer install
cp .env.example .env
php artisan key:generate
npm install
php artisan migrate
php artisan db:seed
php artisan storage:link
php artisan shield:generate --all
php artisan shield:super-admin
```

## :computer: Run <a name="run"></a>
```sh
composer run dev
```

## Made by :link: [Sivefunc](https://github.com/sivefunc)
## Licensed under :link: [GPLv3](https://github.com/sivefunc/modelia/blob/master/LICENSE)
