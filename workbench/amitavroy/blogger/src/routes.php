<?php

Route::get('blog/list', 'BloggerController@handleBlogListingPage');
Route::get('blog/view/{id}', 'BloggerController@handleBlogSinglePage');