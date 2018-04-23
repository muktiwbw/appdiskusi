<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');

Route::group([
    'middleware' => ['api_token']
], function(){

    Route::get('info/{api_token}/{user_id}', 'UserController@info');
    Route::get('questions/{api_token}/{user_id}', 'UserController@questions');
    
    Route::group([
        'prefix' => 'question'
    ], function(){

        Route::post('store', 'QuestionController@store');
        Route::get('show/{api_token}/{question_id}', 'QuestionController@show');
        Route::get('index/{api_token}', 'QuestionController@index');
        Route::post('update', 'QuestionController@update');
        Route::post('destroy', 'QuestionController@destroy');
    
    });

    Route::group([
        'prefix' => 'answer'
    ], function(){

        Route::post('store', 'AnswerController@store');
        Route::post('update', 'AnswerController@update');
        Route::post('destroy', 'AnswerController@destroy');
    
    });

    Route::post('vote', 'VoteController@vote');
    Route::post('unvote', 'VoteController@unvote');
    
});