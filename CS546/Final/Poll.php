<?PHP
    include "./Information.php";
    if(isset($_SESSION["userid"]) && isset($_SESSION["docid"]) && isset($_SESSION["type"]))
    {
        $userid = $_SESSION["userid"];
        $docid = $_SESSION["docid"];
        $type = $_SESSION["type"];
        if($type === "write" || $type === "delete")
        {
            $db->send_sql("SELECT timestamp, id_user FROM writing WHERE id_doc = ".$docid."");
            $stuff = $db->next_row();
            if($stuff)
            {
                if($stuff["id_user"] == $userid)
                {
                    $db->send_sql("UPDATE writing SET timestamp=".time()." WHERE id_user= ".$userid." AND id_doc= ".$docid."");
                    echo "yep";
                }
                else
                {
                    if((time() - $stuff["timestamp"]) > 10)
                    {
                        $db->send_sql("UPDATE writing SET timestamp=".time().", id_user= ".$userid." WHERE id_doc= ".$docid."");
                        echo "yep";
                    }
                    else
                    {
                        echo "nope";
                    }
                }
            }
            else
            {
                $db->send_sql("INSERT INTO writing (id_doc, id_user, timestamp) VALUES(".$docid.", ".$userid.", ".time().")");
                echo "yep";
            }
        }
        else if($type === "read")
        {
            $db->send_sql("SELECT timestamp FROM writing WHERE id_doc = ".$docid."");
            $stuff = $db->next_row();
            if($stuff)
            {
                if((time() - $stuff["timestamp"]) > 10)
                {
                    echo "yep";
                }
                else
                {
                    echo "nope";
                }
            }
            else
            {
                echo "yep";
            }
        }
    }
?>