<?PHP
    include "./Information.php";
    if(isset($_POST["name"]) && isset($_POST["text"]) && isset($_POST["id_doc"]) && isset($_SESSION["username"]))
    {
        $db->send_sql("SELECT can_write FROM permissions WHERE id_doc= ".$_POST["id_doc"]." AND id_user= ".$_SESSION["userid"]."");
        $yes = $db->next_row();
        if($yes)
        {
            if($yes["can_write"])
            {
                $db->send_sql("UPDATE documents SET name= '".addslashes($_POST["name"])."', text= '".addslashes($_POST["text"])."' WHERE id_doc= ".$_POST["id_doc"]."");
                echo "<tag>Document updated!<tag><BR/>";
                include "./User.php";
                return;
            }
        }
        echo "<important>You do not have writing permission on this document.<important><BR/>";
        include "./User.php";
        return;
    }
    else
    {
        include "./User.php";
        return;
    }
?>