<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Boards</title>
        <base href="<?= $web_root ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link href="css/menu.css" rel="stylesheet" type="text/css"/>
        <link href="css/home.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php
            ob_start();
            include("menu.php");
            $buffer=ob_get_contents();
            ob_end_clean();

            // $buffer=str_replace("%TITLE%","Boards",$buffer);
            // $buffer=str_replace("%SUBTITLE%","",$buffer);
            $buffer=str_replace("%TITLE%","Board \"Projet PRWB\"",$buffer);
            $buffer=str_replace("%SUBTITLE%","Boards",$buffer);
            echo $buffer;
        ?>
        <div class="content">
            Welcome to the main menu!
        </div>
    </body>
</html>