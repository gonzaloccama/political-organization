<?php

use App\Http\Livewire\Admin\AdminsComponent;
use App\Http\Livewire\Admin\ContributorsComponent;
use App\Http\Livewire\Admin\DepartamentosComponent;
use App\Http\Livewire\Admin\EventsCategoryComponent;
use App\Http\Livewire\Admin\EventsComponent;
use App\Http\Livewire\Admin\GenderComponent;
use App\Http\Livewire\Admin\PostsComponent;
use App\Http\Livewire\Admin\ProjectComponent;
use App\Http\Livewire\Admin\RelationshipComponent;
use App\Http\Livewire\Admin\RoleComponent;
use App\Http\Livewire\Admin\UsersComponent;
use App\Http\Livewire\User\ChatMessagesComponent;
use App\Http\Livewire\User\HomeComponent;
use App\Http\Livewire\User\PostsSaved;
use App\Http\Livewire\User\ProfileComponent;
use App\Http\Livewire\User\SettingProfile;
use App\Http\Middleware\UserBanned;
use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();
Route::get('/login', \App\Http\Livewire\Auth\LoginComponent::class)->name('login');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware([UserBanned::class])->group(function () {
    /*** ADMINS ***/
    Route::middleware(['auth', 'isAdmin'])->group(function () {
        Route::get('/admin/users', UsersComponent::class)->name('admin.users');

        Route::get('/admin/dashboard', UsersComponent::class)->name('admin.dashboard');
        Route::get('/admin/posts', PostsComponent::class)->name('admin.posts');
        Route::get('/admin/events', EventsComponent::class)->name('admin.events');
        Route::get('/admin/events/categories', EventsCategoryComponent::class)->name('admin.events.categories');

        Route::get('/admin/contributors', ContributorsComponent::class)->name('admin.contributors');
        Route::get('/admin/projects', ProjectComponent::class)->name('admin.projects');
        Route::get('/admin/role', RoleComponent::class)->name('admin.role');

        /***  OTHERS  ***/
        Route::get('/admin/gender', GenderComponent::class)->name('admin.gender');
        Route::get('/admin/relationship', RelationshipComponent::class)->name('admin.relationship');
        Route::get('/admin/region', DepartamentosComponent::class)->name('admin.region');

        /***  EXPORTS  ***/
        Route::get('/admin/users/exports-pdf', [UsersComponent::class, 'exportPDF'])->name('admin.users.pdf');
    });

    /***  USERS ***/
    Route::middleware(['auth'])->group(function () {
        Route::get('/', HomeComponent::class)->name('home');
        Route::get('/profile/{id?}', ProfileComponent::class)->name('profile');
        Route::get('/settings/profile', SettingProfile::class)->name('settings.profile');
        Route::get('/saved', PostsSaved::class)->name('saved');
        Route::get('/chat-messages', ChatMessagesComponent::class)->name('chat.messages');
    });
});
