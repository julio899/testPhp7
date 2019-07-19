<?php
namespace App;

use App\controllers as Controladores;
use App\Display;

class Main
{
    /**
     * @var mixed
     */
    public $enlace = false;

    /**
     * @var array
     */
    public $parameters = [];

    /**
     * @var array
     */
    public $products = [];

    /**
     * @var mixed
     */
    public $productsController = null;

    /**
     * @var int
     */
    public $status = 0;

    /**
     * @var array
     */
    private $post_params = [];

    public function __construct()
    {
        $this->post_params = $_POST;
        @session_start();
        $this->enlace = mysqli_connect(HOST, USER, PASS, BD);
        new Controladores\Session();

        $this->productsController = new Controladores\Products();

        $this->products = $this->productsController->getProducts($this->enlace);

        $this->parameters = [
            'products' => $this->products,
        ];

        $indexFromLocal = 0;

        if (isset($_SESSION['uri'][1]))
        {
            $indexFromLocal = 1;
        }

        if ($_SESSION['uri'][$indexFromLocal] == 'logout')
        {

            $_SESSION = null;
            $_SESSION = array();
            @session_destroy();
            header('Location: ' . URL_HOST . 'home');
            exit();
        }
        else if ($_SESSION['uri'][$indexFromLocal] == 'sendStars')
        {
            $dt = self::getInArray($this->post_params);
            $this->productsController->saveClasificationByUser($this->enlace, $dt);
        }
        else if ($_SESSION['uri'][$indexFromLocal] == 'updateStar')
        {
            $this->productsController->updateClasificationByUser(
                $this->enlace,
                self::getInArray($this->post_params)
            );
        }
        else if ($_SESSION['uri'][$indexFromLocal] == 'getCommentaries')
        {
            $postIdentifierArr = array();

            $jsonTxt = '';
            foreach ($this->post_params as $key => $postName)
            {
                array_push($postIdentifierArr, $key);
            }
            // in Array
            $dt = json_decode($postIdentifierArr[0], true);

            $this->productsController->getCommentsProduct($this->enlace, $dt['id']);

        }
        else if ($_SESSION['uri'][$indexFromLocal] == 'processing')
        {
            $postIdentifierArr = array();

            $jsonTxt = '';
            foreach ($this->post_params as $key => $postName)
            {
                foreach ($postName as $k2 => $v2)
                {
                    $jsonTxt = $k2;
                    array_push($postIdentifierArr, $jsonTxt);
                }

            }
            $this->productsController->processing($this->enlace, $postIdentifierArr[0]);
        }
        else if ($_SESSION['uri'][$indexFromLocal] == 'login')
        {
            $_SESSION['page'] = 'login';
            $this->toPage('login');

        }
        else if ($_SESSION['page'] == '/')
        {
            new Display('LandingPage', $this->parameters);
        }
        else if (!$_SESSION['permitted'] || $_SESSION['permitted'] === "false")
        {
            if ($_SESSION['page'] === 'logout')
            {
                Controladores\Session::logout();
            }
            else
            {
                header('Location: ' . URL_HOST);
            }

        }
        else if ($_SESSION['permitted'])
        {

            $this->toPage($_SESSION['page']);
            exit;
        }

        $this->connect();
    }

    public function connect()
    {
        if (!$this->enlace)
        {

            $parameters = [
                'error' => "Error: No se pudo conectar a MySQL." . PHP_EOL . "<br>" .
                "errno de depuración: " . mysqli_connect_errno() . PHP_EOL . "<br>" .
                "error de depuración: " . mysqli_connect_error() . PHP_EOL,
            ];

            new Display('Error', $parameters);
            exit;
        }

        mysqli_close($this->enlace);
    }

    /**
     * @param $data
     */
    public static function getInArray($data)
    {
        $postIdentifierArr = array();

        $jsonTxt = '';
        foreach ($data as $key => $postName)
        {
            array_push($postIdentifierArr, $key);
        }
        // in Array
        return json_decode($postIdentifierArr[0], true);
    }

    /**
     * @param array $data
     */
    public function proccessLogin(array $data)
    {
        if ($this->enlace && !$this->enlace->connect_errno)
        {
            $u   = $data['userApp'];
            $p   = sha1($data['passApp']);
            $sql = "SELECT * FROM `users` WHERE `username` LIKE '$u' AND `password` LIKE '$p' LIMIT 1";

            if (!$resultado = $this->enlace->query($sql))
            {
                // ¡Ups, La consulta falló!
                echo "Lo sentimos, este sitio web está experimentando problemas.";

                // De nuevo, no hacer esto en un sitio público, aunque nosotros mostraremos
                // cómo obtener información del error
                echo "Error: La ejecución de la consulta falló debido a: \n";
                echo "Query: " . $sql . "\n";
                echo "Errno: " . $mysqli->errno . "\n";
                echo "Error: " . $mysqli->error . "\n";
                exit;
            }
            else
            {
                if ($resultado->num_rows === 0)
                {
                    // Usuario no encntrado
                    $parameters = [
                        'error' => "We are sorry. Invalid email/password combination!, Please Try again.",
                    ];
                    new Display('Login', $parameters);
                    exit;
                }
                else
                {
                    // si existe resultado
                    $acc = [];

                    while ($row = $resultado->fetch_assoc())
                    {
                        $acc = $row;
                    }

                    // Aqui se inicializan los datos de session
                    $_SESSION['acc']         = $acc['username'];
                    $_SESSION['acc_id']      = $acc['id'];
                    $_SESSION['acc_type']    = $acc['type'];
                    $_SESSION['acc_status']  = $acc['status'];
                    $_SESSION['acc_balance'] = number_format($acc['balance'], 2, '.', '');

                    header('Location: ' . URL_HOST . 'home');
                }
            }
        }
    }

    /**
     * @param string $page
     */
    public function toPage($page)
    {
        switch ($page)
        {
            case 'login':
                if (count($this->post_params) > 0)
                {
                    $this->proccessLogin($this->post_params);
                }
                else
                {
                    new Display('Login');
                }
                break;

            case 'home':
                new Display('LandingPage', $this->parameters);
                break;
            case 'logout':
                Controladores\Session::logout();
                break;
            case 'processing':
                $postIdentifierArr = array();

                $jsonTxt = '';
                foreach ($this->post_params as $key => $postName)
                {
                    foreach ($postName as $k2 => $v2)
                    {
                        $jsonTxt = $k2;
                        array_push($postIdentifierArr, $jsonTxt);
                    }

                }

                //echo json_encode($postIdentifierArr[0], true)
                $this->productsController->processing($this->enlace, $postIdentifierArr[0]);

                break;
            default:
                header('Location: ' . URL_HOST);
                exit();
                break;
        }
    }
}
