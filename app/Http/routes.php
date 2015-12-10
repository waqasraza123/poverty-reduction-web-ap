<?php
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function(){
	return view('Pages.index');
});

Route::get('donner', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('needy', function(){
    return view('Pages.needy');
});

/*handle post request to save form data*/
Route::post('needy', 'ProblemController@save');

/*donner button routes*/
Route::get('donate-money', function(){
    return view('Pages.donate-money');
})->middleware('auth');

Route::post('donate-money', 'DonnerController@charge');
Route::post('donate-money-main', 'DonnerController@saveDetails');

Route::get('donate-things', function(){
    return view('Pages.donate-things');
})->middleware('auth');

Route::get('help-patient', function(){
    return view('Pages.help-patient');
})->middleware('auth');


//update the dashboard
Route::post('update-donner-dashboard', 'DonnerController@updateDashboard');
Route::post('remove-cookie', 'DonnerController@destroyCookie');
Route::get('test', function(){
    return view('Pages.test');
});
Route::post('test', function(\Illuminate\Http\Request $request){

    $token = $request->input('stripeToken');

    Auth::user()->subscription('main')->create($token);
    return 'Done';
});