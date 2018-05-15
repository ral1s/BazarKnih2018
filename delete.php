
<!DOCTYPE>

<html>
<head>

    <link rel="stylesheet" href="layout/styles/error.css" type="text/css"/>
</head>

<body>
<?php


require_once 'dbconfig.php';
include_once 'class.user.php';


if ($user->is_loggedin() != "") {
    $user_id = $_SESSION['user_session'];
    $stmt = $DB_con->prepare("SELECT * FROM users WHERE user_id=:user_id");
    $stmt->execute(array(":user_id" => $user_id));
    $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
    $user_screen = $userRow['user_email'];


// smazani jednotliveho inzeratu dle id, které přijde z třídy kniha.php

    $servername = "localhost";
    $username = "holanmic";
    $password = "";
    $dbname = "holanmic";

    $spojeni = mysqli_connect($servername, $username, $password, $dbname);
    if (!$spojeni) {
        die("Chyba: " . mysqli_connect_error());
    }


    $id = $_POST["id"];


    $sql = "DELETE FROM inzerce WHERE id='$id'";

    $result = mysqli_query($spojeni, $sql);


    if ($result) {
        echo "Inzerce byla smazána";
        header("Location: vase-inzeraty.php");

    } else {
        echo "Chyba: " . mysqli_error($spojeni);

    }

} else {

    echo "<div id='error_pic_reg'><img width=\"20%\" src=\"images/er.png\"><br><h3>Přístup byl odepřen!</h3>";
    echo " Dochází k přesměrování na hlavní stránku ...</div><br>";

    echo "<div class='loader'></div>";
    header( "refresh:4;url=http://kraken.pedf.cuni.cz/~holanmic/semestralka/index.php" );

}


?>

</body>
</html>
