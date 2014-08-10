<!DOCTYPe html>
<html>
    <head>
        <title>OCTE</title>
    </head>
    <body>
</html>
<?PHP
    include "./Information.php";
    if(isset($_SESSION["username"]))
    {
        $db->send_sql("SELECT id_doc, name FROM documents WHERE id_owner = ".$_SESSION["userid"]."");
        $docs = $db->next_row();
        if(!$docs)
        {
            echo "<important>You don't own any documents!</important><BR/>";
            include "./User.php";
            return;
        }
        $db1 = new database();
        $db2 = new database();
        $db1->setup($name, $pass, $host, $database);
        $db2->setup($name, $pass, $host, $database);
        $db1->send_sql("SELECT username, id_user FROM users WHERE id_user != ".$_SESSION["userid"]."");
        $users = $db1->next_row();
        if(!$users)
        {
            echo "<important>There are no other users.</important>";
            include "./User.php";
            return;
        }
        echo "<h1>Update permissions.</h1><BR/>";
        echo "<important>Note: Write privilege implies read privilege</important><BR/>";
        echo "<form action=\"Update.php\" method=\"post\">";
        do
        {
            echo "".$docs["name"].":<BR/>";
            do
            {
                $db2->send_sql("SELECT can_read, can_write FROM permissions WHERE id_user = ".$users["id_user"]."");
                $next = $db2->next_row();
                echo "<label>\t".htmlentities($users["username"])." ";
                if($next)
                {
                    if($next["can_read"])
                    {
                        echo "read <input type=\"checkbox\" name=\"read[]\" value=\"".$docs["id_doc"]."_".$users["id_user"]."\" checked> ";
                    }
                    else
                    {
                        echo "read <input type=\"checkbox\" name=\"read[]\" value=\"".$docs["id_doc"]."_".$users["id_user"]."\"> ";
                    }
                    if($next["can_write"])
                    {
                        echo "write <input type=\"checkbox\" name=\"write[]\" value=\"".$docs["id_doc"]."_".$users["id_user"]."\" checked>";
                    }
                    else
                    {
                        echo "write <input type=\"checkbox\" name=\"write[]\" value=\"".$docs["id_doc"]."_".$users["id_user"]."\">";
                    }
                }
                else
                {
                    echo "read <input type=\"checkbox\" name=\"read[]\" value=\"".$docs["id_doc"]."_".$users["id_user"]."\"> ";
                    echo "write <input type=\"checkbox\" name=\"write[]\" value=\"".$docs["id_doc"]."_".$users["id_user"]."\">";
                }
                echo "</label><BR/>";
            }while($users = $db1->next_row());
            $db1->send_sql("SELECT username, id_user FROM users WHERE id_user != ".$_SESSION["userid"]."");
            $users = $db1->next_row();
        }while($docs = $db->next_row());
        echo "<button type=\"submit\">Update Permissions</button>";
        echo "</form>";
    }
    else
    {
        include "./Index.php";
        return;
    }
?>
<html>
    </body>
</html>