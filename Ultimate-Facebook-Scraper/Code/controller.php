<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

$email    = htmlspecialchars($_GET['email']);
$password = htmlspecialchars($_GET['password']);

if(isset($_GET['action'])) {
    $action = htmlspecialchars($_GET['action']);
    if ($action == "kill") {
        $pid = htmlspecialchars($_GET['pid']);
        echo exec("kill ".$pid. " echo $!");
    } else if ($action == "login" || $action == "scrap"){
       $progress_file = $email.".txt";
       
       // Login in synchronous mode (because we want to test if username and pass are correct
       if($action=="login")
           $async = " ";
       else if($action=="scrap") // Scrap in asynchronous mode because it lasts too long
           $async = "&";
       
       
       $commandScraper = "python3 scraper.py " . $email . " " . $password ." " . $action . " > " . $progress_file .  " 2>error.txt ". $async . " echo $!;";
       echo "pid=".exec($commandScraper, $output, $error);
       echo "output=".print_r(output);
       echo "error=".print_r($error);
    }
}





