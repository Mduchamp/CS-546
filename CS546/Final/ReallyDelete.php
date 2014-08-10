<?PHP
    include "./Information.php";
    $db->send_sql("DELETE FROM permissions WHERE id_doc = ".$_SESSION["docid"]."");
    $db->send_sql("DELETE FROM documents WHERE id_doc = ".$_SESSION["docid"]."");
    echo "<tag>Deletion complete.<tag>";
    unset($_SESSION["docid"]);
    include "./User.php";
    return;
?>