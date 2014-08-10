<?PHP
    include "./Information.php";
    $db->send_sql("SELECT id_doc FROM documents WHERE id_owner = ".$_SESSION["userid"]."");
    $db1 = new database();
    $db1->setup($name, $pass, $host, $database);
    while($row = $db->next_row())
    {
        $db1->send_sql("UPDATE permissions SET can_read=0, can_write=0 WHERE id_doc= ".$row["id_doc"]." AND id_user != ".$_SESSION["userid"]."");
    }
    if(isset($_POST["read"]))
    {
        foreach($_POST["read"] as $string)
        {
            $index = strpos($string, "_");
            $id_doc = substr($string, 0, $index);
            $id_user = substr($string, ($index+1));
            $db->send_sql("SELECT can_read FROM permissions WHERE id_doc= ".$id_doc." AND id_user= ".$id_user."");
            if($db->next_row())
            {
                $db->send_sql("UPDATE permissions SET can_read=1, can_write=0 WHERE id_doc= ".$id_doc." AND id_user= ".$id_user."");
            }
            else
            {
                $db->send_sql("INSERT INTO permissions (id_doc, id_user, can_read, can_write) VALUES (".$id_doc.", ".$id_user.", 1, 0)");
            }
        }
    }
    if(isset($_POST["write"]))
    {
        foreach($_POST["write"] as $string)
        {
            $index = strpos($string, "_");
            $id_doc = substr($string, 0, $index);
            $id_user = substr($string, ($index+1));
            $db->send_sql("SELECT can_write FROM permissions WHERE id_doc= ".$id_doc." AND id_user= ".$id_user."");
            if($db->next_row())
            {
                $db->send_sql("UPDATE permissions SET can_read=1, can_write=1 WHERE id_doc= ".$id_doc." AND id_user= ".$id_user."");
            }
            else
            {
                $db->send_sql("INSERT INTO permissions (id_doc, id_user, can_read, can_write) VALUES (".$id_doc.", ".$id_user.", 1, 1)");
            }
        }
    }
    echo "<tag>Permissions updated<tag><BR/>";
    include "./User.php";
    return;

?>