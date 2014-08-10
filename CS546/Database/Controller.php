<?PHP
    date_default_timezone_set("UTC");
    include './FileBrowserI.php';
    include './Indexer.php';
    function Controller($page, $db)
    {
        $files = FileBrowserF($page);
        if($files)
        {
            foreach($files as $e)
            {
                $a = strripos($e,".html");
                $b = strripos($e,".htm");
                if($a !== False || $b !== False)
                {
                    $sql = "INSERT INTO files (name,url) VALUES('".$e."','".$page."\\".$e."')";
                    $sql = str_replace("\\", "\\\\", $sql); 
                    $db->send_sql($sql);
                    $id_file = $db->insert_id();
                    Indexer($page . "\\" . $e, $db, $id_file);
                }
            }
        }
        $dirs = FileBrowserD($page);
        if($dirs)
        {
            $i = 2;
            while(isset($dirs[$i]))
            {
                chdir($page);
                Controller($page . "\\" . $dirs[$i++], $db);
            }
        }
    }
?>