<?php
Route::get('/iris', function() {
  return '';
});

Route::get('/admin/iris', 'BlueIrisPageController@console')->name('iris::console');
Route::get('/iris/setup', 'BlueIrisPageController@setup')->name('iris::setup');
Route::post('/iris/setup', 'BlueIrisPageController@create');