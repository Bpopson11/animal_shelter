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

    class TypeTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Type::deleteAll();
            Animal::deleteAll();
        }

        function test_getAnimals()
        {
            //Arrange
            $name = "Dog";
            $id = null;
            $test_type = new Type($name, $id);
            $test_type->save();

            $test_type_id = $test_type->getId();

            $name = "Spot";
            $breed = "Australian Cattledog";
            $gender = "male";
            $admit_date = "2016-02-11";
            $test_animal = new Animal($name, $breed, $gender, $admit_date, $id, $test_type_id);
            $test_animal->save();

            $name2 = "Tammy";
            $breed2 = "Husky";
            $gender2 = "female";
            $admit_date2 = "2016-01-30";
            $test_animal2 = new Animal($name2, $breed2, $gender2, $admit_date2, $id, $test_type_id);
            $test_animal2->save();

            //Act
            $result = $test_type->getAnimals();

            //Assert
            $this->assertEquals([$test_animal, $test_animal2], $result);
        }

        function test_getName()
        {
            //Arrange
            $name = "Dog";
            $test_Name = new Type($name);

            //Act
            $result = $test_Name->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Dog";
            $id = 1;
            $test_Type = new Type($name, $id);

            //Act
            $result = $test_Type->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            //Arrange
            $name = "Dog";
            $test_Type = new Type($name);
            $test_Type->save();

            //Act
            $result = Type::getAll();

            //Assert
            $this->assertEquals($test_Type, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Dog";
            $name2 = "Cat";
            $test_Type = new Type($name);
            $test_Type->save();
            $test_Type2 = new Type($name2);
            $test_Type2->save();

            //Act
            $result = Type::getAll();
            var_dump($result);

            //Assert
            $this->assertEquals([$test_Type, $test_Type2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Dog";
            $name2 = "Cat";
            $test_Type = new Type($name);
            $test_Type->save();
            $test_Type2 = new Type($name2);
            $test_Type2->save();

            //Act
            Type::deleteAll();
            $result = Type::getAll();

            //Assert
            $this->assertEquals([], $result);
        }
    }
?>
