# testPhp7
you need make one file the config.php , in the root folder of the project,
where you specifique.
the next:
  -
    <?php

        // Config of Connection DB
        define("HOST", "localhost");
        define("USER", "root");
        define("PASS", "********");
        define("BD", "app_php7");

        // Uris Valids permitted
        # define constant, serialize array
        define("URIS", serialize(
            array("/", "login", "home")
        ));

        // extras
        define("URL_HOST", 'http://localhost/testPhp7/');
        define("DIR_BASE", __DIR__);

   ## Load file BDv0.1.sql the data
   ## composer update or composer install

----------
## Users
        user@user.com
        user1@user.com
        user2@user.com
        user3@user.com
        user4@user.com
        user5@user.com

        all the passwords  -> vinachi89