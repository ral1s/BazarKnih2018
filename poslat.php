
<?php
$to = "holan.michal@seznam.cz";
$extra = "From: ".$_POST['email']."\r\nReply-To: ".$_POST['email']."\r\n";
$subject = "Vzkaz od ".$_POST['jmeno']."";
$mess = "Jméno: ".$_POST['jmeno']."\nEmail: ".$_POST['email']."\nText:\n".$_POST['text']."";
mail ($to, $subject, $mess, $extra);
?>
<html><head>
<meta http-equiv="refresh" content="2; url=index.php ">
<meta charset="UTF-8">
<title>Přesměrování...</title>

</head><body>


<h2>Zpráva se odeslala , dochází k přesměrování....</h2>

</body></html>