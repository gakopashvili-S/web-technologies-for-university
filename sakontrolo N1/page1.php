<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page</title>
</head>
<body>
    <form action="page2.php" method="post">
        email - <input type="text" name="e-mail">
        <br><br>
        password - <input type="password" name="pass">
        <br><br>
        <button>SEND</button>
    </form>
    <hr><hr>
    <form>
        name of folder - <input type="text" name="saqaghalde">
        <br><br>
        <button>Create Folder</button>
    </form>
    <hr><hr>

    <?php
        if(isset($_GET['saqaghalde'])){
            $saqname = $_GET['saqaghalde'];
            mkdir($saqname);
        }
    ?>
</body>
</html>
