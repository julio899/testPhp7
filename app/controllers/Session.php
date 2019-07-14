<?php
namespace App\controllers;

/**
 * Controllers Session
 */
class Session
{
    /**
     * @var mixed
     */
    public $permitted = false;

    /**
     * @var array
     */
    public $uri_permitted = [];

    /**
     * @var array
     */
    public $uri_request = [];

    public function __construct()
    {
        @session_start();
        $this->uri_permitted = unserialize(URIS);
        $_SESSION['uri']     = $this->process_url_request();

        $this->permitted = $this->url_exist_in_valids();
        # force to update always
        $_SESSION['permitted'] = $this->permitted;

        if (!isset($_SESSION['Start']))
        {
            $_SESSION['Start'] = date("Y-m-d h:i:s", time());
        }

        if (!isset($_SESSION['log']))
        {
            $_SESSION['log'] = 0;
        }

    }

    public static function logout()
    {
        $_SESSION = null;
        $_SESSION = array();
        @session_destroy();
        header('Location: ' . URL_HOST);
    }

    /**
     * @return mixed
     */
    public function process_url_request(): array
    {

        $uri = urldecode(
            parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
        );

        $parts_url  = explode('/', $uri);
        $arr_unique = array_unique($parts_url);

        $parts_clean = [];

        foreach ($arr_unique as $key => $value)
        {
            if ($value !== "")
            {
                array_push($parts_clean, $value);
            }

        }
        return $parts_clean;
    }

    /**
     * @return boolean
     */
    public function url_exist_in_valids(): bool
    {
        $is = false;
        if (count($_SESSION['uri']) == 1)
        {
            # if == 1 is because is in root
            $is               = true;
            $_SESSION['page'] = '/';
        }
        else
        {

            foreach ($this->uri_permitted as $key => $value)
            {

                foreach ($_SESSION['uri'] as $k => $v)
                {
                    if ($value === $v)
                    {
                        $is = true;
                    }
                }
            }
            $_SESSION['page'] = $_SESSION['uri'][1];
        }

        return $is;
    }
}
