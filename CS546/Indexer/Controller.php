<?PHP
    date_default_timezone_set("UTC");
    include 'FileBrowserI.php';
    include 'Indexer.php';
    function Controller($page)
    {
        $files = FileBrowserF($page);
        if($files)
        {
            foreach($files as $e)
            {
                $a = strripos($e,".html");
                $b = strripos($e,".htm");
                if($a !== False || $b !== False)
                    Indexer($page . "\\" . $e);
            }
        }
        $dirs = FileBrowserD($page);
        if($dirs)
        {
            $i = 2;
            while(isset($dirs[$i]))
            {
                chdir($page);
                Controller($page . "\\" . $dirs[$i++]);
            }
        }
    }
?>