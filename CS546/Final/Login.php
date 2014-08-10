<?PHP
    include "./Information.php";
    if(isset($_POST["username"]) && isset($_POST["password"]))
       {
           $db->send_sql("SELECT * FROM users WHERE username = '".addslashes($_POST["username"])."' AND password = SHA2('".addslashes($_POST["password"])."', 512)");
           if($db->next_row())
           {
               $_SESSION["username"] = addslashes(htmlentities($_POST["username"]));
               $db->send_sql("SELECT id_user FROM users WHERE username = '".addslashes($_SESSION["username"])."'");
               $row = $db->next_row();
               $_SESSION["userid"] = $row["id_user"];
               include "./User.php";
           }
           else
           {
               echo "<important>No such user exists.<important><BR/>";
               include "./Index.php";
           }
       }
       else
       {
           include "./Index.php";
       }
?>