<?php

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
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/unauthenticated', function() {
  return View::make('unauthenticated');
});

// Admin routes
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function()
{
  Route::resource('categories', 'CategoryController');
  Route::resource('forums', 'ForumController');
  Route::resource('topics', 'TopicController');
  Route::resource('users', 'UserController');
  Route::resource('comments', 'CommentController');

});

// User routes
Route::group(['middleware' => ['auth']], function()
{
  Route::get('user/{id}', 'UserController@profile');
  Route::get('{id}/comments/create', 'CommentController@g_create');
  Route::get('{id}/comments/create/quote/{content}', 'CommentController@g_create_quote');
  Route::post('comments/store', 'CommentController@g_store');
  Route::post('comments/store/quote', 'CommentController@g_store_quote');
  Route::delete('{id}/comments/delete/{commid}', 'CommentController@g_destroy');
  Route::get('{id}/comments/edit/{commid}', 'CommentController@g_edit');
  Route::put('{id}/comments/update/{commid}', 'CommentController@g_update');
  Route::resource('mailboxes', 'MailboxController');
  Route::get('mailboxes/reply/{id}', 'MailboxController@reply');
  Route::get('{id}/topic_create', 'TopicController@topic_create');
  Route::post('topic_store', 'TopicController@topic_store');
});

// Guest routes
Route::get('index', 'CategoryController@g_categories');
Route::get('categories/{id}', 'CategoryController@g_forums');
Route::get('forums/{id}', 'ForumController@g_topics');
Route::get('topics/{id}', 'TopicController@g_comments');


/*
// Category
Route::get('categories', 'CategoryController@index');
Route::get('categories/{id}', 'CategoryController@show');
Route::get('categories/create', 'CategoryController@create');
Route::get('categories/{id}/edit', 'CategoryController@edit');
Route::delete('categories/{id}', 'CategoryController@destroy');
