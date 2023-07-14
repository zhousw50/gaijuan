<?php
include_once "config.php";
$link->query("CREATE TABLE `zhousw`.`teachers` (`subject` TEXT NOT NULL , `id` INT NOT NULL , `name` TEXT NOT NULL , `pwd` TEXT NOT NULL )");
$link->query("CREATE TABLE `zhousw`.`students` (`class` INT NOT NULL , `id` INT NOT NULL , `name` TEXT NOT NULL , `pwd` TEXT NOT NULL )");
$link->query("CREATE TABLE `zhousw`.`exams` (`id` INT NOT NULL , `name` TEXT NOT NULL , `config` TEXT NOT NULL , `finish` INT NOT NULL )");
?>