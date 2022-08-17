<?php declare(strict_types=1);
try {
    $db = new PDO('mysql:host=localhost;charset=utf8;dbname=chatApp', 'root');
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// $db->exec('CREATE TABLE `messages` (
//     `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
//     `date` DATETIME 
//     `date` DATETIME 
//     `message` VARCHAR(500) NOT NULL
//     ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4')


$db->exec('CREATE TABLE IF NOT EXISTS `user` (
    `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `firstName` VARCHAR(255) NOT NULL, 
    `lastName` VARCHAR(255) NOT NULL, 
    `emailAdress` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL, 
    `image` VARCHAR(255) NOT NULL,
    `status` VARCHAR(255) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');

$db->exec('CREATE TABLE IF NOT EXISTS `message` (
    `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `userSenderId` INT(11) NOT NULL,
    `userReceiverId` INT(11) NOT NULL,
    `message` VARCHAR(255) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4')


?>
