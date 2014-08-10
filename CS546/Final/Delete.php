<?PHP
    include "./Information.php";
    if(isset($_POST["document"]))
    {
        $_SESSION["docid"] = $_POST["document"];
        echo "<script async type=\"text/javascript\" src=\"./WritePoll.js\"></script>";
        $db->send_sql("SELECT name FROM documents WHERE id_doc= ".$_POST["document"]."");
        $name = $db->next_row();
        $name = $name["name"];
        echo "<label>Are you sure you want to delete <tag>".$name."</tag>?</label><important> Deletions are unrecoverable.</important><BR/>";
        echo "<form action=\"ReallyDelete.php\" method=\"post\">";
        echo "<button type=\"submit\">Yes</button><BR/>";
        echo "</form>";
        echo "<form action=\"User.php\" method=\"post\">";
        echo "<button type=\"submit\">No</button>";
        echo "</form>";
    }
    else
    {
        include "./User.php";
        return;
    }
?>