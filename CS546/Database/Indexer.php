<?PHP
    date_default_timezone_set("UTC");
    include "./Meta.php";
    function Indexer($page, $db, $file)
    {
        $nope = array(" a ", " to ", " the ", " and ", " is ", " in ", " if ", " with ", " this ", " on ", " by ", " an ", " also ", " it ", " its ", " for ", " has ", " of ", " do ", " or ", " as ", " at ", " are ", " but ", " so ", " have ", " from ", " that ", " i ", " i'm ");
        fopen($page, "r");
        $string = file_get_contents($page);
        $string = strip_tags($string);
        $search = array("\n", "\t", "\"", "\',", "\'.", "\'?", "\'!", ",", ":", "!", "?", "(", ")", " \'", "\' ", ".", "|", "");
        $apostrophe = array("'");
        $string = strtolower($string);
        $string = str_replace($search, " ", $string);
        $string = str_replace($nope, " ", $string);
        $string = str_replace($apostrophe, "\'", $string);
        $arr = explode(" ", $string);
        $arr = array_count_values($arr);
        ksort($arr, SORT_STRING);
        foreach($arr as $k => $e)
        {
            if($k !== "" && ord($k) != 13)
            {
                $id_word = 0;
                $sql = "SELECT id_word FROM words WHERE word = '".$k."'";
                $db->send_sql($sql);
                $row = $db->next_row();
                if(isset($row["id_word"]))
                {
                    $id_word = $row["id_word"];
                }
                else
                {
                    $sql = "INSERT INTO words (word) VALUES ('".$k."')";
                    $db->send_sql($sql);
                    $id_word = $db->insert_id();
                }
                $sql = "INSERT INTO file_word (id_file, id_word, count) VALUES ('".$file."','".$id_word."','".$e."')";
                $db->send_sql($sql);
            }
        }
    }
?>