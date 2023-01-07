<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Registration user strategy
    |--------------------------------------------------------------------------
    |
    | Using this configuration, a user registration strategy has
    | been considered, which includes the following items
    |
    | email
    | mobile
    |
    */

    'strategy' => env('AUTHENTICATION_STRATEGY', 'email')

];
