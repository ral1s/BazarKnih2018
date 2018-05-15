<?php
require_once 'dbconfig.php';


if (isset($_POST['btn-login'])) {
    $umail = $_POST['txt_uname_email'];
    $upass = $_POST['txt_password'];

    if ($user->login($umail, $upass)) {
        $user->redirect('index.php');
    } else {
        $error = "Špatné přihlašovací údaje!";
    }
}
date_default_timezone_set("Europe/Prague");



// přihlašovací form / po přihlášení se přepne na odhlášení...
//jedná se o include do html šablony..

if($user->is_loggedin()!="")
{
    $user_id = $_SESSION['user_session'];
    $stmt = $DB_con->prepare("SELECT * FROM users WHERE user_id=:user_id");
    $stmt->execute(array(":user_id"=>$user_id));
    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
    $user_screen = $userRow['user_email'];


    echo "<div id='logout'>Jste přihlášen jako: $user_screen  <button onClick=\"javascript:window.location.href='logout.php'\" >Odhlásit se</button> </div>";
}
else
{
    echo "
     <form method = \"post\" >

          <input type = \"text\" name = \"txt_uname_email\" placeholder = \"Prosím, vložte váš e-mail\" required />
          <input type = \"password\" name = \"txt_password\"  placeholder = \"Heslo\" required />
          <input type = \"submit\" name = \"btn-login\" id = \"go\"  value = \"Prihlásit se\" />
      </form >
      ";
}

?>