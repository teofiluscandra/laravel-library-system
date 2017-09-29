<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'GuestController@index');
Route::get('/books-list', ['as' => 'booklist.index', 'uses' => 'BookListController@index']);
Route::get('books-list/details/{id}', ['as' => 'booklist.show', 'uses' => 'BooksController@show']);

Auth::routes();
Route::get('auth/verify/{token}', 'Auth\RegisterController@verify');
Route::get('auth/send-verification', 'Auth\RegisterController@sendVerification');

Route::get('/home', 'HomeController@index');
Route::get('settings/profile', 'SettingsController@profile');
Route::get('settings/profile/edit', 'SettingsController@editProfile');
Route::post('settings/profile', 'SettingsController@updateProfile');
Route::get('settings/password', 'SettingsController@editPassword');
Route::post('settings/password', 'SettingsController@updatePassword');

Route::group(['prefix'=>'data', 'middleware'=>['auth', 'role:admin']], function () {
  Route::resource('authors', 'AuthorsController');
  Route::resource('books', 'BooksController');
  Route::resource('borrow', 'BorrowController');
  Route::get('settings/library', 'LibrarySettingsController@edit');
  Route::post('settings/library', 'LibrarySettingsController@update');
  Route::get('statistics', ['as'=>'statistics.index','uses'=>'StatisticsController@index']);
  Route::get('borrow/{id}/return', ['as'=>'borrow.return','uses'=>'BorrowController@return']);
  Route::put('borrow/{id}/return/post',['as'=>'borrow.return.post','uses'=>'BorrowController@return_post']);
  Route::resource('members', 'MembersController');
  Route::resource('borrow', 'BorrowController');

  Route::resource('categories', 'CategoriesController');
  Route::get('statistics', [
    'as'   => 'statistics.index',
    'uses' => 'StatisticsController@index'
  ]);
  Route::get('borrow/{id}/return', [
    'as'   => 'borrow.return',
    'uses' => 'BorrowController@return'
  ]);
   Route::put('borrow/{id}/return/post', [
    'as'   => 'borrow.return.post',
    'uses' => 'BorrowController@return_post'
  ]);
  Route::get('export/books', [
    'as'   => 'export.books',
    'uses' => 'BooksController@export'
  ]);
  Route::post('export/books', [
    'as'   => 'export.books.post',
    'uses' => 'BooksController@exportPostAll'
  ]);
  Route::post('export/books.date', [
    'as'   => 'export.books.post.date',
    'uses' => 'BooksController@exportPost'
  ]);
  Route::get('export/members', [
    'as'   => 'export.members',
    'uses' => 'MembersController@export'
  ]);
  Route::post('export/members', [
    'as'   => 'export.members.post',
    'uses' => 'MembersController@exportPostAll'
  ]);
  Route::post('export/members/date', [
    'as'   => 'export.members.post.date',
    'uses' => 'MembersController@exportPost'
  ]);
  Route::get('export/staff', [
    'as'   => 'export.staff',
    'uses' => 'StaffController@export'
  ]);
  Route::post('export/staff', [
    'as'   => 'export.staff.post',
    'uses' => 'StaffController@exportPostAll'
  ]);
  Route::post('export/staff/date', [
    'as'   => 'export.staff.post.date',
    'uses' => 'StaffController@exportPost'
  ]);
    Route::get('export/borrow', [
    'as'   => 'export.borrow',
    'uses' => 'BorrowController@export'
  ]);
  Route::post('export/borrow', [
    'as'   => 'export.borrow.post',
    'uses' => 'BorrowController@exportPostAll'
  ]);
  Route::post('export/borrow/date', [
    'as'   => 'export.borrow.post.date',
    'uses' => 'BorrowController@exportPost'
  ]);
  Route::get('template/books', [
    'as'   => 'template.books',
    'uses' => 'BooksController@generateExcelTemplate'
  ]);
  Route::post('import/books', [
    'as'   => 'import.books',
    'uses' => 'BooksController@importExcel'
  ]);
  Route::get('settings/library', 'LibrarySettingsController@edit');
  Route::post('settings/library', 'LibrarySettingsController@update');
});

