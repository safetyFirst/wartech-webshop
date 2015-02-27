<?php

require_once 'helper.php';
require_once 'db.php';

class Cart
{

    private $warenkorb;

    function __construct(){
        self::cartFunctions();
    }

    public function cartFunctions()
    {
        if (isset($_POST["submitPutInCart"])) {
            $db = new DatabaseHandler();
            $result = $db->queryDB("INSERT INTO Warenkorb (`KundenID`, `ArtikelID`, `Menge`) "
                . "VALUES ('{$_SESSION['userid']}', '{$_POST['articleid']}', '{$_POST['amount']}');", null);
        }
        if (isset($_POST["submitRemoveArticle"])) {
            $this->removeArticleFromCart($_POST['remove']);
        }
    }

    public function removeArticleFromCart($id)
    {
        $db = new DatabaseHandler();
        $result = $db->queryDB("DELETE FROM Warenkorb WHERE KundenID={$_SESSION['userid']} AND ArtikelID=$id;", null);
    }

    public function showMiniCart()
    {
        $db = new DatabaseHandler();
        $result = $db->queryDB("SELECT * FROM Warenkorb WHERE KundenID={$_SESSION['userid']};", null);

        while ($row = $result->fetch_assoc()) {
            if (isset($this->warenkorb[$row["ArtikelID"]])) {
                $this->warenkorb[$row["ArtikelID"]] += $row["Menge"];
            } else {
                $this->warenkorb[$row["ArtikelID"]] = $row["Menge"];
            }

        }

        echo "<div id='minicart'><h2>Shopping Cart</h2>";
        if (count($this->warenkorb) > 0) {
            echo "<table>";
            foreach ($this->warenkorb as $id => $menge) {

                $result = $db->queryDB("SELECT Titel, NettoPreis, MwStSatz FROM Artikel WHERE ID=$id LIMIT 1;", null);
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . Helper::getShorterString($row["Titel"], 16) . "</td>";
                    echo "<td>" . $menge . " x</td>";
                    echo "<td><form action='.' method='post'><input type='hidden' name='remove' value='" . $id . "'>";
                    echo "<input type='submit' name='submitRemoveArticle' value='x' /></form>";
                    echo "</tr>";
                }
            }
            echo "</table>";
        } else {
            echo "<p id='minicart'>There are no articles in your shopping cart.</p>";
        }

        echo "</div>";
    }

    public function showMaxiCart()
    {
        $db = new DatabaseHandler();
        $result = $db->queryDB("SELECT * FROM Warenkorb WHERE KundenID={$_SESSION['userid']};", null);

        while ($row = $result->fetch_assoc()) {
            if (isset($this->warenkorb[$row["ArtikelID"]])) {
                $this->warenkorb[$row["ArtikelID"]] += $row["Menge"];
            } else {
                $this->warenkorb[$row["ArtikelID"]] = $row["Menge"];
            }

        }

        echo "<div id='maxicart'><h2 class='pageTitle'>Shopping Cart</h2>";
        if (count($this->warenkorb) > 0) {
            $oddEven = "odd";
            $superTotal = 0;
            echo "<table>";
            echo "<tr id='titelzeile'><th>Title</th><th>Price in CRs</th><th>Amount</th><th>Remove</th></tr>";
            foreach ($this->warenkorb as $id => $menge) {

                $result = $db->queryDB("SELECT Titel, NettoPreis, MwStSatz FROM Artikel WHERE ID=$id LIMIT 1;", null);
                while ($row = $result->fetch_assoc()) {
                    $brutto = Helper::getBrutto($row["NettoPreis"], $row["MwStSatz"]);
                    $price = number_format($brutto, 0, ',', '.');
                    echo "<tr class='$oddEven'>";
                    echo "<td>" . Helper::getShorterString($row["Titel"], 30) . "</td>";
                    if($menge > 1){
                        echo "<td>" . $price . "</td>";
                    }else{
                        echo "<td class='red'>" . $price . "</td>";
                    }
                    echo "<td>" . $menge . " x</td>";
                    echo "<td><form action='Warenkorb.php' method='post'><input type='hidden' name='remove' value='" . $id . "'>";
                    echo "<input type='submit' name='submitRemoveArticle' value='x' /></form></td>";
                    echo "</tr>";
                    if($menge > 1){
                        $total = $brutto * $menge;
                        $superTotal += $total;
                        $total = number_format($total, 0, ',', '.');

                        echo "<tr class='$oddEven' id='sum'><td>Total</td><td>" . $total . "</td><td></td><td></td></tr>";
                        if($oddEven == "odd"){
                            $oddEven = "even";
                        }else{
                            $oddEven = "odd";
                        }
                    }else {
                        $superTotal += $brutto;
                        if($oddEven == "odd"){
                            $oddEven = "even";
                        }else{
                            $oddEven = "odd";
                        }
                    }
                }
            }
            $superTotal = number_format($superTotal, 0, ',', '.');
            echo "<tr id='supertotal'><td>Super Total</td><td></td><td>" . $superTotal . "</td><td></td></tr>";
            echo "</table>";
        } else {
            echo "<p id='minicart'>There are no articles in your shopping cart.</p>";
        }

        echo "</div>";
    }

}

?>