<?php

use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ManifestController;
use App\Http\Livewire\Admin\AccountingComponent;
use App\Http\Livewire\Admin\AdminsComponent;
use App\Http\Livewire\Admin\ContributionIncomeComponent;
use App\Http\Livewire\Admin\ContributorsComponent;
use App\Http\Livewire\Admin\DashboardComponent;
use App\Http\Livewire\Admin\DepartamentosComponent;
use App\Http\Livewire\Admin\EventsCategoryComponent;
use App\Http\Livewire\Admin\EventsComponent;
use App\Http\Livewire\Admin\ExpensesComponent;
use App\Http\Livewire\Admin\GenderComponent;
use App\Http\Livewire\Admin\IncomeComponent;
use App\Http\Livewire\Admin\PlanMentionComponent;
use App\Http\Livewire\Admin\PostsComponent;
use App\Http\Livewire\Admin\ProjectComponent;
use App\Http\Livewire\Admin\RelationshipComponent;
use App\Http\Livewire\Admin\RoleComponent;
use App\Http\Livewire\Admin\SystemSettingComponent;
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
//Route::get('/admin/login', \App\Http\Livewire\Auth\LoginComponent::class)->name('admin.login');

Route::get('auth/google', [GoogleController::class, 'goToGoogle'])->name('auth.google');
Route::get('callback/google', [GoogleController::class, 'goHandleCallback'])->name('auth.callback');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware([UserBanned::class])->group(function () {
    /*** ADMINS ***/
    Route::middleware(['auth', 'isAdmin'])->group(function () {
        Route::get('/admin/users', UsersComponent::class)->name('admin.users');

        Route::get('/admin/dashboard', DashboardComponent::class)->name('admin.dashboard');
        Route::get('/admin/posts', PostsComponent::class)->name('admin.posts');
        Route::get('/admin/events', EventsComponent::class)->name('admin.events');
        Route::get('/admin/events/categories', EventsCategoryComponent::class)->name('admin.events.categories');

        Route::get('/admin/contributors', ContributorsComponent::class)->name('admin.contributors');
        Route::get('/admin/projects', ProjectComponent::class)->name('admin.projects');
        Route::get('/admin/role', RoleComponent::class)->name('admin.role');

        Route::get('/admin/expenses', ExpensesComponent::class)->name('admin.expenses');
        Route::get('/admin/contribution-income', ContributionIncomeComponent::class)->name('admin.contribution-income');
        Route::get('/admin/income', IncomeComponent::class)->name('admin.income');

        /***  OTHERS  ***/
        Route::get('/admin/gender', GenderComponent::class)->name('admin.gender');
        Route::get('/admin/relationship', RelationshipComponent::class)->name('admin.relationship');
        Route::get('/admin/region', DepartamentosComponent::class)->name('admin.region');

        Route::get('/admin/proposal', PlanMentionComponent::class)->name('admin.proposal');

        Route::get('/admin/settings', SystemSettingComponent::class)->name('admin.settings');

        /***  EXPORTS  ***/
//        Route::get('/admin/users/exports-pdf', [UsersComponent::class, 'exportPDF'])->name('admin.users.pdf');
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

Route::get('/clear', function () {
    $output = new \Symfony\Component\Console\Output\BufferedOutput();
    Artisan::call('log:clear');
    Artisan::call('optimize:clear', array(), $output);
    Artisan::call('temp:file');
    return $output->fetch();
})->name('clear');

//Route::get('/clear-temp', function () {
//
//    dd('Temporary files have been cleared');
//})->name('clear-temp');