Route::group(['prefix'=>'data', 'middleware'=>['auth', 'role:kepala']], function () {
  
  Route::get('export/books', [
    'as'   => 'export.books',
    'uses' => 'BooksController@export'
  ]);
  Route::post('export/books', [
    'as'   => 'export.books.post',
    'uses' => 'BooksController@exportPostAll'
  ]);
  Route::post('export/books.date', [
    'as'   => 'export.books.post.date',
    'uses' => 'BooksController@exportPost'
  ]);
  Route::get('export/members', [
    'as'   => 'export.members',
    'uses' => 'MembersController@export'
  ]);
  Route::post('export/members', [
    'as'   => 'export.members.post',
    'uses' => 'MembersController@exportPostAll'
  ]);
  Route::post('export/members/date', [
    'as'   => 'export.members.post.date',
    'uses' => 'MembersController@exportPost'
  ]);
  Route::get('export/staff', [
    'as'   => 'export.staff',
    'uses' => 'StaffController@export'
  ]);
  Route::post('export/staff', [
    'as'   => 'export.staff.post',
    'uses' => 'StaffController@exportPostAll'
  ]);
  Route::post('export/staff/date', [
    'as'   => 'export.staff.post.date',
    'uses' => 'StaffController@exportPost'
  ]);
    Route::get('export/borrow', [
    'as'   => 'export.borrow',
    'uses' => 'BorrowController@export'
  ]);
  Route::post('export/borrow', [
    'as'   => 'export.borrow.post',
    'uses' => 'BorrowController@exportPostAll'
  ]);
  Route::post('export/borrow/date', [
    'as'   => 'export.borrow.post.date',
    'uses' => 'BorrowController@exportPost'
  ]);
});

Route::group(['prefix'=>'data', 'middleware'=>['auth', 'role:staff|admin|kepala']], function () {
  Route::resource('authors', 'AuthorsController');
  Route::resource('books', 'BooksController');
  Route::resource('borrow', 'BorrowController');
  Route::get('settings/library', 'LibrarySettingsController@edit');
  Route::post('settings/library', 'LibrarySettingsController@update');
  Route::get('statistics', ['as'=>'statistics.index','uses'=>'StatisticsController@index']);
  Route::get('borrow/{id}/return', ['as'=>'borrow.return','uses'=>'BorrowController@return']);
  Route::put('borrow/{id}/return/post',['as'=>'borrow.return.post','uses'=>'BorrowController@return_post']);
  Route::resource('members', 'MembersController', ['except' => [
    'create', 'store', 'destroy'
]]);
  Route::resource('borrow', 'BorrowController');
  Route::resource('categories', 'CategoriesController');
  Route::get('export/books', [
    'as'   => 'export.books',
    'uses' => 'BooksController@export'
  ]);
  Route::post('export/books', [
    'as'   => 'export.books.post',
    'uses' => 'BooksController@exportPostAll'
  ]);
  Route::post('export/books.date', [
    'as'   => 'export.books.post.date',
    'uses' => 'BooksController@exportPost'
  ]);
  Route::get('export/members', [
    'as'   => 'export.members',
    'uses' => 'MembersController@export'
  ]);
  Route::post('export/members', [
    'as'   => 'export.members.post',
    'uses' => 'MembersController@exportPostAll'
  ]);
  Route::post('export/members/date', [
    'as'   => 'export.members.post.date',
    'uses' => 'MembersController@exportPost'
  ]);
  Route::get('export/staff', [
    'as'   => 'export.staff',
    'uses' => 'StaffController@export'
  ]);
  Route::post('export/staff', [
    'as'   => 'export.staff.post',
    'uses' => 'StaffController@exportPostAll'
  ]);
  Route::post('export/staff/date', [
    'as'   => 'export.staff.post.date',
    'uses' => 'StaffController@exportPost'
  ]);
    Route::get('export/borrow', [
    'as'   => 'export.borrow',
    'uses' => 'BorrowController@export'
  ]);
  Route::post('export/borrow', [
    'as'   => 'export.borrow.post',
    'uses' => 'BorrowController@exportPostAll'
  ]);
  Route::post('export/borrow/date', [
    'as'   => 'export.borrow.post.date',
    'uses' => 'BorrowController@exportPost'
  ]);
});

Route::group(['prefix'=>'data', 'middleware'=>['auth', 'role:admin']], function () {
    Route::resource('staff', 'StaffController');
});


Route::put('books/{book}/return', [
  'middleware' => ['auth', 'role:member'],
  'as'         => 'member.books.return',
  'uses'       => 'BooksController@returnBack'
]);
