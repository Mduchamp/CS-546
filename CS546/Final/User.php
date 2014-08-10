<!DOCTYPE html>
<html>
    <head>
        <title>OCTE</title>
    </head>
</html>
<?PHP
    include "./Information.php";
    if(isset($_SESSION["username"]))
    {
        echo "<H1>Welcome ".stripslashes(htmlentities($_SESSION["username"]))."!";
    }
    else
    {
        include "./Index.php";
        return;
    }
?>
<html>
    <body>
        <H2>Choose an action:</H2>
        <nav class="radio_buttons">
            <form action="Action.php" method="post">
                <input type="radio" id="action1" name="action" value="Own">
                    <label for="action1">See owned documents</label><BR/>
                <input type="radio" id="action2" name="action" value="Write">
                    <label for="action2">See writable documents</label><BR/>
                <input type="radio" id="action3" name="action" value="Read">
                    <label for="action3">See readable documents</label><BR/>
                <input type="radio" id="action4" name="action" value="Create">
                    <label for="action4">Create documents</label><BR/>
                <input type="radio" id="action5" name="action" value="Delete">
                    <label for="action5">Delete documents</label><BR/>
                <input type="radio" id="action6" name="action" value="Privilege">
                    <label for="action6">Edit document privilages</label><BR/>
                <input type="radio" id="action7" name="action" value="Logout">
                    <label for="action7">Log Out</label><BR/>
                <button type="submit">Go</button>
            </form>
        </nav>
    </body>
</html>
