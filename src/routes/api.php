<?php
use Fligno\Auth\Events\EventUserExpireToken;
    Route::group(['middleware' => 'auth:api'], function () {
    Route::get('users/me', function () {
        return request()->user();
    });
    
    Route::post('logout', 'LoginController@logout')->name('logout');
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', 'LoginController@login');
    Route::post('admin/login', 'Admin\LoginController@login');
    Route::post('register', 'RegisterController@register');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'ResetPasswordController@reset');
});

Route::group(['middleware' => ['auth:api', 'role:Admin']], function () {
    
    Route::apiResource('role', 'RoleController');
    Route::delete('role', 'RoleController@destroyAll')->name('role.destroyAll');

    Route::apiResource('permission', 'PermissionController');
    Route::delete('permission', 'PermissionController@destroyAll')->name('permission.destroyAll');

    Route::get('roles-permissions', 'RolePermissionController@index')->name('role-permission.index');
    Route::post('roles-permissions/{role}/{permission}', 'RolePermissionController@update')->name('role-permission.update');
   // Route::apiResource('resource', 'ResourceController');
    Route::get('resource/{model}', 'ResourceController@get');
    Route::get('resource/data/{model}', 'ResourceController@getData');
    Route::post('resource/{model}', 'ResourceController@store');
    Route::patch('resource/{model}/{id}', 'ResourceController@update');
    Route::get('resource/{model}/{id}', 'ResourceController@show');
    Route::get('resource', 'ResourceController@index');
    Route::delete('resource/{model}', 'ResourceController@destroyAll')->name('resource.destroyAll');

    Route::post('user-activation/{user}', 'UserActivationController@update')->name('user.activation');
    Route::apiResource('user', 'UserController');

    Route::get('newsletters', 'NewsletterController@index');
    Route::delete('newsletters', 'NewsletterController@destroy');
    Route::post('newsletters/mail/send', 'ComingSoonEmailController@send');

    Route::get('app-settings/coming-soon', 'ComingSoonController@index');
    Route::patch('app-settings/coming-soon', 'ComingSoonController@update');
    Route::get('app-settings/email', 'ComingSoonEmailController@index');
    Route::patch('app-settings/email', 'ComingSoonEmailController@update');

    Route::apiResource('setting','SettingController');
    Route::get('setting-session','SettingController@index');
     
    Route::get('mail','EmailController@index');
    Route::post('mail','EmailController@store');
    Route::get('organization','OrganizationController@index');
    Route::apiResource('organization','OrganizationController');
    Route::post('organization','OrganizationController@store');
    Route::patch('organization-update','OrganizationController@update');
    Route::delete('organization','OrganizationController@destroyAll');
    Route::get('timezone','TimeZoneController@index');
    Route::get('timezone-now','TimeZoneController@getTimeZone');
    Route::post('timezone','TimeZoneController@store');

    //broadcast(new EventUserExpireToken('token-update'));
});

Route::post('newsletters', 'NewsletterController@store');
Route::get('email/resend', 'VerificationController@resend')->name('verification.resend')->middleware(['auth:api', 'throttle:60,1']);
Route::get('email/verify/{id}/{hash}', 'VerificationController@verify')->middleware(['throttle:60,1']);
