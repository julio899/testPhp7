<?php
namespace App;

class Display
{
    protected $data = [
        'name', 'user_id', 'is_log',
    ];
    public $status = 0;

    public function __construct(string $name, array $parameters = [])
    {
        $this->setHeader();

        if (is_readable(DIR_BASE . '/src/views/' . $name . '.php'))
        {
            include DIR_BASE . '/src/views/' . $name . '.php';
        }

        $this->setFooter();
    }

    public function setHeader()
    {
        include DIR_BASE . '/src/views/html/Header.php';
    }

    public function setFooter()
    {
        include DIR_BASE . '/src/views/html/Footer.php';
    }
}
