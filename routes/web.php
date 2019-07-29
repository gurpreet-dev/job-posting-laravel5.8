<?php

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

Auth::routes();

Route::group(['namespace' => 'Site'], function () {
    Route::get('/', 'SiteController@home')->name('home');
    Route::get('/home', 'SiteController@home')->name('home');
    Route::any('/buy-plan/{id}', 'SiteController@buyPlan')->name('buy-plan');
    Route::any('/contact-us', 'SiteController@contact')->name('contact-us');
    Route::get('/blog', 'SiteController@blogs')->name('blogs');
    Route::any('/blog/{slug}', 'SiteController@blog')->name('blog');
    Route::get('/add-nl', 'SiteController@addNewsletter')->name('add-nl');  // Newsletter
    Route::get('/page/{slug}', 'SiteController@page')->name('page-view');
    Route::get('/faq', 'SiteController@faq')->name('faq');
});

Route::group(['namespace' => 'Site', 'prefix' => 'user'], function () {
    Route::any('/profile', 'UsersController@profile')->name('user-profile');
    Route::any('/edit-profile', 'UsersController@editProfile')->name('edit-profile');
    Route::any('/payment', 'UsersController@payment')->name('user-payment')->middleware('role:doctor');
    Route::any('/change-password', 'UsersController@changePassword')->name('change-password');
    Route::any('/experience', 'UsersController@shareExperience')->name('share-experience');
    Route::any('/address', 'UsersController@address')->name('address');
    Route::any('/company-info', 'UsersController@companyInfo')->name('company-info');
});

Route::group(['namespace' => 'Site', 'prefix' => 'job'], function () {
    Route::any('/', 'JobsController@index')->name('job-posted')->middleware('role:doctor');
    Route::any('/post', 'JobsController@post')->name('job-post')->middleware('role:doctor');
    Route::any('/feed', 'JobsController@feed')->name('job-feed')->middleware('role:applicant');
    Route::any('/hired', 'JobsController@hired')->name('job-hired')->middleware('role:applicant');
    Route::any('/apply/{id}', 'JobsController@apply')->name('job-apply')->middleware('role:applicant');
    Route::get('/view/{id}', 'JobsController@view')->name('job-view');
    Route::any('/edit/{id}', 'JobsController@edit')->name('job-edit')->middleware('role:doctor');
    Route::any('/applicants/{id}', 'JobsController@applicants')->name('job-applicants')->middleware('role:doctor');
    Route::any('/applicant/{job_id}/{user_id}', 'JobsController@applicant')->name('job-applicant')->middleware('role:doctor');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('/', 'AuthController@showlogin')->name('admin.login');
    Route::post('/login', 'AuthController@login');
    Route::get('/logout', 'AuthController@logout')->name('admin.logout');
    Route::get('/dashboard', 'ExtrasController@index')->name('admin.dashboard');

    Route::any('/config', 'ExtrasController@config')->name('admin.config');
    Route::any('/experiences', 'ExtrasController@experiences')->name('admin.experiences');
    Route::post('/set-featured-experience', 'ExtrasController@setFeaturedExperience')->name('set-featured-experience');

    Route::get('/plans', 'SubscriptionPlansController@list')->name('admin.plans');
    Route::any('/plans/add', 'SubscriptionPlansController@add')->name('admin.add_plan');
    Route::any('/plans/edit/{id}', 'SubscriptionPlansController@edit')->name('admin.edit_plan');;
    Route::get('/plans/delete/{id}', 'SubscriptionPlansController@delete')->name('admin.delete_plan');;

    Route::get('/users', 'UsersController@index')->name('admin.users');  // List of users
    Route::any('/users/add', 'UsersController@add')->name('adduser');  //  add User
    Route::any('/users/edit/{id}', 'UsersController@edit')->name('edituser');  //  edit User
    Route::get('/users/view/{id}', 'UsersController@view')->name('viewuser');  //  view User
    Route::any('/users/delete/{id}', 'UsersController@delete')->name('deleteuser');  //  delete User
    Route::any('/users/change-password/{id}', 'UsersController@changepassword')->name('cpuser');  //  delete User
    Route::post('/users/set_featured', 'UsersController@set_featured')->name('set_featured');
    Route::get('/deleted-users', 'UsersController@deletedUsers')->name('admin.deleted-users');  // List of users
    Route::get('/users/gprestore/{id}', 'UsersController@restore')->name('admin.gprestore');
    Route::get('/users/company/{id}', 'UsersController@company')->name('admin.company'); 

    Route::get('/jobs', 'JobsController@index')->name('admin.jobs');
    Route::get('/jobs/view/{id}', 'JobsController@view')->name('admin.job-view');
    Route::get('/jobs/applicants/{id}', 'JobsController@applicants')->name('admin.job-applicants');
    Route::get('/jobs/applicant/{id}', 'JobsController@applicant')->name('admin.job-applicant');
    Route::get('/jobs/delete/{id}', 'JobsController@delete')->name('admin.job-delete');
    Route::post('/jobs/set-featured-jobs', 'JobsController@setFeaturedJobs')->name('set-featured-jobs');

    Route::any('/contacts', 'ExtrasController@contacts')->name('admin.contacts');
    Route::any('/contacts/edit/{id}', 'ExtrasController@editContact')->name('admin.editContact');

    Route::get('/pages', 'ExtrasController@pages');
    Route::any('/pages/add', 'ExtrasController@addPage')->name('addpage');
    Route::any('/pages/edit/{id}', 'ExtrasController@editPage')->name('editpage');
    Route::any('/pages/delete/{id}', 'ExtrasController@deletePage');

    Route::get('/blog', 'BlogsController@list_blog')->name('admin.list_blog');
    Route::any('/blog/add', 'BlogsController@add_blog')->name('add_blog');
    Route::any('/blog/edit/{id}', 'BlogsController@edit_blog')->name('edit_blog');
    Route::any('/blog/change-status/{id}', 'BlogsController@change_status_blog');
    Route::any('/blog/delete/{id}', 'BlogsController@delete_blog');

    Route::get('/faq', 'FaqController@list')->name('admin.faq');
    Route::any('/faq/add', 'FaqController@add')->name('addfaq');
    Route::any('/faq/edit/{id}', 'FaqController@edit')->name('editfaq');
    Route::any('/faq/change-status/{id}', 'FaqController@change_status');
    Route::any('/faq/delete/{id}', 'FaqController@delete');
    Route::get('/faq/view/{id}', 'FaqController@view');
});
