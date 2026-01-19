<?php

require_once "car.php";
require_once "connect.php";

// Create a new Car instance
$car = new Car("Honda", "Civic", 2024);
//Civic, creative I know lol
// Output car information
echo "<h2>Car Information</h2>";
echo "<p>" . $car->getCarInfo() . "</p>";

/*
Reflection:

Creating the Car class and working with object-oriented PHP was easy enough,
especially defining properties and methods.

The database connection was the difficult part(which is why this assignment was late