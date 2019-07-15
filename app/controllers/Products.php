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
        $products = self::executeSql($enlace, 'SELECT * FROM `products`');
        foreach ($products as $key => $p)
        {
            $products[$key]['starDinamic'] = self::calculateStars($p['score']);
        }
        return $products;
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
