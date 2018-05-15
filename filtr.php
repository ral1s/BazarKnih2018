

<form method="post" action="knihy-ucebnice.php">


    <h3>Lokalita:

        <select name="lokalita" id="sort-item">
            <option value="'*'">Všechny kraje</option>
            <option disabled>-----------------------</option>
            <option value="Hlavní město Praha">Hlavní město Praha</option>
            <option value="Středočeský kraj">Středočeský kraj</option>
            <option value="Jihočeský kraj">Jihočeský kraj</option>
            <option value="Plzeňský kraj">Plzeňský kraj</option>
            <option value="Karlovarský kraj">Karlovarský kraj</option>
            <option value="Ústecký kraj">Ústecký kraj</option>
            <option value="Liberecký kraj">Liberecký kraj</option>
            <option value="Královéhradecký kraj">Královéhradecký kraj</option>
            <option value="Pardubický kraj">Pardubický kraj</option>
            <option value="Kraj Vysočina">Kraj Vysočina</option>
            <option value="Jihomoravský kraj">Jihomoravský kraj</option>
            <option value="Olomoucký kraj">Olomoucký kraj</option>
            <option value="Zlínský kraj">Zlínský kraj</option>
            <option value="Moravskoslezský kraj">Moravskoslezský kraj</option>
        </select>&nbsp;&nbsp;

         Stav:

        <select name="stari">
            <option value="'*'">Vše</option>
            <option disabled>---------</option>
            <option value="Nová">Nová</option>
            <option value="Použitá" >Použitá</option>
            <option value="Zničená" >Zničená</option>
        </select>&nbsp;&nbsp;



        Řadit dle:&nbsp;&nbsp;

        Cena <input type="radio" name="typ_razeni" value="cena" required>
        Čas  <input type="radio" name="typ_razeni" value="id">
        &nbsp;&nbsp;
        <select name="razeni">
            <option value="ASC">Vzestupně</option>
            <option value="DESC" >Sestupně</option>

        </select>&nbsp;&nbsp;
        

        <input type="submit" name="filtr" value="Filtrovat">

    </h3>
</form>
