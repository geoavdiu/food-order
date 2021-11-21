<?php

session_start();

define('SITEURL','http://localhost/projekt/');


$con = mysqli_connect('localhost','root',"",'food-order') or die(mysqli_error());
