<?php

Route::group(['namespace' => 'Student'], function() {
    
    //studnet dashboard
    Route::get('/', 'HomeController@index')->name('student.dashboard');
    Route::get('/optout/home', 'MailVerificationController@optoutIndex')->name('student.optOutIndex');

    //student mail verification page
    Route::get('mail-verify', 'MailVerificationController@mailverify')->name('student.mailverify');


    // Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('student.login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('student.logout');

    // Register
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('student.register');
    Route::post('register', 'Auth\RegisterController@register');

    // Passwords
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('student.password.email');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('student.password.request');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('student.password.reset');

    // Must verify email
    Route::get('email/resend','Auth\VerificationController@resend')->name('student.verification.resend');
    Route::get('email/verify','Auth\VerificationController@show')->name('student.verification.notice');
    Route::get('email/verify/{id}','Auth\VerificationController@verify')->name('student.verification.verify');

    // Student Profile (view,edit)
    Route::get('profile', 'ProfileController@index')->name('student.profile'); 
    Route::get('edit', 'EditprofileController@edit')->name('student.editprofile');
    Route::post('update', 'EditprofileController@update')->name('student.updateprofile');

    //Student homepage
    Route::get('/profile', 'HomeController@stuprofile')->name('student.stuprofile');
    Route::get('/profile/showprofile','HomeController@showprofile')->name('student.showprofile');
    Route::get('/streams', 'HomeController@streams')->name('student.streams');
    Route::get('/appliedInternship', 'HomeController@appliedInternship')->name('student.appliedInternship');
    
    //OptOut
    Route::get('/optoutForm', 'HomeController@optout')->name('student.optout');
    Route::post('/optout/submit', 'HomeController@optoutsave')->name('student.optout.submit');

     //internship
     Route::get('/internship', 'HomeController@interndetails')->name('student.interndetails');
     Route::get('/internshipApply', 'HomeController@applyForInternship')->name('student.internapply');

     //feedback
     Route::get('/feedback', 'HomeController@giveFeedback')->name('student.giveFeedback');
     Route::post('/feedback/save', 'HomeController@feedbacksave')->name('student.feedback.save');
 
});