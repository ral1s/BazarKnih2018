<!DOCTYPE html>

<html>
<head>
<title>Ostatní materiály|UK Pedf Praha</title>
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
            <li class="active2"><a href="ostatni-materialy-ke-studiu.php">Ostatní materiály ke studiu</a></li>
          </ul>
        </li>
        <li><a href="pridat_inzerat.php">Přidat inzerát</a></li>
        <li><a href="registrace.php">Registrace</a></li>
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
      <li class="current"><a href="ostatni-materialy-ke-studiu.php">Ostatní materiály ke studiu</a></li>
    </ul>
  </div>
</div>
<div class="wrapper col4">
  <div id="container">

    <div id="content">

      <h2>Seznam inzerce</h2>
      <div class="scrollbar" id="scrool">
        <div class="force-overflow"></div>
      <?php include 'filtr.php'?>

      <table>

        <thead>
        <tr>
          <th>Číslo inzerátu</th><th>Čas přidání</th><th>Stav</th><th>Název</th><th>Lokalita</th><th>Cena</th>

          <th>Info</th>

        </tr>
        </thead>
        <tbody>

        <?php       // vypsani zaznamu z db - vsechny inzerce

        //include_once ('dbconnect.php');
        require_once('databaze.php');
        require_once('kniha.php');

        if(isset($_POST['filtr'])) {


          $db = new databaze();
          $knihy = array();
          $knihy = $db->select_knihy_filtr('Ostatni',$_POST['lokalita'],$_POST['stari'],$_POST['typ_razeni'],$_POST['razeni']);
          $db->close();

          foreach ($knihy as $kniha) {
            $kniha->vypis_index();

          }


        }

        else {



          $db = new databaze();
          $knihy = array();
          $knihy = $db->select_knihy('Ostatni');
          $db->close();

          foreach ($knihy as $kniha) {
            $kniha->vypis_index();

          }
        }

        ?>
        </tbody>
      </table>
    </div></div>
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