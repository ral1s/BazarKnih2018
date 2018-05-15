<?php

// připojení do tabulky inzerce


class databaze
{

    public $spojeni;
    public $promenna;


    public function __construct()
    {
        $servername = "localhost";
        $username = "holanmic";
        $password = "";
        $dbname = "holanmic";

        $this->spojeni = mysqli_connect($servername, $username, $password, $dbname);
        //echo "Spojeno";


    }

    public function vlozit()
    {
        //definovani promennych z formulare a ochrana proti SQL injection

        $data = mysqli_real_escape_string($this->spojeni, $_POST["data"]);
        $nazev = mysqli_real_escape_string($this->spojeni, $_POST["nazev"]);
        $isbn_cislo = mysqli_real_escape_string($this->spojeni, $_POST["isbn_cislo"]);
        $rok_vydani = mysqli_real_escape_string($this->spojeni, $_POST["rok_vydani"]);
        $stari = mysqli_real_escape_string($this->spojeni, $_POST["stari"]);
        $lokalita = mysqli_real_escape_string($this->spojeni, $_POST["lokalita"]);
        $text_inzeratu = mysqli_real_escape_string($this->spojeni, $_POST["text_inzeratu"]);
        $doruceni = mysqli_real_escape_string($this->spojeni, $_POST["doruceni"]);
        $cena = mysqli_real_escape_string($this->spojeni, $_POST["cena"]);
        $kontakt = mysqli_real_escape_string($this->spojeni, $_POST["kontakt"]);
        $email = mysqli_real_escape_string($this->spojeni, $_POST["email"]);
        $cas = mysqli_real_escape_string($this->spojeni, $_POST["cas"]);


        $sql = "INSERT INTO inzerce(id,data,nazev,isbn_cislo,rok_vydani,stari,lokalita,text_inzeratu,doruceni,cena,kontakt,email,cas) 
                VALUES('','$data','$nazev','$isbn_cislo','$rok_vydani','$stari','$lokalita','$text_inzeratu','$doruceni','$cena','$kontakt','$email','$cas')";

        if (empty($_POST['nazev'] && $_POST["isbn_cislo"]))

            echo "Je potřeba vyplnit název knihy a isbn číslo !  <br><br> <input onclick=javascript:self.history.back(); type=button value='Vrátit se zpět k formuláři'>";


        elseif (empty($_POST['doruceni'] && $_POST["cena"])) 

        echo "Vyplňte prosím typ doručení a cenu! <br><br> <input onclick=javascript:self.history.back(); type=button value='Vrátit se zpět k formuláři'>";

        elseif (empty($_POST['kontakt']))
            echo "Vyplňte prosím vaše telefonní číslo! <br><br> <input onclick=javascript:self.history.back(); type=button value='Vrátit se zpět k formuláři'>";


        elseif(mysqli_query($this->spojeni,$sql))

            echo "Položka byla přidána do inzerce";

    }



    // select obecný , pro index.php - výpis na hlavní stránce
    public function select()
    {

        $knihy = array();

        $sql = "SELECT * FROM inzerce ORDER BY id DESC limit 10";
        $navrat = mysqli_query($this->spojeni, $sql);

        if ($navrat->num_rows > 0) {
            $i = 0;

            while ($row = $navrat->fetch_assoc()) {

                $knihy[$i] = new kniha($row["id"], $row["data"], $row["nazev"], $row["isbn_cislo"], $row["rok_vydani"], $row["stari"], $row["lokalita"], $row["text_inzeratu"], $row["doruceni"], $row["cena"], $row["kontakt"], $row["email"], $row["cas"]);
                $i++;
            }
        }
        return $knihy;
    }

    // výpis pro různé kategorie knih dle parametru $data
    public function select_knihy($data)
    {



        $knihy = array();

        $sql = "SELECT * FROM inzerce WHERE data = '$data' ORDER BY id DESC  ";
        $navrat = mysqli_query($this->spojeni, $sql);


        if ($navrat->num_rows > 0) {


            $i = 0;

            while ($row = $navrat->fetch_assoc()) {

                $knihy[$i] = new kniha($row["id"], $row["data"], $row["nazev"], $row["isbn_cislo"], $row["rok_vydani"], $row["stari"], $row["lokalita"], $row["text_inzeratu"], $row["doruceni"], $row["cena"], $row["kontakt"], $row["email"], $row["cas"]);
                $i++;
            }
        }
        return $knihy;
    }

    // filtr
    public function select_knihy_filtr($data,$lokalita,$stari,$typ_razeni,$razeni)
    {


        $knihy = array();




        $sql = "SELECT * FROM inzerce WHERE data = '$data' AND lokalita = '$lokalita' AND stari = '$stari' ORDER BY $typ_razeni $razeni";
        $navrat = mysqli_query($this->spojeni, $sql);


        if ($navrat->num_rows > 0) {


            $i = 0;

            while ($row = $navrat->fetch_assoc()) {

                $knihy[$i] = new kniha($row["id"], $row["data"], $row["nazev"], $row["isbn_cislo"], $row["rok_vydani"], $row["stari"], $row["lokalita"], $row["text_inzeratu"], $row["doruceni"], $row["cena"], $row["kontakt"], $row["email"], $row["cas"]);
                $i++;
            }
        }
        return $knihy;
    }




    // výpis pro jednotlivé přihlášené uživatele v admin. sekci
    public function select_admin($email)
    {

        $knihy = array();

        $sql = "SELECT * FROM inzerce WHERE email = '$email' ORDER BY id DESC ";




        $navrat = mysqli_query($this->spojeni, $sql);

        if ($navrat->num_rows > 0) {


            $i = 0;

            while ($row = $navrat->fetch_assoc()) {

                $knihy[$i] = new kniha($row["id"], $row["data"], $row["nazev"], $row["isbn_cislo"], $row["rok_vydani"], $row["stari"], $row["lokalita"], $row["text_inzeratu"], $row["doruceni"], $row["cena"], $row["kontakt"],$row["email"], $row["cas"]);
                $i++;
            }
        }
        return $knihy;
    }







    public function close()
    {

        $this->spojeni->close();

    }


}