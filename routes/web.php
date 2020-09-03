<?php

use Dotenv\Result\Result;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/posts', 'BlogPostController@index');

// Route::get('/posts', [
//     'uses' => 'BlogPostController@index', // koks kontroleris naudojamas
//     'as' => 'posts.index' // route’o vardas
// ]);

//GET ALL-READ
Route::get('/posts', 'BlogPostController@index')->name('posts.index');
//GET ONE-READ
Route::get('/posts/{id}', 'BlogPostController@show')->name('posts.show');
//CREATE
Route::post('/posts', 'BlogPostController@store')->name('posts.store');
//DELETE(delte bus po viena tai trynimas bus per ID)
Route::delete('/posts/{id}', 'BlogPostController@destroy')->name('posts.destroy');
//UPDATE 
Route::put('/posts/{id}', 'BlogPostController@update')->name('posts.update');
//ADD COMMENT route
Route::post('/posts/{id}/comments', 'BlogPostController@storePostComment')->name('posts.comments.store');

//------------------------
// http://localhost/1
// http://localhost/abc
// Pavyzdys atsako į klausimą: kaip padaryti, kad šitas route’as handlintų tik requestus, kur URL yra skaičiai
// Route::get('/{id}', function ($id) {
//     return $id;
// }) ->name('regular.root')->where('id', '[0-9]+');

//--------------------------
// class Person {
//     public $age;
//     public $name;
//     public function __construct($age, $name){
//         $this->age = $age;
//         $this->name = $name;
//     }
// }
// Route::get('/', function () {
//     $people = [
//     new Person(22, "Jonas"), 
//     new Person(16, "Petras")
// ];
//     return view('welcome', compact('people'));
// });

//-----------------------------------
Route::get('/about-page', function () {
    return view('about');
})->name('about');

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::get('/', function () {
    var_dump(DB::connection()->getPdo());
    return view('welcome');
})->name('index');


        
        
//-------------------------------
// Route::get('/{name}', function ($name) {
//     return view('welcome', ["var" => "$name"]);
// });
// Route::get('/', function () {
//     return view('welcome', ["var" => 1, "letters" => ["A", "B", "C"]]);
// });


//GALIMI VARIANTAI


// Route::match(['get', 'post'], '/test', function() {
//     return 'Hello World';
// });

// Route::get('/1', function () {
//     return "<h1>Hello</h1>";
// });

// Route::get('/{text}/{text2}', function ($text, $text2) {
//     return $text. "-" . $text2;
// });

// class Person{
//     public $age= 0;
//     public function __construct($age){
//         $this->age = $age;
//     }  
// }
// Route::get('/1', function () {
//     return Response:: json(new Person(5)) ;
// });


//-----------------------------

// Route::get('/', function () {
//     return view('welcome');
// });



// Route::get('/home', function () {
//     return redirect()->route('index'); // redirect to named route
    
// });


//-----------------------------------------------------

// Route::get('/', function () {
//     return '<div class="h1">Hello</div>';
// });

// Route::get('/1', function () {
//     return '<div class="h1">Hello 1</div>';
// });

// /{1} ;; /{jonas}
// Route::get('/{text}', function ($text) {
//     return $text;
// });

// Route::get('/admin/1', function(){
//     return "Success 1";
// });

// Route::get('/admin/2', function(){
//     return "Success 2";
// });

// Route::get('/admin/3', function(){
//     return "Success 3";
// });

// //abi grupes, tiek virsuj tiek apačioj, veikia taip pat, tik tiek kad apatineje galime grupuoti i kelias ROUTE grupes

// Route::group(['prefix' => 'admin'], function(){
//     Route::get('/1', function(){
//         return "Success 1";
//     });
//     Route::get('/2', function(){
//         return "Success 2";
//     });
//     Route::get('/3', function(){
//         return "Success 3";
//     });
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
