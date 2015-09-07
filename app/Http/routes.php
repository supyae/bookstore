<?php
////////////////// Book Section //////////////////
Route::group(array('prefix' => '/'),

    function(){
        get('','BookController@index');
        get('book', 'BookController@bookForm');

        get('editBook/{id}',['as' => 'editBook', 'uses' => 'BookController@edit']);
        get('deleteBook/{id}', ['as' => 'deleteBook', 'uses' => 'BookController@destroy']);

        post('/bookSave','BookController@create');
        post('/bookUpdate/{id}','BookController@update');

});
/// ///////////////Author Section   /////////////
Route::group(array('prefix' => '/author'), /**
     *
     */
    function(){
    get('',['as'=> 'author','uses' => 'AuthorController@index']);

    post('authorSave',['as' => 'authorSave','uses' => 'AuthorController@store']);

    post('authorEdit/{id}',['as'=>'authorEdit','uses'=>'AuthorController@update']);
    get('editBack',['as'=> 'editBack','uses' => function(){
            return redirect()->back();
        }]);

});

/// ///////////// Genre Section //////////////////
Route::group(array('prefix' => '/genre'),
    function(){
        get('',['as'=>'genre','uses'=>'GenreController@index']);

        post('genreSave',['as'=> 'genreSave','uses' => 'GenreController@store']);
        post('genreEdit/{id}',['as'=>'genreEdit','uses'=>'GenreController@update']);



});
