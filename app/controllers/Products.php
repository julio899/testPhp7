<?php
namespace App\controllers;

class Products
{
    public function __construct()
    {
    }

    /**
     * @param $scores
     */
    public static function calculateStars($scores)
    {
        $starsData  = (json_decode($scores, true));
        $totalVotes = 0;

        foreach ($starsData as $keyStar => $score)
        {
            # calculate total he votes of this product
            $totalVotes += intval($score);
        }
        // Calculate %
        $porcentages = [];
        $totalStars  = 0;

        foreach ($starsData as $keyStar => $score)
        {
            if (intval($score) > 0)
            {
                $porcentageInStar = number_format((($score * 100) / $totalVotes), 2);
                $stars            = number_format(($score * $porcentageInStar), 1) / 100;
                $totalStars += number_format($stars, 2);
                array_push($porcentages, array(
                    $keyStar . 'p' => $porcentageInStar,
                    'stars'        => $stars,
                ));
            }
        }

        $is_absolute = false;
        # is is 100% of the votes
        if (count($porcentages) === 1)
        {
            foreach ($porcentages[0] as $key => $value)
            {
                if (intval($value) == 100)
                {
                    $number      = str_replace('star-', '', $key);
                    $number      = trim(str_replace('p', '', $number));
                    $totalStars  = $number;
                    $is_absolute = true;
                }
            }
        }
        # Max of Star in screen 5
        if ($totalStars > 4.75 && !$is_absolute)
        {
            $totalStars = 5;
        }
        return $totalStars;
        /**
         * Documentation the logic by Julio Vinachi
         * ----------------------------------------
        var_dump(json_encode(
        array(
        'star-1' => 3,
        'star-2' => 0,
        'star-3' => 0,
        'star-4' => 0,
        'star-5' => 3,
        )
        ));
        total 6 Votes  -> 100%
        3* (of 5 star) -> ? => 50% de los votos son 5 star

        50%  50%
         *****+++++
        total 6 Votes

        5 star -> 100% votes completed in 5 star
        but
        5 star -> 50% votes completed in 5 star
        1 star -> 50% votes completed in 5 star

        100 -> 50
        5*  -> (2.5*)

        100 -> 50
        1*  -> (0.5*)

        Total star ( 2.5 + 0.5 ) = 3*
         */
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
        $products = self::executeSql($enlace, 'SELECT * FROM `products`');
        foreach ($products as $key => $p)
        {
            $products[$key]['starDinamic'] = self::calculateStars($p['score']);
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
            $total += floatval($value['price']);
        }

        if ($_SESSION['acc_balance'] >= $total)
        {
            // SQL UPDATE BD
            $resp = self::executeSqlOnlyPush($enlace, "INSERT INTO `orders` (`id`, `itens`, `idUser`, `date`, `status`, `total`) VALUES (NULL, '" . $itensTxt . "', '" . $_SESSION['acc_id'] . "', CURRENT_TIMESTAMP, '1','" . $total . "')");
            if ($resp)
            {
                // Now refresh data
                $_SESSION['acc_balance'] = number_format((floatval($_SESSION['acc_balance']) - $total), 2, '.', '');
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

    public static function saveClasificationByUser()
    {
        //INSERT INTO `votes` (`id`, `id_product`, `id_user`, `stars`, `commentary`) VALUES (NULL, '2', '1', '5', 'Excellent');
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
        $resp = self::executeSqlOnlyPush($enlace, "UPDATE `votes` SET `commentary` = '" . $data['comment'] . "' , `stars` = " . $data['stars'] . " WHERE `votes`.`id_product` = " . $data['idProduct'] . " AND `votes`.`id_user` = " . $_SESSION['acc_id'] . ";");
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
            # UPDATE All STARS THIS PRODUCT
            $dt[$key] = intval(self::recalculeStar($enlace, $idProduct, $control));
            $control++;
        }

        $strJSON = json_encode($dt);
        return self::executeSqlOnlyPush($enlace, "UPDATE `products` SET `score` = '$strJSON' WHERE `products`.`id` = $idProduct");

    }
}
