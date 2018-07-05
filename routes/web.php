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
//Artisan::call('storage:link');
Route::get('login', 'Auth\LoginController@showLoginForm');

Route::group(['middleware' => 'guest'], function () {
  Route::get('/', function ($n=null) {
    return view('layouts.guest');
  });
});
// Route::get('login', function () {
//   return view('layouts.guest');
// })->name('login');

// Route::get('/login', function() { return view('layouts.guest');})->name('auth.login');



Route::get('/home', 'Auth\LoginController@redirectToProvider');
Route::get('/home/callback', 'Auth\LoginController@handleProviderCallback');
// Route::post('/home','SettingsController@colors');
// Route::get('/password/reset/email', 'Auth\PasswordController@getEmail');
// Route::post('/password/reset/email', 'Auth\PasswordController@postEmail');

Route::get('/checkusers',function(){
$user = App\Models\User::all()->where('email',Illuminate\Support\Facades\Input::get('email'))->first();
if ($user) {
     return 'true';
} else {
     return 'false';
 }
});
Route::get('/usersCount',function(){
$usersCount = App\Models\User::all()->count();
return $usersCount;
});



Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');
Route::get('/settings', 'SettingsController@index');

Route::post('/settings', array(
  'as' => 'settings',
  'uses' => 'SettingsController@update'
));

// Logout
Route::get('/logout', 'LogoutController@logout');


// Posts
Route::get('/posts/list', 'PostsController@fetch');
Route::post('/posts/new', 'PostsController@create');
Route::post('/posts/delete', 'PostsController@delete');
Route::post('/posts/like', 'PostsController@like');
Route::post('/posts/likes', 'PostsController@likes');
Route::post('/posts/comment', 'PostsController@comment');
Route::post('/posts/comments/delete', 'PostsController@deleteComment');
Route::get('/post/{id}', 'PostsController@single');

// Search
Route::get('/search', 'HomeController@search');


// footer
Route::get('/contact-faqs', 'FooterController@contact')->name('contact-faqs');


// Follow
Route::post('/follow', 'FollowController@follow');
Route::get('/followers/pending', 'FollowController@pending');
Route::post('/follower/request', 'FollowController@followerRequest');
Route::post('/follower/denied', 'FollowController@followDenied');

// Relatives
Route::get('/relatives/pending', 'RelativesController@pending');
Route::post('/relative/delete', 'RelativesController@delete');
Route::post('/relative/request', 'RelativesController@relativeRequest');



// Messages
Route::get('/direct-messages', 'MessagesController@index');
Route::get('/direct-messages/show/{id}', 'MessagesController@index');
Route::post('/direct-messages/chat', 'MessagesController@chat');
Route::post('/direct-messages/send', 'MessagesController@send');
Route::post('/direct-messages/new-messages', 'MessagesController@newMessages');
Route::post('/direct-messages/people-list', 'MessagesController@peopleList');
Route::post('/direct-messages/delete-chat', 'MessagesController@deleteChat');
Route::post('/direct-messages/delete-message', 'MessagesController@deleteMessage');
Route::post('/direct-messages/notifications', 'MessagesController@notifications');


// Profile
Route::get('/{username}', 'ProfileController@index');
Route::post('/{username}/upload/profile-photo', 'ProfileController@uploadProfilePhoto');
Route::post('/{username}/upload/cover', 'ProfileController@uploadCover');
Route::post('/{username}/save/information', 'ProfileController@saveInformation');
Route::get('/{username}/following', 'ProfileController@following');
Route::get('/{username}/followers', 'ProfileController@followers');
Route::post('/{username}/save/hobbies', 'ProfileController@saveHobbies');
Route::post('/{username}/save/relationship', 'ProfileController@saveRelationship');
