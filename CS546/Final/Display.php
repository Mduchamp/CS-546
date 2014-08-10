<!DOCTYPE html>
<html>
    <head>
        <title>OCTE</title>
    </head>
    <body>
        <a href="./User.php">Back to User home</a><BR/>
</html>
<?PHP
    include "./Information.php";
    if(isset($_SESSION["username"]) && isset($_SESSION["type"]))
    {
        if($_SESSION["type"] === "create")
        {
            echo "<form action=\"Creation.php\" method=\"post\" id=\"submitter\">";
            echo "<button type=\"submit\">Create</button><BR/>";
            echo "<label>Name: </label><input type=\"text\" name=\"name\" size=\"16\" maxlength=\"100\" required><BR/>";
            echo "<textarea name=\"text\" form=\"submitter\"></textarea><BR/>";
            echo "<button type=\"submit\">Create</button>";
            echo "</form>";
        }
        else
        {
            if(isset($_POST["document"]))
            {
                $db->send_sql("SELECT name, text FROM documents WHERE id_doc= ".$_POST["document"]."");
                $stuff = $db->next_row();
                if($_SESSION["type"] === "write")
                {
                    $_SESSION["docid"] = $_POST["document"];
                    echo "<script async type=\"text/javascript\" src=\"./WritePoll.js\"></script>";
                    echo "<form action=\"Write.php\" method=\"post\" id=\"submitter\">";
                    echo "<input type=\"hidden\" name=\"id_doc\" value=\"".$_POST["document"]."\">";
                    echo "<button type=\"submit\">Submit</button><BR/>";
                    echo "<label>Name: </label><input type=\"text\" id=\"name\" name=\"name\" value=\"".htmlentities(stripslashes($stuff["name"]))."\" size=\"16\" maxlength=\"100\" required><BR/>";
                    echo "<textarea name=\"text\" form=\"submitter\">".htmlentities(stripslashes($stuff["text"]))."</textarea><BR/>";
                    echo "<button type=\"submit\">Submit</button>";
                    echo "</form>";
                }
                else if($_SESSION["type"] === "read")
                {
                    $_SESSION["docid"] = $_POST["document"];
                    echo "<script async type=\"text/javascript\" src=\"./Poll.js\"></script>";
                    echo "Name: ".htmlentities(stripslashes($stuff["name"]))."<BR/>";
                    echo "<textarea name=\"text\" readonly>".htmlentities(stripslashes($stuff["text"]))."</textarea><BR/>";
                }
            }
            else
            {
                unset($_SESSION["type"]);
                include "./User.php";
                return;
            }
        }
    }
    else
    {
        unset($_SESSION["type"]);
        include "./User.php";
        return;
    }
?>
<html>
    </body>
</html>