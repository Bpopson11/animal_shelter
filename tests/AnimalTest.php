<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Animal.php";
    require_once "src/Type.php";

    $server = 'mysql:host=localhost;dbname=shelter_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class Animal extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Animal::deleteAll();
            Type::deleteAll();
        }

    }

 ?>
