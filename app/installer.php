<?php
namespace App;


class Installer
{
    public static function upMigrations(){
        sleep(30);
        require('config/db_credentials.php');
        $db =  mysqli_connect($db_credentials['host'], $db_credentials['username'], $db_credentials['password'], $db_credentials['database']);
        $queries = file_get_contents('app\Migrations\queries.sql');
        $queries = str_replace("#DATABASE#", $db_credentials['database'], $queries);
        
        $db->multi_query($queries);
        mysqli_close($db);
    }
}