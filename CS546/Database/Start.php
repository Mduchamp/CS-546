<?PHP
    date_default_timezone_set("UTC");
    include './Controller.php';
    include './Information.php';
    $db = new database();
    $db->setup($user, $pass, $host, $database);
    if(isset($_POST["page"]))
    {
        $page = $_POST["page"];
        if(file_exists($page))
        {
            $a = strripos($page,".html");
            $b = strripos($page,".htm");
            if($a !== False || $b !== False)
            {
                echo "".$page."\\".$e."";
                $sql = "INSERT INTO files (name, url) VALUES('".$e."','".$page."\\".$e."')";
                $sql = str_replace("\\", "\\\\", $sql); 
                $db->send_sql($sql);
                $id_file = $db->insert_id();
                Indexer($page, $db, $id_file);
                echo "<a href=\"./Searcher.html\">Indexed!</a>";
            }
            else if(is_dir($page))
            {
                Controller($page, $db);
                echo "<a href=\"./Searcher.html\">Indexed!</a>";
            }
            else
            {
                echo "You gave me garbage!";
            }
        }
        else
        {
            echo "You gave me garbage!";
        }
    }
    else
    {
        echo "You didn't use the form!";
    }
?>