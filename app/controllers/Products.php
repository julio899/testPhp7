<?php
namespace App\controllers;

class Products
{
    public function __construct()
    {
    }

    /**
     * @param $enlace
     * @param $idProduct
     * @return mixed
     */
    public static function calculateStars($enlace, $idProduct)
    {

        $data_votes      = self::executeSql($enlace, 'SELECT * FROM `votes` WHERE `id_product` = ' . $idProduct);
        $total_votes     = count($data_votes);
        $total_stars     = 0;
        $total_promedies = 0;

        foreach ($data_votes as $key => $vote)
        {
            $total_stars += intval($vote['stars']);
        }

        if ($total_votes == 0)
        {
            $total_promedies = 0;
        }
        else
        {

            $total_promedies = number_format(floatval(($total_stars / $total_votes)), 2, '.', '');
        }

        return $total_promedies;
    }

    /**
     * @param $enlace
     * @param string $sql
     * @return mixed
     */
    public static function executeSql($enlace, $sql)
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
     * @param $sql
     */
    public static function executeSqlOnlyPush($enlace, $sql)
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
                return true;
            }
        }
    }

    /**
     * @param $enlace
     * @param $id_product
     */
    public static function getClasificationByUser($enlace, $id_product)
    {
        if (!isset($_SESSION['acc_id']))
        {
            return array();
        }
        else
        {

            return self::executeSql($enlace, 'SELECT * FROM `votes` WHERE `id_product` = ' . $id_product . ' AND `id_user` = ' . $_SESSION['acc_id'] . ' LIMIT 1');
        }
    }

    /**
     * @param $enlace
     * @param $id_product
     */
    public function getCommentProductByUser($enlace, $id_product)
    {
        echo json_encode(self::executeSql($enlace, 'SELECT * FROM `votes` WHERE `id_product` = ' . $id_product . ' AND `id_user` = ' . $_SESSION['acc_id'] . ' LIMIT 1'));
        exit();
    }

    /**
     * @param $id_product
     */
    public function getCommentsProduct($enlace, $id_product)
    {
        echo json_encode(self::executeSql($enlace, 'SELECT * FROM `votes` WHERE `id_product` = ' . $id_product));
        exit();
    }

    /**
     * @param $enlace
     */
    public static function getProducts($enlace)
    {
        $products = self::executeSql($enlace, 'SELECT * FROM `products` WHERE `id` > 0');
        foreach ($products as $key => $p)
        {
            $products[$key]['starDinamic'] = self::calculateStars($enlace, $p['id']); // self::calculateStars($p['score']);
            $products[$key]['starByUser']  = self::getClasificationByUser($enlace, $p['id']);
        }
        return $products;
    }

    /**
     * @param $parameters
     */
    /**
     * @param $enlace
     * @param $idProduct
     * @param $star
     */
    public function processing($enlace, $parameters)
    {
        $total    = 0;
        $status   = 'CANCEL';
        $msg      = '';
        $itensTxt = '[' . $parameters . ']';
        // Convert JSON string to Array
        $itensArray = json_decode($itensTxt, true);
        foreach ($itensArray as $key => $value)
        {
            if (isset($value['totals']))
            {
                $total = $total + (floatval($value['price']) * intval($value['totals']));
            }
        }
        // add Truck Tax
        // $total += floatval($itensArray['truck']);
        if ($_SESSION['acc_balance'] >= $total)
        {
            $balance = number_format((floatval($_SESSION['acc_balance']) - $total), 2, '.', '');
            // SQL UPDATE BD
            $resp = self::executeSqlOnlyPush($enlace, "INSERT INTO `orders` (`id`, `itens`, `idUser`, `date`, `status`, `total`) VALUES (NULL, '" . $itensTxt . "', '" . $_SESSION['acc_id'] . "', CURRENT_TIMESTAMP, '1','" . $total . "')");

            $resp2 = self::executeSqlOnlyPush($enlace, "UPDATE `users` SET `balance` = '$balance' WHERE `users`.`id` = " . $_SESSION['acc_id'] . "; ");

            if ($resp2 == $resp)
            {
                // Now refresh data
                $_SESSION['acc_balance'] = $balance;
                $status                  = 'OK';
            }
        }
        else
        {
            $msg = 'Sorry, but yours balance is insuficient';
        }

        echo json_encode(
            array(
                'total'  => $total,
                'status' => $status,
                'msg'    => $msg,
            )
        );
    }

    /**
     * @param $enlace
     * @param $idProduct
     * @param $star
     */
    public function recalculeStar($enlace, $idProduct, $star)
    {
        $stars_count = self::executeSql($enlace, "SELECT COUNT(*) as stars_count FROM `votes` WHERE id_product = $idProduct  AND stars = $star");
        if (!isset($stars_count[0]) && !isset($stars_count[0]['stars_count']))
        {
            return 0;
        }
        else
        {
            return $stars_count[0]['stars_count'];
        }
    }

    /**
     * @param $enlace
     * @param $dt
     */
    public static function saveClasificationByUser($enlace, $dt)
    {
        $status = '';
        // SQL UPDATE BD
        $resp = self::executeSqlOnlyPush($enlace, "INSERT INTO `votes` (`id`, `id_product`, `id_user`, `stars`, `commentary`, `date`) VALUES (NULL, '" . $dt['idProduct'] . "', '" . $_SESSION['acc_id'] . "', '" . $dt['stars'] . "', '" . str_replace('_', ' ', $dt['comment']) . "', CURRENT_TIMESTAMP);");
        if ($resp)
        {
            $status = 'OK';
        }

        echo json_encode(
            array(
                'status' => $status,
            ));
        exit();
    }

    public static function store()
    {
        /**
         *
        INSERT INTO `products` (`id`, `name`, `description`, `status`, `price`, `score`, `stars`) VALUES (NULL, 'Shoes', 'Shoes Sport color: White', 'A', '125.50', '{"star-1":3,"star-2":0,"star-3":0,"star-4":0,"star-5":3}', '0');
         */
        echo 'store';
    }

    /**
     * @param $data
     */
    /**
     * @param $enlace
     * @param $idProduct
     * @param $stars
     * @return mixed
     */
    public function updateClasificationByUser($enlace, $data)
    {
        $status = '';
        // SQL UPDATE BD
        $resp = self::executeSqlOnlyPush($enlace, "UPDATE `votes` SET `commentary` = '" . str_replace('_', ' ', $data['comment']) . "' , `stars` = " . $data['stars'] . " WHERE `votes`.`id_product` = " . $data['idProduct'] . " AND `votes`.`id_user` = " . $_SESSION['acc_id'] . ";");
        if ($resp)
        {
            $status = 'OK';
        }

        echo json_encode(
            array(
                'status'  => $status,
                'dinamic' => self::updateDinamicStar($enlace, $data['idProduct'], $data['stars']),
            ));
        exit();

    }

    /**
     * @param $enlace
     * @param $idProduct
     * @param $stars
     * @return mixed
     */
    public function updateDinamicStar($enlace, $idProduct, $stars)
    {

        $resp1 = self::executeSql($enlace, "SELECT `score` FROM `products` WHERE `id` = $idProduct LIMIT 1");
        $dt    = [];
        foreach ($resp1[0] as $key => $value)
        {
            $dt = json_decode($value, true);
        }
        $k = 0;

        $control = 1;
        // 5 stars
        foreach ($dt as $key => $value)
        {
            # UPDATE All STARS of THIS PRODUCT
            $dt[$key] = intval(self::recalculeStar($enlace, $idProduct, $control));
            $control++;
        }

        $strJSON = json_encode($dt);
        return self::executeSqlOnlyPush($enlace, "UPDATE `products` SET `score` = '$strJSON' WHERE `products`.`id` = $idProduct");

    }
}
