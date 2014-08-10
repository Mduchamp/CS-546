<?PHP
    date_default_timezone_set("UTC");
    $folder = getcwd();
    if(isset($_GET["folder"]))
    {
        $folder = $_GET["folder"];
        unset($_GET["folder"]);
    }
    chdir($folder);
    $fold = opendir($folder);
    $i = 0;
    $k = 0;
    $root = False;
    while(($filename = readdir($fold)) !== False) {
        if(filetype($filename) === "dir") {
            $directories[$k++] = $filename;
        }
        else {
            $files[$i++] = $filename;
        }
    }
    echo "<H1>Path: $folder</H1>";
    echo "<H2>Directories:</H2>";
    if(isset($directories[1]))
    {
        sort($directories, SORT_STRING);
        echo "<UL>";
        foreach($directories as $e)
        {
            if($e == "."){}
            else if($e == "..")
            {
                $pos = strripos($folder,"\\");
                $parent = substr($folder, 0, $pos);
                echo "<LI><a href='FileBrowser.php?folder=".$parent."'>$e</a></LI>";
            }
            else
            {
                echo "<LI><a href='FileBrowser.php?folder=".$folder."\\".$e."'>$e</a></LI>";
            }
        }
        echo "</UL>";
    }
    else
    {
        echo "<P>No Directories.</P>";
    }
    echo "<H2>Files:</H2>";
    if(isset($files))
    {
        sort($files, SORT_STRING);
        echo "<UL>";
        foreach($files as $e)
            echo "<LI>$e</LI>";
        echo "</UL>";
    }
    else
    {
        echo "<P>No Files.</P>";
    }
?>