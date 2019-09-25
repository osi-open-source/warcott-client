<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Dynamic Data Mapper
    |--------------------------------------------------------------------------
    |
    | Setup API configs
    | You have to generate PASSWORD token directly from you api
    |
    */
    'url'   => env('WARCOTT_API_URL', 'https://api.warcott.com'),
    'token' => env('WARCOTT_API_TOKEN', ''),
    'verifyAccessPointSsl' => false
];