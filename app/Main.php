<?php
namespace App;
use App\Display;
use App\controllers as Controladores;
class Main
{
    protected $data = [
        'is_log'
    ];

    var $enlace = false;
    var $productsController = null;
    var $products = [];
    var $parameters = [];

    public $status = 0;
    public function __construct()
    {
		$this->enlace = mysqli_connect(HOST, USER, PASS, BD);

  		new Controladores\Session();
  		$productsController = new Controladores\Products();
  		$this->products = $productsController->getProducts($this->enlace);
  		
  		$this->parameters = [
  			'products' => $this->products 
  		];

  		
  		if ( !$_SESSION['permitted'] || $_SESSION['permitted'] === "false" )
  		{
  			new Display('LandingPage',$this->parameters);
  			exit;
  		}else if( $_SESSION['permitted'] ){
  				$this->toPage($_SESSION['page']);
  			exit;
  		}

    	$this->connect();
    }

    public function toPage(string $page)
    {
    	switch ($page) {
    		case 'login':
    			if (count($_POST)>0)
    			{
    				$this->proccessLogin($_POST);
    			}else{
    				new Display('Login');
    			}
    			break;
    		
    		case 'home':
    			new Display('LandingPage',$this->parameters);
    			break;
    		default:
    			new Display('LandingPage',$this->parameters);
    			break;
    	}
    }

    function proccessLogin(array $data)
    {
		if($this->enlace && !$this->enlace->connect_errno )
    	{
    		$u = $data['userApp'];
    		$p = sha1($data['passApp']);
			$sql = "SELECT * FROM `users` WHERE `username` LIKE '$u' AND `password` LIKE '$p' LIMIT 1";
    		
    		if (!$resultado = $this->enlace->query($sql)) {
			    // ¡Ups, La consulta falló! 
			    echo "Lo sentimos, este sitio web está experimentando problemas.";

			    // De nuevo, no hacer esto en un sitio público, aunque nosotros mostraremos
			    // cómo obtener información del error
			    echo "Error: La ejecución de la consulta falló debido a: \n";
			    echo "Query: " . $sql . "\n";
			    echo "Errno: " . $mysqli->errno . "\n";
			    echo "Error: " . $mysqli->error . "\n";
			    exit;
			}else{
				if ($resultado->num_rows === 0) {
				    // Usuario no encntrado 
				    $parameters = [
				    	'error' => "We are sorry. Could not find an account, Please Try again." 
				    ];
					new Display('Login',$parameters);
				    exit;
				}else{
					// si existe resultado
					$acc = $resultado->fetch_assoc();
					// Aqui se inicializan los datos de session
					$_SESSION['acc'] = $acc->username;
					$_SESSION['acc_id'] = $acc->id;
					$_SESSION['acc_type'] = $acc->type;
					$_SESSION['acc_status'] = $acc->status;
					header('Location: '.URL_HOST.'home');
				}
			}
    	}
    }

    public function connect()
    {    	
		if (!$this->enlace) {
			
			$parameters =[
				'error' => 	"Error: No se pudo conectar a MySQL." . PHP_EOL."<br>".
				   		   	"errno de depuración: " . mysqli_connect_errno() . PHP_EOL."<br>".
				   			"error de depuración: " . mysqli_connect_error() . PHP_EOL
			];

			new Display('Error',$parameters);
		    exit;
		}else{
			$parameters =[
				'ok' => 	"Éxito: Se realizó una conexión apropiada a MySQL! La base de datos mi_bd es genial." . PHP_EOL.
				   		   	"Información del host: " . mysqli_get_host_info($this->enlace) . PHP_EOL
			];

			new Display('Start',$parameters);
		    
		}


		mysqli_close($this->enlace);
    }
}
