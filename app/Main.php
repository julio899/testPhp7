<?php
namespace App;
use App\Display;
use App\controllers as Controladores;
class Main
{
    protected $data = [
        'is_log'
    ];

    public $status = 0;
    public function __construct()
    {
  		new Controladores\Session();
  		
  		if ( !$_SESSION['permitted'] || $_SESSION['permitted'] === "false" )
  		{
  			new Display('LandingPage');
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
    			new Display('Login');
    			break;
    		
    		default:
    			new Display('LandingPage');
    			break;
    	}
    }

    public function connect()
    {    	
		$enlace = mysqli_connect(HOST, USER, PASS, BD);

		if (!$enlace) {
			
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
				   		   	"Información del host: " . mysqli_get_host_info($enlace) . PHP_EOL
			];

			new Display('Start',$parameters);
		    
		}


		mysqli_close($enlace);
    }
}
