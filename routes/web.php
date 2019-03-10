<?php
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
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

Route::get('/', function () {
/*
$role = Role::create(['name' => 'super admin']);
    $role = Role::create(['name' => 'admin']);
    $role = Role::create(['name' => 'contributor']);
*/

/*
$permission = Permission::create(['name' => 'create user']);
$permission = Permission::create(['name' => 'view user']);
$permission = Permission::create(['name' => 'store user']);
$permission = Permission::create(['name' => 'update user']);
$permission = Permission::create(['name' => 'delete user']);
$permission = Permission::create(['name' => 'previlege user']);
*/
/*
$role = Role::findById(3);
$permission = Permission::findById(5);
$role->givePermissionTo($permission);
*/

/*
$user = User::find(1);
$user->assignRole('super admin');
$user = User::find(3);
$user->assignRole('admin');
$user = User::find(4);
$user->assignRole('contributor');
*/
    return view('auth.login');
});


Route::get('/view-my-profile/{id}', 'ProfileController@show');
Route::post('/update-profile/{id}', 'ProfileController@update');
Route::post('/upload-admin-image/{id}', 'ProfileController@update_profile_image');
Route::post('/change-own-password/{id}', 'ProfileController@change_own_password');
// Route::post('/createuser-by-admin', 'UserController@store');


Route::get('/user-management', 'UserController@index')->middleware('role:super admin|admin');
Route::get('/delete-user/{id}', 'UserController@destroy')->middleware('role:super admin|admin');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/my-url', 'WebUrlController@my_url');
Route::post('/submit-new-url', 'WebUrlController@submit_new_url');
Route::post('/edit-url', 'WebUrlController@edit_url');
Route::get('/delete-url/{id}', 'WebUrlController@destroy_url');
Route::get('/verifiy-url/{id}', 'WebUrlController@verify_url')->middleware('role:super admin|admin');
Route::post('/generate-verifytxt', 'WebUrlController@generate_verifytxt');
Route::get('download-txt-file/{id}','WebUrlController@download_txt_file');
Route::post('/verification-confirmation','WebUrlController@verification_confirmation')->middleware('role:super admin|admin');
Route::get('/all-url-list','WebUrlController@index')->middleware('role:super admin|admin');

Route::get('/pending-reqests', 'WebUrlController@pending_requests')->middleware('role:super admin|admin');

