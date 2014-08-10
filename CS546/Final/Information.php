<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="Style.css">
    </head>
</html>
<?PHP
    date_default_timezone_set("UTC");
    $name = "dev";
    $pass = "Prodigeit1";
    $host = "localhost"; //YOU CAN CHANGE ME BUT I'LL PROBABLY WORK
    $database = "document";
    if(!isset($db))
    {
        include "./databaseClassMySQLi.php";
        $db = new database();
        $db->setup($name, $pass, $host, $database);
    }
    if(!isset($_SESSION)){session_start();}
?>