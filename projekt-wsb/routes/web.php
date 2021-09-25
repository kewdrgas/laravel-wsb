<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('wsb',function (){
   // return view('wsb');
/*
    return ['name' => 'Kewin',
    'surname' => 'Drgas',
     'city' => 'Rome'
];
*/
return view('wsb',[
    'name'     => 'Kewin',
    'surname'  => 'Drgas',
    'city'     => 'Rome'
]);
});
Route::get('/pages/{data}',function($data){
    $site =[
        'kontakt'              => 'jan@o2.pl',
        'informacje o stronie' => 'blabla',
        'strona domowa'        => 'blabla'
    ]; 

    return $site[$data];
});

Route::get('/address/{city?}/{street?}/{zipcode?}',function(String $city='-', String $street='-', int $zipcode=null){
    $zipcode = substr($zipcode,0,2)."-".substr($zipcode,2,3);
    echo <<< ADDRESS
     Miasto  $city <br>
     Ulica: $street <br>
     Kod pocztowy: $zipcode
     <hr>
ADDRESS;
})->name('address');

Route::redirect('adres/{city?}/{street?}/{zipcode?}','/address/{city?}/{street?}/{zipcode?}');
Route::prefix('admin')->group(function(){
    Route::get('/home/{name}', function (String $name){
        echo "Witaj $name na stronie admina";
    })->where(['name'=>'[A-Za-z]+']);

    Route::get('/users', function (){
        echo "Użytkownicy serwisu";
    });
});
Route::redirect('admin/{name}','/admin/home/{name}');