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

    class AnimalTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Animal::deleteAll();
            // Type::deleteAll();
        }

        function test_save()
        {
            //Arrange
            $name = "Spot";
            $breed = "Australian Cattledog";
            $gender = "male";
            $admit_date = "2016-02-11";
            $test_animal = new Animal($name, $breed, $gender, $admit_date);

            //Act
            $test_animal->save();

            //Assert
            $result = Animal::getAll();
            $this->assertEquals($test_animal, $result[0]);
        }

        function test_getName()
        {
            //Arrange
            $name = "Spot";
            $breed = "Australian Cattledog";
            $gender = "male";
            $admit_date = "2016-02-11";
            $test_animal = new Animal($name, $breed, $gender, $admit_date);

            //Act
            $result = $test_animal->getName();

            //Assert
            $this->assertEquals("Spot", $result);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Spot";
            $breed = "Australian Cattledog";
            $gender = "male";
            $admit_date = "2016-02-11";
            $test_animal = new Animal($name, $breed, $gender, $admit_date);
            $test_animal->save();

            $name2 = "Tammy";
            $breed2 = "Husky";
            $gender2 = "female";
            $admit_date2 = "2016-01-30";
            $test_animal2 = new Animal($name2, $breed2, $gender2, $admit_date2);
            $test_animal2->save();

            //Act
            $result = Animal::getAll();


            //Assert
            $this->assertEquals([$test_animal, $test_animal2], $result);
        }

    }

 ?>
