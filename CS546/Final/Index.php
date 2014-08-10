<!DOCTYPE html>
<html>
    <head>
        <title>OCTE</title>
        <link rel="stylesheet" type="text/css" href="Style.css">
    </head>
    <body>
        <H1>Welcome to the Online Collaborative Text Editor (OCTE)</H1>
        <H2>Login</H2>
        <P>If you already have an account, log in below. Otherwise, register in the following section.</P>
        <form action="Login.php" method="post">
            <H3><tag>User Name:</tag></H3>
            <input type="text" name="username" size="16" maxlength="100"><BR/>
            <H3><important>Password:</important></H3>
            <input type="password" name="password" size="16" maxlength="100"><BR/>
            <button type="submit">Submit</button>
        </form>
        <BR/>
        <H2>Registration</H2>
        <P>If you do not have an account, create one below.</P>
        <form action="Signup.php" method="post">
            <H3><tag>User Name:</tag></H3>
            <input type="text" name="username1" size="16" maxlength="100"><BR/>
            <H3><important>Password:</important></H3>
            <input type="password" name="password1" size="16" maxlength="100"><BR/>
            <H3><important>Confirm Password:</important></H3>
            <input type="password" name="password2" size="16" maxlength="100"><BR/>
            <button type="submit">Submit</button>
        </form>
    </body>
</html>
