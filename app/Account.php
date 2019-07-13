<?php
namespace App;

class Account
{
    protected $data = [
        'name', 'user_id', 'is_log',
    ];
    public $status = 0;
    public function __construct()
    {
        echo 'Account <br>';
    }
}
