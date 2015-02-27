<?php

require_once 'db.php';
require_once 'helper.php';

class ArtikelAnzeige
{

    public function showArticles()
    {
        $db = new DatabaseHandler();
        $result = $db->queryDB("SELECT COUNT(ID) AS amount FROM Artikel;", "amount");
        $amountPages = ceil($result[0] / 10);

        $range = 10;
        $start = 0;
        $end = $start + $range;

        if (isset($_GET["subpage"]) && is_numeric($_GET["subpage"]) && $_GET["subpage"] != 0) {
            //subpage = 1
            $start = $_GET["subpage"] * $range - $range;
            $end = $start + $range;
        }

        $result = $db->queryDB("SELECT ID, Titel, NettoPreis, MwStSatz, Beschreibung, Bild FROM Artikel LIMIT $start, $end;", null);
        echo "";
        echo "<table>";
        while ($row = $result->fetch_assoc()) {
            $bildArray = explode(",", $row["Bild"]);
            $price = trim($row["NettoPreis"]);
            $netto = number_format($price, 0, ',', '.');
            $brutto = Helper::getBrutto($price, $row["MwStSatz"]);
            $brutto = number_format($brutto, 0, ',', '.');
            echo "<tr>";
            echo "<td id='titel'>" . trim($row["Titel"]) . "</td>";
            echo "<td id='preis'>" . $brutto . " CRs</td>";
            echo "<td id='bild'><img src='Bilder/" . $bildArray[0] . "' /></td>";
            echo "<td><form action='index.php' method='post'><input type='number' value='1' name='amount' min='1' max='99' /> ";
            echo "<input type='hidden' name='article' value='" . $row["Titel"] . "' />";
            echo "<input type='hidden' name='netto' value='" . $netto . "' />";
            echo "<input type='hidden' name='mwst' value='" . $row["MwStSatz"] . "' />";
            echo "<input type='hidden' name='articleid' value='" . $row["ID"] . "' />";
            echo "<input type='submit' name='submitPutInCart' value='order' /></form></td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<p id='selectSubpage'>Pages -> ";
        for($i = 1; $i <= $amountPages; $i++){
            echo "<a href='?subpage=$i'>$i</a>\t";
        }
        echo "</p>";
    }

}

?>