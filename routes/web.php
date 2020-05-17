<?php

Route::get
(
    config( 'hello-one-socialite.login_path' ),
    [ \HelloOne\Laravel\Socialite\LoginController::class, 'redirectToProvider' ]
)
     ->name( 'hello-one.login' );
