<?PHP
    include "./Information.php";
    if(isset($_POST["username1"]) && isset($_POST["password1"]) && isset($_POST["password2"]))
    {
        if($_POST["password1"] === "" || $_POST["password2"] === "")
        {
            echo "Invalid password<BR/>";
            include "./Index.php";
            return;
        }
        if($_POST["password1"] === $_POST["password2"])
        {
            $db->send_sql("SELECT username FROM users WHERE username= '".addslashes($_POST["username1"])."'");
            $row = $db->next_row();
            if($row)
            {
                echo "<important>Another user already has that User Name. Please select another and try again.</important><BR/>";
                include "./Index.php";
                return;
            }
            $db->send_sql("INSERT INTO users (username, password) VALUES ('".addslashes($_POST["username1"])."', SHA2('".addslashes($_POST["password1"])."', 512))");
            $_POST["username"] = $_POST["username1"];
            $_POST["password"] = $_POST["password2"];
            echo "<tag>Login created!</tag>";
            include "./Login.php";
            return;
        }
        else
        {
            echo "Passwords did not match!<BR/>";
            include "./Index.php";
            return;
        }
    }
    else
    {
        include "./Index.php";
        return;
    }
?>