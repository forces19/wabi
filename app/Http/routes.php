<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('sampledata', function() {
    DB::table('siswa')->insert([
        [
            'nisn'              => '1001',
            'nama_siswa'              => 'Agus',
            'tanggal_lahir'     => '1990-02-12',
            'jenis_kelamin'     => 'L',
            'created_at'        => '2016-03-10 19:10:15',
            'updated_at'        => '2016-03-10 19:10:15'
        ],
        [
            'nisn'              => '1002',
            'nama_siswa'             => 'Agustina',
            'tanggal_lahir'     => '1990-02-12',
            'jenis_kelamin'     => 'P',
            'created_at'        => '2016-03-10 19:10:15',
            'updated_at'        => '2016-03-10 19:10:15'
        ],
        [
            'nisn'              => '1003',
            'nama_siswa'              => 'Bayu',
            'tanggal_lahir'     => '1990-02-12',
            'jenis_kelamin'     => 'L',
            'created_at'        => '2016-03-10 19:10:15',
            'updated_at'        => '2016-03-10 19:10:15'
        ],
        [
            'nisn'              => '1004',
            'nama_siswa'              => 'Citra',
            'tanggal_lahir'     => '1990-02-12',
            'jenis_kelamin'     => 'P',
            'created_at'        => '2016-03-10 19:10:15',
            'updated_at'        => '2016-03-10 19:10:15'
        ],
        [
            'nisn'              => '1005',
            'nama_siswa'              => 'Dirgantara',
            'tanggal_lahir'     => '1990-02-12',
            'jenis_kelamin'     => 'L',
            'created_at'        => '2016-03-10 19:10:15',
            'updated_at'        => '2016-03-10 19:10:15'
        ],
        [
            'nisn'              => '1006',
            'nama_siswa'              => 'Eko',
            'tanggal_lahir'     => '1990-02-12',
            'jenis_kelamin'     => 'L',
            'created_at'        => '2016-03-10 19:10:15',
            'updated_at'        => '2016-03-10 19:10:15'
        ],
        [
            'nisn'              => '1007',
            'nama_siswa'              => 'Firda',
            'tanggal_lahir'     => '1990-02-12',
            'jenis_kelamin'     => 'P',
            'created_at'        => '2016-03-10 19:10:15',
            'updated_at'        => '2016-03-10 19:10:15'
        ],
        [
            'nisn'              => '1008',
            'nama_siswa'              => 'Galang',
            'tanggal_lahir'     => '1990-02-12',
            'jenis_kelamin'     => 'L',
            'created_at'        => '2016-03-10 19:10:15',
            'updated_at'        => '2016-03-10 19:10:15'
        ],
        [
            'nisn'              => '1009',
            'nama_siswa'              => 'Haris',
            'tanggal_lahir'     => '1990-02-12',
            'jenis_kelamin'     => 'L',
            'created_at'        => '2016-03-10 19:10:15',
            'updated_at'        => '2016-03-10 19:10:15'
        ],
        [
            'nisn'              => '1010',
            'nama_siswa'              => 'Indra',
            'tanggal_lahir'     => '1990-02-12',
            'jenis_kelamin'     => 'L',
            'created_at'        => '2016-03-10 19:10:15',
            'updated_at'        => '2016-03-10 19:10:15'
        ],
    ]);
});
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

// Route::group(['middleware' => ['web']], function () {
//     Route::get('siswa', 'SiswaController@index');
//     Route::get('siswa/create', 'SiswaController@create');
//     Route::get('siswa/{siswa}', 'SiswaController@show');
//     Route::post('siswa', 'SiswaController@store');
//     Route::get('siswa/{siswa}/edit', 'SiswaController@edit');
//     Route::patch('siswa/{siswa}', 'SiswaController@update');
//     Route::delete('siswa/{siswa}', 'SiswaController@destroy');
// });

Route::group(['middleware' => ['web']], function () {
    Route::get('/', 'PagesController@homepage');
    Route::get('about', 'PagesController@about');

    $this->get('login', 'Auth\AuthController@showLoginForm');
    $this->post('login', 'Auth\AuthController@login');
    $this->get('logout', 'Auth\AuthController@logout');

    Route::get('register', function() {
        return redirect('/');
    });

    Route::get('siswa/cari', 'SiswaController@cari');
    Route::resource('siswa', 'SiswaController');
    Route::resource('kelas', 'KelasController');
    Route::resource('user', 'UserController');
});

