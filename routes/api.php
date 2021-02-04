<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Task;
use App\Tag;
use App\Priority;
use App\Status;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TagResource;
use App\Http\Resources\FormDataResource;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/tasks', function() {
    return TaskResource::collection(Task::all());
});

Route::get('/tags', function() {
    return TagResource::collection(Tag::all())->jsonSerialize();
});

Route::get('/formdata', function() {
    return new FormDataResource(Priority::all('id', 'title'), Status::all('id', 'title'));
});

Route::post('/submittask', 'TaskController@store');
Route::post('/updatetask/{id}', 'TaskController@update');
