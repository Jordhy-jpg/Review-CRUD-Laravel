# WebDev 101 w/ Laravel  
Make sure smua ini ud ad:  
```sh
php -v
composer -V
node -v
npm -v
```
## Setup:  
1. Run `composer create-project laravel/laravel <project-name>` buat bikin project laravel ny
    * Note: Laravel punya BINUS itu v11 tpi klo dicoba create-project pake v11 g bs/g dikasih kykny grgr 2 vulnerability CVE 9 yg kmrn :p  
    Tpi shrsny pake v13 g mslh; semua function ny msh bsbs aj.

2. Buat contoh ini w pake project-name = laravel-CRUD. cd ke project dir ny (`cd laravel-CRUD`)

3. Run `composer require laravel/ui && php artisan ui bootstrap` buat install & setup scaffolding bootstrap. Abis run command ini, di folder `resources` bakal muncul folder `sass` trus di folder `js` bakal muncul file `bootstrap.js`

4. Commonly: configuration static files (alias file css & js) utk sebuah project itu ad di 1 file yg namany `app.<css|scss|js>` utk styles & scripts. Di `resources/js/` kn ad file `bootstrap.js`. Import file itu ke `app.js` dgn cara add line: `import './bootstrap'`
    * Note: `import './bootstrap';` dan `import 'bootstrap';` itu beda.  
    `'bootstrap'` itu package bootstrap yg ad dri npm node_modules. `'./bootstrap'` itu file bootstrap.js yg ad di directory yg sama. Notice that `resources/js/bootstrap.js` ud import bootstrap duluan jd lgsg import ./bootstrap aj

5. `php artisan ui bootstrap` ud download config buat bootstrap ny tpi packages ny sendiri blom di download. Run `npm install && npm install axios`(file bootstrap.js perlu axios) buat download packages ny.

6. Done.
