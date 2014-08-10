<?PHP
    date_default_timezone_set("UTC");
    include 'Controller.php';
    if(isset($_POST["page"]))
    {
        $page = $_POST["page"];
        if(file_exists($page))
        {
            $a = strripos($page,".html");
            $b = strripos($page,".htm");
            if($a !== False || $b !== False)
            {
                Indexer($page);
            }
            else if(is_dir($page))
            {
                Controller($page);
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