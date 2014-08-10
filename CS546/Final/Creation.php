<?PHP
    include "./Information.php";
    if(isset($_POST["name"]) && isset($_POST["text"]) && isset($_SESSION["username"]))
    {
        $db->send_sql("INSERT INTO documents (id_owner, name, text) VALUES (".$_SESSION["userid"].", '".addslashes($_POST["name"])."', '".addslashes($_POST["text"])."')");
        $did = $db->insert_id();
        $db->send_sql("INSERT INTO permissions (id_doc, id_user, can_read, can_write) VALUES (".$did.", ".$_SESSION["userid"].", 1, 1)");
        echo "<tag>Document created!<tag><BR/>";
        include "./User.php";
        return;
    }
    else
    {
        include "./User.php";
        return;
    }
?>