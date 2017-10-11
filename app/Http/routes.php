<?php

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

#Route::get('/', 'WelcomeController@index');

Route::get('/', 'MainController@getComingSoon');
Route::get('beta', 'MainController@index');
Route::get('how-it-works', 'MainController@getHowItWorks');

Route::get('register-step-0', 'LoginController@getRegisterStep0');
Route::post('register-step-0', 'LoginController@postRegisterStep0');
Route::get('register-step-1', 'LoginController@getRegisterStep1');
Route::post('register-step-1', 'LoginController@postRegisterStep1');
Route::get('register-step-2', 'LoginController@getRegisterStep2');
Route::post('register-step-2', 'LoginController@postRegisterStep2');
Route::get('register-step-3', 'LoginController@getRegisterStep3');
Route::post('register-step-3', 'LoginController@postRegisterStep3');
Route::get('register-step-4', 'LoginController@getRegisterStep4');
Route::post('register-step-4', 'LoginController@postRegisterStep4');
Route::get('register-step-5', 'LoginController@getRegisterStep5');
Route::post('register-step-5', 'LoginController@postRegisterStep5');

Route::get('register/{pid?}', 'LoginController@getRegister');
Route::post('register', 'LoginController@postRegister');

Route::get('captcha', 'LoginController@getCaptcha');

Route::get('check-username', 'LoginController@getCheckUsername');
Route::get('check-email', 'LoginController@getCheckEmail');
Route::get('check-phone', 'LoginController@getCheckPhone');


Route::get('login', 'LoginController@getLogin');
Route::post('login', 'LoginController@postLogin');

Route::get('dashboard', 'MainController@getDashboard');
Route::post('counter', 'MainController@postCounter');
Route::get('donations', 'MainController@getDonations');
Route::get('news/{id?}', 'MainController@getNews');
Route::get('referrals', 'MainController@getReferrals');
Route::get('profile', 'MainController@getProfile');
Route::post('profile', 'MainController@postProfile');
Route::get('support', 'MainController@getSupport');
Route::get('create-ticket', 'MainController@getCreateTicket');
Route::post('create-ticket', 'MainController@postCreateTicket');
Route::get('warning', 'MainController@getWarning');
Route::get('terms', 'MainController@getTerms');
Route::get('privacy-policy', 'MainController@getPrivacyPolicy');
Route::get('vendors', 'MainController@getVendors');
Route::get('contact', 'MainController@getContact');
Route::post('contact', 'MainController@postContact');

Route::get('r2', 'MainController@getR2');

Route::get('verify/{id?}', 'LoginController@getVerify');

Route::get('forgot-username', 'LoginController@getForgotUsername');
Route::post('forgot-username', 'LoginController@postForgotUsername');

Route::get('forgot-password', 'Auth\PasswordController@getEmail');
Route::post('forgot-password', 'Auth\PasswordController@postEmail');

Route::get('logout', 'LoginController@getLogout');


Route::get('home', 'MainController@getDashboard');
//Route::get('init-packages', 'MainController@initPackages');
Route::get('test-app', 'MainController@getTest');

Route::post('mark-paid', 'MainController@postMarkPaid');
Route::post('cannot-pay', 'MainController@postCannotPay');
Route::post('confirm-pay', 'MainController@postConfirmPay');
Route::post('report-donation', 'MainController@postReportDonation');

Route::get('rc/{package}', 'MainController@getRecycle');
Route::get('block', 'MainController@getBlock');

Route::controllers([
	'password' => 'Auth\PasswordController',
]);




/** Admin routes **/
Route::get('admin/dashboard', 'AdminController@getDashboard');
Route::get('admin/site-settings', 'AdminController@getSiteSettings');
Route::get('admin/ssm/{pos}/{id}', 'AdminController@getSetSiteMessage');
Route::get('admin/asm', 'AdminController@getAddSiteMessage');
Route::post('admin/asm', 'AdminController@postAddSiteMessage');
Route::get('admin/legal-settings', 'AdminController@getLegalSettings');
Route::get('admin/edit-legal-information', 'AdminController@getEditLegalInformation');
Route::post('admin/edit-legal-information', 'AdminController@postEditLegalInformation');

Route::get('admin/slider-settings', 'AdminController@getSliderImages');
Route::get('admin/asi', 'AdminController@getAddSliderImage');
Route::post('admin/asi', 'AdminController@postAddSliderImage');
Route::get('admin/ssi/{pos}/{id}', 'AdminController@getSetSliderImage');

Route::get('admin/logo-settings', 'AdminController@getLogoSettings');
Route::get('admin/favicon-settings', 'AdminController@getFaviconSettings');

Route::get('admin/packages', 'AdminController@getPackages');
Route::get('admin/ep/{id}', 'AdminController@getEnablePackage');
Route::get('admin/dp/{id}', 'AdminController@getDisablePackage');
Route::get('admin/testimonials', 'AdminController@getTestimonials');


Route::get('admin/users', 'AdminController@getUsers');
Route::get('admin/activation-pins', 'AdminController@getActivationPins');
Route::get('admin/generate-activation-pin', 'AdminController@getGenerateActivationPin');
Route::post('admin/gap', 'AdminController@postGenerateActivationPin');
Route::get('admin/find-user', 'AdminController@getFindUser');
Route::post('admin/find-user', 'AdminController@postFindUser');

Route::get('admin/make-eligible', 'AdminController@getMakeEligible');
#Route::get('admin/find-eligible', 'AdminController@getFindEligible');
Route::post('admin/find-eligible', 'AdminController@postFindEligible');
Route::post('admin/make-eligible', 'AdminController@postMakeEligible');

Route::get('admin/view-donations', 'AdminController@getDonations');
Route::get('admin/donations', 'AdminController@getDonations');
Route::get('admin/find-donation', 'AdminController@getFindDonation');
Route::post('admin/find-donation', 'AdminController@postFindDonation');

Route::get('admin/tickets', 'AdminController@getTickets');
Route::get('admin/find-ticket', 'AdminController@getFindTicket');
Route::post('admin/find-ticket', 'AdminController@postFindTicket');
Route::get('st/{grepo}', 'AdminController@getRespondToTicket');

Route::get('admin/news/{id?}', 'AdminController@getNews');
Route::get('admin/add-news', 'AdminController@getAddNews');
Route::post('admin/add-news', 'AdminController@postAddNews');
Route::get('nmc/{grepo}', 'AdminController@getMarkNewsCurrent');

Route::get('admin/test', 'AdminController@getTest');
Route::get('admin/enable/{user}', 'AdminController@getEnable');
Route::get('admin/disable/{user}', 'AdminController@getDisable');

Route::get('admin/merge/{user}', 'AdminController@getMerge');
Route::get('admin/unmerge/{user}', 'AdminController@getUnmerge');

Route::get('ctest', 'MainController@getPractice');