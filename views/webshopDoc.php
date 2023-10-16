<?php

require_once('productDoc.php');
class webshopDoc extends productDoc{
    protected function showHeader(){
        echo "Webshop";
    }

    protected function showContent() {
        if (isset($this->data['succes']) && $this->data['succes']) {
            $products = $this->data['products'];
            foreach ($products as $product) {
                echo '<div class="webproduct">';
                echo "<img src='Images/$product[productimage]' alt='$product[productname]'>";
                echo "<h3>$product[productname]</h3>";
                echo "<a href='index.php?page=detail&id=$product[productId]'>Productomschrijving"; // Link naar de detailpagina
                $number_format = number_format($product['price'], 2, ',', '.');
                echo "<p>Prijs: &euro;$number_format</p>";
                echo "</a>";
                echo "</div>";
                $this->showActionForm("addToCart", "webshop", $product['productId'], "cartPlus.svg");
            }
        }
    }
}

/*
 echo '<form method="POST" action="index.php">          
                <input type="hidden" name="action" value="addToCart">
                <input type="hidden" name="productId" value="'.$product["productId"].'">
                <input type="hidden" name="page" value="webshop">
                <button type="submit" class="addToCartButton"> <img src="Images/cartPlus.svg" class="addCart"></i></button>
            </form>';
*/