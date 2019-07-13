<?php
namespace App;

class Account
{
    /**
     * @var int
     */
    public $status = 0;

    /**
     * @var array
     */
    protected $data = [
        'name', 'user_id', 'is_log',
    ];

    public function __construct()
    {
        echo 'Account <br>';
    }
}
