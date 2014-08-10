<?PHP
    date_default_timezone_set("UTC");
    include "./databaseClassMySQLi.php";
    include "./Information.php";
    $db = new database();
    $db->setup($user, $pass, $host, $database);
    if(!isset($_POST["text"]) && !isset($_POST["meta"]))
    {
        echo "No search type specified.";
        return;
    }
    if(isset($_POST["word"]))
    {
        echo "<H1>Results:</H1>";
        if(isset($_POST["text"]))
        {
            echo "<H2>Text:</H2>";
            $word = $_POST["word"];
            $sql = "SELECT id_word FROM words WHERE word = '".$word."'";
            $db->send_sql($sql);
            $word = $db->next_row();
            $counts = Array();
            if(isset($word["id_word"]))
            {
                $i = 0;
                $sql = "SELECT id_file, count FROM file_word WHERE id_word = ".$word["id_word"]."";
                $db->send_sql($sql);
                $row = $db->next_row();
                while(isset($row["id_file"]))
                {
                    $counts[$row["id_file"]] = $row["count"];
                    $row = $db->next_row();
                }
            arsort($counts);
            echo "<H3>Ranking. Name(URL) : Word Instances</H3>";
            echo "<OL>";
            foreach($counts as $k => $e)
            {
                $sql = "SELECT name, url FROM files WHERE id_file = '".$k."'";
                $db->send_sql($sql);
                $row = $db->next_row();
                echo "<LI>".$row["name"]."(<a href=\"".$row["url"]."\">".$row["url"]."</a> : ".$e."";
                //echo "<LI>".$row["name"]."(<a href=\"".$host."\\".$row["url"]."\">".$row["url"]."</a> : ".$e."";
                //^resolves localhost\ as localhost/current_working_directory's_parent/current_working_directory/localhost\ for unknowable reasons
            }
            echo "</OL><BR/>";
            }
            else
            {
                echo "No indexed texts contained that word.";
            }
        }
        if(isset($_POST["meta"]))
        {
            echo "<H2>Meta:</H2>";
            $word = $_POST["word"];
            $sql = "SELECT id_file, content FROM meta_info WHERE type = '".$word."'";
            $db->send_sql($sql);
            $row = $db->next_row();
            $content = Array();
            if(isset($row["id_file"]))
            {
                while(isset($row["id_file"]))
                {
                    $content[$row["id_file"]] = $row["content"];
                    $row = $db->next_row();
                }
                echo "<H3>Name(URL) : Contents of tag</H3>";
                echo "<UL>";
                foreach($content as $k => $e)
                {
                    $sql = "SELECT name, url FROM files WHERE id_file = '".$k."'";
                    $db->send_sql($sql);
                    $row = $db->next_row();
                    $string = getcwd();
                    echo "<LI>".$row["name"]."(<a href=\"".$row["url"]."\">".$row["url"]."</a>) : ".$e."";
                    //echo "<LI>".$row["name"]."(<a href=\"".$host."\\".$row["url"]."\">".$row["url"]."</a> : ".$e."";
                    //^resolves localhost\ as localhost/current_working_directory's_parent/current_working_directory/localhost\ for unknowable reasons
                }
                echo "</UL><BR/>";
            }
            else
            {
                echo "No indexed texts contained that meta-tag.";
            }
        }
    }
    else
    {
        echo "No word set.";
    }
?>