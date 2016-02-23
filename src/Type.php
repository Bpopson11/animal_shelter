<?php

    class Type
    {
        private $name;
        private $id;

        function __construct($name, $id = null)
        {
            $this->name = $name;
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

        function getId()
        {
            return $this->id;
        }

        function getAnimals()
        {
            $animals = array();
            $returned_animals = $GLOBALS['DB']->query("SELECT * FROM pets WHERE type_id = {$this->getId()}");
            foreach($returned_animals as $animal) {
                $name = $animal['name'];
                $breed = $animal['breed'];
                $gender = $animal['gender'];
                $admit_date = $animal['admit_date'];
                $id = $animal['id'];
                $type_id = $animal['type_id'];
                $new_animal = new Animal($name, $breed, $gender, $admit_date, $id, $type_id);
                array_push($animals, $new_animal);
            }
            return $animals;
        }


        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO types (name) VALUES ('{$this->getName()}')");
            $this->id= $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_types = $GLOBALS['DB']->query("SELECT * FROM types;");
            $types = array();
            foreach($returned_types as $type) {
                $name = $type['name'];
                $id = $type['id'];
                $new_type = new Type($name, $id);
                array_push($types, $new_type);
            }
            return $types;
        }

        static function deleteAll()
        {
          $GLOBALS['DB']->exec("DELETE FROM types;");
        }

    }

?>
