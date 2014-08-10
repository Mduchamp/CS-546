<!DOCTYPE html>
<html>
    <head>
        <title>OCTE</title>
    </head>
    <body>
</html>
<?PHP
    include "./Information.php";
    if(isset($_POST["action"]))
    {
        $action = "Display.php";
        if($_POST["action"] === "Own")
        {
            $echolater = "<h1>Select Owned Document to view</h1><BR/>";
            $sql = "SELECT id_doc FROM documents WHERE id_owner = '".$_SESSION["userid"]."'";
            $_SESSION["type"] = "write";
        }
        else if($_POST["action"] === "Write")
        {
            $echolater = "<h1>Select Writable Document to view</h1><BR/>";
            $sql = "SELECT id_doc FROM permissions WHERE id_user = ".$_SESSION["userid"]." AND can_write = 1";
            $_SESSION["type"] = "write";
        }
        else if($_POST["action"] === "Read")
        {
            $echolater = "<h1>Select Readable Document to view</h1><BR/>";
            $sql = "SELECT id_doc FROM permissions WHERE id_user = ".$_SESSION["userid"]." AND can_read = 1";
            $_SESSION["type"] = "read";
        }
        else if($_POST["action"] === "Create")
        {
            $_SESSION["type"] = "create";
            include "./Display.php";
            return;
        }
        else if($_POST["action"] === "Delete")
        {
            $echolater = "<h1>Select document to delete</h1><BR/><important>NOTE: DELETION IS PERMANENT AND CANNOT BE RECOVERED!</important><BR/>";
            $action = "Delete.php";
            $sql = "SELECT id_doc FROM documents WHERE id_owner = '".$_SESSION["userid"]."'";
            $_SESSION["type"] = "delete"; 
        }
        else if($_POST["action"] === "Privilege")
        {
            include "./Permissions.php";
            return;
        }
        else if($_POST["action"] === "Logout")
        {
            unset($_SESSION);
            include "./Index.php";
            return;
        }
        $db->send_sql($sql);
        $doc = $db->next_row();
        if(!$doc)
        {
            echo "<important>You don't have any such documents!</important><BR/>";
            include "./User.php";
            return;
        }
        echo "<a href=\"./User.php\">Back to User home</a><BR/>";
        echo $echolater;
        $db1 = new database();
        $db1->setup($name, $pass, $host, $database);
        echo "<nav class=\"radio_buttons\">";
        echo "<form action=\"".$action."\" method=\"post\">";
        do
        {
            $db1->send_sql("SELECT name FROM documents WHERE id_doc = ".$doc["id_doc"]."");
            $docname = $db1->next_row();
            echo "<input type=\"radio\" name=\"document\" value=\"".$doc["id_doc"]."\"><label>".htmlentities(stripslashes($docname["name"]))."</label><BR/>";
        }while($doc = $db->next_row());
        echo "<button type=\"submit\">Go</button>";
        echo "</nav>";
    }
    else
    {
        include "./User.php";
        return;
    }
?>
<html>
    </body>
</html>