# testPhp7
you need make one file the config.php , in the root folder of the project,
where you specifique.
the next:
  -
    <?php

    // Config of Connection DB
    define("HOST", "localhost");
    define("USER", "root");
    define("PASS", "Vinachi89.");
    define("BD", "app_php7");

    // Uris Valids permitted
    # define constant, serialize array
    define("URIS", serialize(
        array("/", "login", "home")
    ));

    # use it
    $my_fruits = unserialize(URIS);
    // extras
    define("URL_HOST", 'http://localhost/testPhp7/');
    define("DIR_BASE", __DIR__);
