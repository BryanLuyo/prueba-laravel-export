<?php

use App\Exports\UsuarioExport;
use Illuminate\Support\Facades\Route;


use Maatwebsite\Excel\Facades\Excel;


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

Route::get('/', 'UsuarioController@index');
Route::get('/read/{estado}','UsuarioController@read_usuarios');
Route::resource('usuarios', 'UsuarioController');
Route::get('/excel/{estado}', function ($estado) {
    return Excel::download(new UsuarioExport($estado), 'usuario.xlsx');
});

Route::get('/pdf/{estado}','UsuarioController@createPDF');
