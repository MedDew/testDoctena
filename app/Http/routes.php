<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

//Show the book list
Route::get('/bookList', 'HomeController@index');
//Filter the book list
Route::post('/bookList/{categoryId?}', 'HomeController@searchByCategory');

//Show the creation book form
Route::get('/createBookForm', 'HomeController@showBookCreationForm');
Route::post('/createBook', 'HomeController@createBook');

//Show the "deletion" (update of books.is_deleted to 1 simulating deletion ) 
//of the book selected
Route::get('/deleteBook/{bookId}', 'HomeController@deleteBook');

//Show the real deletion of the book selected
Route::get('/deleteForRealBook/{bookId}', 'HomeController@deleteForRealBook');

        
