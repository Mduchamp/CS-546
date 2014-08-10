<?PHP
    date_default_timezone_set("UTC");
    function FileBrowserD($page)
    {
        chdir($page);
        $fold = opendir($page);
        $i = 0;
        while(($filename = readdir($fold)) !== False) {
            if(filetype($filename) === "dir") {
                $directories[$i++] = $filename;
            }
            else {}
        }
        if(!isset($directories[0]))
        {
            return False;
        }
        else
        {
            sort($directories, SORT_STRING);
            return $directories;
        }
    }
    
    function FileBrowserF($page)
    {
        chdir($page);
        $fold = opendir($page);
        $i = 0;
        while(($filename = readdir($fold)) !== False) {
            if(filetype($filename) === "dir") {}
            else {
                $files[$i++] = $filename;
            }
        }
        if(!isset($files[0]))
        {
            return False;
        }
        else
        {
            sort($files, SORT_STRING);
            return $files;
        }
    }
?>