<?php
namespace App\controllers;

class Products
{
    public function __construct()
    {
    }

    /**
     * @param $enlace
     * @param string $sql
     * @return mixed
     */
    public static function executeSql($enlace, string $sql)
    {
        # $enlace = mysqli_connect(HOST, USER, PASS, BD);
        if ($enlace)
        {

            if (!$resultado = $enlace->query($sql))
            {
                // ¡Ups, La consulta falló!
                echo "Lo sentimos, este sitio web está experimentando problemas.";
                echo "Error: La ejecución de la consulta falló debido a: \n";
                echo "Query: " . $sql . "\n";
                echo "Errno: " . $mysqli->errno . "\n";
                echo "Error: " . $mysqli->error . "\n";
                exit;
            }
            else
            {
                $dt = [];
                while ($row = $resultado->fetch_assoc())
                {
                    array_push($dt, $row);
                }
                return $dt;
            }
        }
    }

    /**
     * @param $enlace
     */
    public static function getProducts($enlace)
    {
        return self::executeSql($enlace, 'SELECT * FROM `products`');
    }

    public static function store()
    {
        /**
         *
        INSERT INTO `products` (`id`, `name`, `description`, `status`, `price`, `score`, `stars`) VALUES (NULL, 'Shoes', 'Shoes Sport color: White', 'A', '125.50', '[\r\n  { \"start\":1, \"points\":0 },\r\n  { \"start\":2, \"points\":0 },\r\n  { \"start\":3, \"points\":0 },\r\n  { \"start\":4, \"points\":0 },\r\n  { \"start\":5, \"points\":0 },\r\n]', '0');
         */
        echo 'store';
    }
}
