<?php
if (Input::server('HTTP_HOST') === "controls.house") {
  Route::get('/', function () {
    return 'O__0';
  });
}

Route::get('/admin/home/share', 'BlueIrisPageController@share')->name('home::share');
Route::get('/admin/home', 'BlueIrisPageController@console')->name('home::console');
Route::get('/admin/home/map-to-nest', 'BlueIrisPageController@map')->name('home::map-to-nest');
Route::get('/admin/home/shinobi', 'ShinobiPageController@console')->name('home::console-shinobi');
Route::get('/admin/home/setup', 'BlueIrisPageController@setup')->name('home::setup');
Route::post('/admin/home/setup', 'BlueIrisPageController@create');

Route::get('/admin/iris', function () {
  return redirect()->route("home::console");
});
Route::get('/iris/setup', function () {
  return redirect()->route("home::setup");
});

Route::get('/home/guest', 'BlueIrisPageController@guest');