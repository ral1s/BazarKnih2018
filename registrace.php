<?php
require_once 'dbconfig.php';

if($user->is_loggedin()!="")
{

}

if(isset($_POST['btn-signup']))
{

  $umail = trim($_POST['txt_umail']);
  $upass = trim($_POST['txt_upass']);

  if($umail=="") {
    $error[] = "Prosím, vložte platnou mailovou adresu!";
  }
  else if(!filter_var($umail, FILTER_VALIDATE_EMAIL)) {
    $error[] = 'Prosím, vložte platnou mailovou adresu!';
  }
  else if($upass=="") {
    $error[] = "Prosím vložte heslo!";
  }
  else if(strlen($upass) < 6){
    $error[] = "Heslo musí být alespoň 6 znaků dlouhé!";
  }
  else
  {
    try
    {
      $stmt = $DB_con->prepare("SELECT user_email FROM users WHERE user_email=:umail");
      $stmt->execute(array(':umail'=>$umail));
      $row=$stmt->fetch(PDO::FETCH_ASSOC);


      if($row['user_email']==$umail) {
        $error[] = "Promiňte, ale tento e-mail je již obsazen!";
      }
      else
      {
        if($user->register($umail,$upass))
        {
          $user->redirect('registrace.php?joined');
        }
      }
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
    }
  }
}
?>

<!DOCTYPE html>

<html>
<head>
<title>Registrace|UK Pedf Praha</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="layout/styles/layout.css" type="text/css" />
</head>
<body id="top">
<div class="wrapper col1">
  <div id="topbar">
    <div id="quickcont">

    </div>
    <div id="search">
      <?php

      include "login.php";

      ?>
    </div>
    <br class="clear" />
  </div>
</div>
<div class="wrapper col2">
  <div id="header">
    <div id="logo">
      <h1><a href="index.php">Bazar knih a skript</a></h1>
      <p>pro UK Pedf Praha</p>
    </div>
    <div id="topnav">
      <ul>
        <li><a href="index.php">Nabídka</a>
          <ul>
            <li><a href="knihy-ucebnice.php">Knihy - učebnice</a></li>
            <li><a href="skripta.php">Skripta</a></li>
            <li class="last"><a href="ostatni-materialy-ke-studiu.php">Ostatní materiály ke studiu</a></li>
          </ul>
        </li>
        <li><a href="pridat_inzerat.php">Přidat inzerát</a></li>
        <li class="active"><a href="registrace.php">Registrace</a></li>
        <li><a href="dotazy.php">Dotazy</a></li>
        <li><a href="vase-inzeraty.php">Vaše inzeráty</a></li>
            </ul>
    </div>
    <br class="clear" />
  </div>
</div>
<div class="wrapper col3">
  <div id="breadcrumb">
    <ul>
      <li class="first">Nacházíte se</li>
      <li>&#187;</li>
      <li class="current"><a href="registrace.php">Registrace</a></li>
    </ul>
  </div>
</div>
<div class="wrapper col4">
  <div id="container">

    <div id="content">
      <form name="review" method="post" onsubmit="return checkform(this);">
      <h2>Registrovat se</h2>

      <?php
      if(isset($error))
      {
        foreach($error as $error)
        {
          ?>

           <div id="chyba"> Chyba:<br> <?php echo $error; ?>
          </div><br>
          <?php
        }
      }
      else if(isset($_GET['joined']))
      {
        ?>

         <div id="uspech" Byl jste úspěšně zaregistrován.<br>Nyní se můžete nahoře přihlásit a vložit svůj první inzerát.</div>
       <br>
        <?php
      }
      ?>

        <input type="text" name="txt_umail" placeholder="Vložte svůj Email" value="<?php if(isset($error)){echo $umail;}?>" />

        <br><br>

        <input type="password"  name="txt_upass" placeholder="Vložte heslo" />

        <div id="small">Heslo musí být alespoň 6 znaků dlouhé...</div><br>


      <font color="#DD0000">Opište bezpečnostní kód ></font> <span id="txtCaptchaDiv" style="background-color:#A51D22;color:#FFF;padding:5px"></span>
      <input type="hidden" id="txtCaptcha" /><br>

      <input type="text" name="txtInput" id="txtInput" size="22" />



    <script src="js/captcha.js"></script>



    <hr />

        <button type="submit"  name="btn-signup">&nbsp;Zaregistrovat se
        </button>


      </form>



    </div>

    <div id="column">

    </div>
    <br class="clear" />
  </div>
</div>
<div class="wrapper col5">
  <div id="footer">
    <h2>Odkazy</h2>
    <div class="footbox">
      <h2>Pedagogická fakulta Univerzita Karlova</h2>
      <p><a href="http://www.pedf.cuni.cz/"><img src="images/odkazy/uk.png" alt="pedf"></a></p>


    </div>
    <div class="footbox">
      <h2>Webové aplikaec Univerity Karlovy</h2>
      <p> <a href="https://is.cuni.cz/webapps/"><img src="images/odkazy/app.png" alt="webapps"></a></p>

    </div>
    <div class="footbox last">
      <h2>Studijní informační systém UK PedF</h2>
      <p> <a href="https://is.cuni.cz/studium/"><img src="images/odkazy/sis.png" alt="sis"></a></p>


    </div>
    <br class="clear" />
  </div>
</div>
<div class="wrapper col6">
  <div id="copyright">
    <p class="fl_left">Copyright &copy; 2016 - Bazar knih a skript
    <p>Pro školní projekt</p>
    <br class="clear" />
  </div>
</div>
</body>
</html>