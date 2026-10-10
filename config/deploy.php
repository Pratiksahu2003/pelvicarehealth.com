<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Browser deploy token (Hostinger / no SSH)
    |--------------------------------------------------------------------------
    |
    | Set DEPLOY_TOKEN in .env, then open /deploy/run?token=... once after upload.
    | Remove or rotate the token when finished.
    |
    */

    'token' => env('DEPLOY_TOKEN'),

];
