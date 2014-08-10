<?PHP
    date_default_timezone_set("UTC");
    include "./databaseClassMySQLi.php";
    function Meta($page, $file)
    {
        fopen($page, "r");
        $meta = get_meta_tags($page);
        foreach($meta as $k => $e)
        {
            $sql = "INSERT INTO meta_info (id_file, type, content) VALUES ('".$file."','".$k."','".$e."')";
            
            $db->send_sql($sql);
        }
    }
?>