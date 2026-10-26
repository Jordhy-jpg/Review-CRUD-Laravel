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

6. Run `php artisan serve` buat make sure the app works. Welcome page ny may or may not look a lil fucked up but that's fine we're not gonna use that shi anyway yg penting g ad error dlu. Kebetulan Laravel skrg itu an "agent first" web framework whatever the hell that means basically laravel skrg di optimize utk vibe coding with maximum efficiency jd klo ad error di kanan atas ad 'Copy as Markdown'. Copy itu aj trus kasih ke codex jgn tny w w hantem lu

## Basic CRUD Web App | Tasks Manager
1. First thing to do when making a CRUD (noun) app is making a DB Model for the app to CRUD (verb).  
Run: `php artisan make:model Task --migration --factory --seed`  

| Command/Flag | Shit |
| --- | --- |
| `php artisan make:model` | Use artisan to make the DB Model |
| Task | nama Model ny |
| `--migration` | Automatically make the migration for the model |
| `--factory` | Automatically make the factory for the model |
| `--seed` | Automatically make the seeder for the model |

2. Next is to populate the Model and it's related table. Buat Task kt, kt pake 3 attribute aj:
    * title -> string
    * description -> string
    * completed -> boolean

Di file Model ny (`app/Models/Task.php`):
```php
class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    // Tambahin fillable ama casts ini
    protected $fillable = [
        'title',
        'description',
        'completed'
    ]; // $fillable itu eloquent (ORM ny laravel) convention yg ngedefine attribute dri model yg bs di assign secara manual oleh user (contoh: pake form). Knp perlu ini karena ad bbrp case dmn sebaikny kt enggk ksh user define attribute sebuah model (contoh: klo misal kt bikin User sbg FK dri Task (User--> has many of--> Task) kt g mau user bs manually define user mana yg bikin sebuah task. Seharusnya otomatis user yg buat task ny adl user yg jd FK task ny. Kt g ush setting data type ny di sini soalny itu di atur ama table DB & controller ny 

    protected $casts = [
        'completed' => 'boolean'
    ]; // Ini w rasa g penting tpi good to know aj. $casts itu eloquent convention jg dmn kt pastiin sebuah attribute direturn dlm php compatible format (contoh: tergantung pake DB apa sebuah boolean bs di return sbg true/false True/False 1/0. $casts ini make sure klo attribute completed itu direturn dlm format boolean ny php alias true/false)

    // Notice dua dua ny itu protected krn kt g mau something yg g related or worse: malicious bs access and/or change value dr attribute tsb. Why not private? Class ini msh harus bs diaccess ama Eloquent buat dia ngatur relationship antara PHP ama DB ny. Klo protected msh bs diaccess ama parent/child classes ny. Grgr Task extends Model dmn Model itu sebuah Class Eloquent, Eloquent bs pake. Klo private cm bs diaccess di dlm class sndiri jd Eloquent g bs pegang but if you wanna deal with the complex SQL to manage the data yourself go ahead --_--
}
```

Di file migration ny (`database/migrations/<some-date-and-time>_create_tasks_table.php`):
```php
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // Add these: $table-><data type>('<name>')-><any extra argument>
            $table->string('title');
            $table->string('description')->nullable(); // nullable alias user g perlu taro description. Klo title harus
            $table->boolean('completed')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    } // ignore this for now. Ini basically function yg bakal di execute klo kt mau rollback migrate ny
};
```

Klo uda: `php artisan migrate`
