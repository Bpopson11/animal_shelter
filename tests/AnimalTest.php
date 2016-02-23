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
            $name = "Dog";
            $id = null;
            $test_type = new Type($name, $id);
            $test_type->save();

            $name = "Spot";
            $breed = "Australian Cattledog";
            $gender = "male";
            $admit_date = "2016-02-11";
            $type_id = $test_type->getId();
            $test_animal = new Animal($name, $breed, $gender, $admit_date, $id,  $type_id);

            //Act
            $test_animal->save();

            //Assert
            $result = Animal::getAll();
            $this->assertEquals($test_animal, $result[0]);
        }

        function test_getName()
        {
            //Arrange
            $name = "Dog";
            $id = null;
            $test_type = new Type($name, $id);
            $test_type->save();

            $name = "Spot";
            $id = null;
            $breed = "Australian Cattledog";
            $gender = "male";
            $admit_date = "2016-02-11";
            $type_id = $test_type->getId();
            $test_animal = new Animal($name, $breed, $gender, $admit_date, $id, $type_id);

            //Act
            $result = $test_animal->getName();

            //Assert
            $this->assertEquals("Spot", $result);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Dog";
            $id = null;
            $test_type = new Type($name, $id);
            $test_type->save();

            $name = "Spot";
            $breed = "Australian Cattledog";
            $gender = "male";
            $admit_date = "2016-02-11";
            $type_id = $test_type->getId();
            $test_animal = new Animal($name, $breed, $gender, $admit_date, $id, $type_id);
            $test_animal->save();

            $name2 = "Tammy";
            $breed2 = "Husky";
            $gender2 = "female";
            $admit_date2 = "2016-01-30";
            $type_id2 = $test_type->getId();
            $test_animal2 = new Animal($name2, $breed2, $gender2, $admit_date2, $id, $type_id2);
            $test_animal2->save();

            //Act
            $result = Animal::getAll();


            //Assert
            $this->assertEquals([$test_animal, $test_animal2], $result);
        }

        function test_getTypeId()
        {
            //Arrange
            $name = "Dog";
            $id = null;
            $test_type = new Type($name, $id);
            $test_type->save();

            $name = "Spot";
            $breed = "Australian Cattledog";
            $gender = "male";
            $admit_date = "2016-02-11";
            $type_id = $test_type->getId();
            $test_animal = new Animal($name, $breed, $gender, $admit_date, $id, $type_id);
            $test_animal->save();

            //Act
            $result = $test_animal->getTypeId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_getId()
        {
            //Arrange
            $name = "Dog";
            $id = null;
            $test_type = new Type($name, $id);
            $test_type->save();

            $name = "Spot";
            $breed = "Australian Cattledog";
            $gender = "male";
            $admit_date = "2016-02-11";
            $type_id = $test_type->getId();
            $test_animal = new Animal($name, $breed, $gender, $admit_date, $id, $type_id);
            $test_animal->save();

            //Act
            $result = $test_animal->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

    }

 ?>
