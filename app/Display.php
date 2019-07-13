<?php
namespace App;

class Display
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

    /**
     * @param string $name
     * @param array $parameters
     */
    public function __construct(string $name, array $parameters = [])
    {
        $this->setHeader();

        if (is_readable(DIR_BASE . '/src/views/' . $name . '.php'))
        {
            include DIR_BASE . '/src/views/' . $name . '.php';
        }

        $this->setFooter();
    }

    public function setFooter()
    {
        include DIR_BASE . '/src/views/html/Footer.php';
    }

    public function setHeader()
    {
        include DIR_BASE . '/src/views/html/Header.php';
    }
}
