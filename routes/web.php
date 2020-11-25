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
Route::group(['middleware' => 'web'], function () {
    /*
    |------------------------------------------------------------------------------------
    | Admin
    |------------------------------------------------------------------------------------
    */
    Route::group(['namespace' => 'Backend', 'prefix' => ADMIN, 'as' => ADMIN . '.', 'middleware'=>['auth', 'Role:10']], function () {
        Route::get('/',    'MainController@getIndex');
        Route::get('/stats',                'StatsController@index')->name('stats.index');
        Route::resource('users',            'UserController');
        Route::post('users/block/{id}', 'UserController@block')->name('users.block');
        Route::resource('placeholders',     'PlaceHoldersController');
        Route::group(["prefix" => "subscriptions"], function(){
            Route::get('/',                 'SubscriptionController@index')->name('subscriptions');
            Route::get('/profile',          'SubscriptionController@getDetails')->name('subscriptions.details');
            Route::get('/profile/update',  'SubscriptionController@cancel')->name('subscriptions.cancel');
            Route::get('/profile/edit',     'SubscriptionController@edit')->name('subscriptions.edit');
            // post
            Route::post('/profile/update',  'SubscriptionController@update')->name('subscriptions.update');
        });
        Route::group(["prefix" => "content-management"], function(){
            Route::get('/remove-repeater-fields',    'ContentManagementController@getRemoveRepeaterFields');
            Route::get('/repeater-fields'       ,    'ContentManagementController@getRepeaterFields');
        });
        Route::resource('content-management',    'ContentManagementController');
        Route::group(["prefix" => "settings"], function(){
            // ---------- Post Method ---------- //
            Route::post('default-cover',     'SettingsController@postDefaultCover');
            Route::post('default-avatar',    'SettingsController@postDefaultAvatar');
            Route::post('social',            'SettingsController@postSocial');
            Route::post('general',           'SettingsController@postGeneral');
            Route::post('paypal',            'SettingsController@postPaypal');
            // ---------- Get Method ---------- //
            Route::get('/',    'SettingsController@getIndex');
        });
    });
    /*
    |------------------------------------------------------------------------------------
    | Client
    |------------------------------------------------------------------------------------
    */
    Route::group(['namespace' => 'Frontend'], function () {
        Route::group(['middleware' => 'guest'], function () {
            Route::get('/',                     'MainController@getIndex')->name('home');
            Route::get('pricing',               'MainController@getPricing')->name('pricing');
            Route::get('features',              'MainController@getFeatures')->name('features');
            Route::get('terms-and-conditions',   'MainController@getTermsAndConditions')->name('terms-and-conditions');
            Route::get('privacy-policy',        'MainController@getPrivacyPolicy')->name('privacy-policy');
        });

        Route::get('contact',   'MainController@getContact')->name('contact');
        Route::post('contact',  'MainController@postContact')->name('contact');

        Route::group(['middleware' => ['prevent-back-history', 'auth', 'User', 'verified']], function () {
            Route::get('load-template/{id}',    'ProfileController@getLoadTemplate')->name('load.template');
            Route::get('append-template',       'ProfileController@getAppendTemplate')->name('append.template');

            Route::group(['prefix' => 'profile'], function () {
                Route::get('/',             'ProfileController@getProfile')->name('profile.index');
                Route::get('/getForm',      'ProfileController@getPageForm')->name('pageTemplate.getForm');
                Route::get('/getModal',     'ProfileController@getGeneratedPage')->name('pageTemplate.getStatsModal');
                Route::get('/get-paypal-profile',     'ProfileController@getPaypalProfile')->name('paypal.getProfile');
                Route::get('/get-paypal-invoice',     'ProfileController@getProfileInvoice')->name('paypal.getInvoice');

                Route::post('/',            'ProfileController@postProfile')->name('profile.save');
                Route::post('/deletePage',  'ProfileController@deletePage')->name('pageTemplate.deletePage');
                Route::post('/deleteURL',  'ProfileController@deleteGenerated')->name('pageTemplate.deleteGenPage');
                Route::post('/savePage',    'ProfileController@postPageTemplate')->name('pageTemplate.save');
                Route::post('/credential/update',    'ProfileController@updateCredential')->name('credential.update');


                Route::post('save-placeholder',    'ProfileController@postSavePlaceholder')->name('profile.save-placeholder');
            });
        });
    });
    Route::group(['namespace' => 'Frontend'], function () {
        Route::group(['prefix' => 'paypal'], function () {
            Route::get('/express-checkout',             'PaypalController@expressCheckout')->name('paypal.express-checkout');
            Route::get('/express-checkout-success',     'PaypalController@expressCheckoutSuccess');
            Route::post('/cancel-subscription',         'PaypalController@cancelSubscription')->name('cancel.subscription');
            Route::post('/request-cancel-subscription', 'PaypalController@requestCancelSubscription')->name('request.cancel.subscription');
        });
        Route::group(['prefix' => 'profile'], function () {
            Route::post('/postView',     'ProfileController@postView')->name('page.createView');
            Route::post('/postClick',    'ProfileController@postClick')->name('page.createClick');
        });
    });
    Auth::routes(['verify' => true]);

    Route::group(['namespace' => 'Frontend'], function () {
        Route::get('{id}/{innerId}',        'ProfileController@getProfilePage')->name('inner.page');
        Route::get('{id}',                  'ProfileController@getProfilePage')->name('profile.page');

        Route::post('{id}',                 'ProfileController@postProfilePage')->name('profile.savepage');
    });

    Route::group(['namespace' => 'Mail'], function () {
        Route::post('/email/{id}',          'MailController@sendEmail')->name('send.mail');
    });

});
