<?php

    class Restaurant {

        private $name;
        private $id;


        function __construct($name, $id = null)
        {
            $this->name= $name;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name=$new_name;
        }

        function getId()
        {
            return $this->id;
        }

        function setId($new_id)
        {
            $this->id = $new_id;
        }


        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO restaurants (name) VALUES ('{$this->getName()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM restaurants *;");
        }

        static function getAll()
        {
             $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants;");
             $new_array = array();
             foreach ($returned_restaurants as $element)
             {
                 $name = $element['name'];
                 $id = $element['id'];
                 $new_restaurant = new Restaurant($name, $id);
                 array_push($new_array, $new_restaurant);
             }
                return $new_array;
        }
    }
?>
