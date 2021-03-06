<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 16-10-2018
 * Time: 17:20
 */

session_start();
if(!empty($_SESSION)) {

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        var_dump($_POST);
        $id = $_POST['id'];
        $date_event = convert($_POST['date_event']);
        $eventname = convert($_POST['eventname']);
        $description = convert($_POST['description']);

        $picture = $_FILES['pictures'];
        $filename = $_FILES['pictures']['name'];
        $fileTmpname = $_FILES['pictures']['tmp_name'];
        $fileError = $_FILES['pictures']['error'];
        $filetype = $_FILES['pictures']['type'];

        $fileExt = explode('.', $filename);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png');

        if (in_array($fileActualExt, $allowed)) {
            $newFileName = uniqid('', true) . "." . $fileActualExt;
            $fileDestination = 'uploads/' . $newFileName;
            move_uploaded_file($fileTmpname, $fileDestination);

        } else {
            echo 'bestand wordt niet ondersteun. <br> wij ondersteunen .jpg, .jpeg en .png';
        }

        $results = $app['database']->updateEvent($date_event, $eventname, $fileDestination, $description, $id);
        header('location: /dashboard/evenement');
    }
    elseif($_SERVER["REQUEST_METHOD"] == "GET") {
        $id = $_GET['id'];
        $results = $app['database']->selectOne('events', $id);
        require 'views/dashboard/dashboardevenementenedit.view.php';
    }
}
else{
    header('Location: /login');
}

function convert($data){
    $data = htmlspecialchars($data);
    $data = stripcslashes($data);
    return $data;
}