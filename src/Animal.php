<?php

    class Animal
    {
        private $name;
        private $breed;
        private $gender;
        private $admit_date;
        private $id;

        function __construct($name, $breed, $gender, $admit_date, $id = null)
        {
            $this->name = $name;
            $this->breed = $breed;
            $this->gender = $gender;
            $this->admit_date = $admit_date;
            $this->id = $id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function setBreed($new_breed)
        {
            $this->breed = (string) $new_breed;
        }

        function getBreed()
        {
            return $this->breed;
        }

        function setGender($new_gender)
        {
            $this->gender = (string) $new_gender;
        }

        function getGender()
        {
            return $this->gender;
        }

        function setAdmit_date($new_admit_date)
        {
            $this->admit_date = (string) $new_admit_date;
        }

        function getAdmit_date()
        {
            return $this->admit_date;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO pet (name, breed, gender, admit_date) VALUES ('{$this->getName()}', '{$this->getBreed()}', '{$this->getGender()}', '{$this->getAdmit_date()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_animals = $GLOBALS['DB']->query("SELECT * FROM pet ;");
            $animals = array();
            foreach($returned_animals as $animal) {
                $name = $animal['name'];
                $breed = $animal['breed'];
                $gender = $animal['gender'];
                $admit_date = $animal['admit_date'];
                $id = $animal['id'];
                $new_animal = new Animal($name, $breed, $gender, $admit_date, $id);
                array_push($animals, $new_animal);
            }
            return $animals;
          }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM pet;");
        }


    }


?>
