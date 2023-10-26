<?php
require_once('basicDoc.php');
class productDetailDoc extends basicDoc{
    public $product="";

    function showContent() {
        $this->product = $this->model->getArrayVar($this->model, 'product', NULL);
    
        if ($this->product) {
            echo '<div class="shoesize">';
            echo "<h1>$product[productname]</h1>";
            echo "<p>Prijs: &euro;$product[price]</p>";
            echo "<img src='Images/$product[productimage]' alt='$product[productname]'>";
            echo "<p>$product[description]</p>";
            echo "</div>";
            echo '<form method="POST" action="index.php">          
                <input type="hidden" name="action" value="addToCart">
                <input type="hidden" name="productId" value="'.$product["productId"].'">
                <input type="hidden" name="page" value="webshop">
                <input type="submit" value="Toevoegen">
            </form>';
        } else {
            echo "Product niet gevonden.";
        }
    }

}