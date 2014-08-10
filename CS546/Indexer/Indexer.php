<?PHP
    date_default_timezone_set("UTC");
    function Indexer($page)
    {
        $nope = array(" a ", " to ", " the ", " and ", " is ", " in ", " if ", " with ", " this ", " on ", " by ", " an ", " also ", " it ", " its ", " for ", " has ", " of ", " do ", " or ", " as ", " at ", " are ", " but ", " so ", " have ", " from ", " that ", " i ", " i'm ");
        echo "<H1>Path: $page</H1>";
        fopen($page, "r");
        $meta = get_meta_tags($page);
        $string = file_get_contents($page);
        $string = strip_tags($string);
        $search = array("\n", "\t", "\"", "\',", "\'.", "\'?", "\'!", ",", ":", "!", "?", "(", ")", " \'", "\' ", ".", "|", "");
        $string = strtolower($string);
        $string = str_replace($search, " ", $string);
        $string = str_replace($nope, " ", $string);
        $arr = explode(" ", $string);
        $arr = array_count_values($arr);
        ksort($arr, SORT_STRING);
        echo "<H2>METATAG: INFORMATION</H2>";
        echo "<UL>";
        foreach($meta as $k => $e)
            echo "<LI>$k: $e</LI>";
        echo "</UL>";
        echo "<H2>WORD: OCCURRENCES</H2>";
        echo "<UL>";
        foreach($arr as $k => $e)
        {
            if($k === "" || ord($k) == 13){}
            else 
            {
                echo"<LI>$k: $e</LI>";
            }
        }
        echo "</UL>";
        echo "<BR/>";
    }
?>