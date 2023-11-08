<?php
require_once('productDoc.php');
class productDetailDoc extends productDoc{
    protected function showHeader(){
        echo 'ProductDetail';
    }

    protected function showContent() {
        $product = $this->model->product ?? NULL;
        /*if (isset($this->model->product)) {
            $product = $this->model->product;
        } else {
            $product = NULL;
        }*/
        
        if ($product) {
            echo '<div class="shoesize">';
            echo "<h1>{$product['productname']}</h1>";
            echo "<p>Prijs: &euro;{$product['price']}</p>";
            echo "<img src='Images/{$product['productimage']}' alt='{$product['productname']}'>";
            echo "<p>{$product['description']}</p>";

            echo "<div class='rating'>";
            echo "<span class='star' data-rating='1'><i class='fa-solid fa-star'></i></span>";
            echo "<span class='star' data-rating='2'><i class='fa-solid fa-star'></i></span>";
            echo "<span class='star' data-rating='3'><i class='fa-solid fa-star'></i></span>";
            echo "<span class='star' data-rating='4'><i class='fa-solid fa-star'></i></span>";
            echo "<span class='star' data-rating='5'><i class='fa-solid fa-star'></i></span>";
            echo "</div>";
            
            echo "</div>";
            $this->showActionForm("addToCart","webshop",$product["productId"], NULL, "Toevoegen");
            // echo '<form method="POST" action="index.php">          
            //     <input type="hidden" name="action" value="addToCart">
            //     <input type="hidden" name="productId" value="'.$product["productId"].'">
            //     <input type="hidden" name="page" value="webshop">
            //     <input type="submit" value="Toevoegen">
            echo '</form>';
        } else {
            echo "Product niet gevonden.";
        }
    }

    // protected function showContent() {
    //     $product = $this->model->getArrayVar($array, 'product', NULL);
    
    //     if (!empty($this->product)) {
    //         echo '<div class="shoesize">';
    //         echo "<h1>$product[productname]</h1>";
    //         echo "<p>Prijs: &euro;$product[price]</p>";
    //         echo "<img src='Images/$product[productimage]' alt='$product[productname]'>";
    //         echo "<p>$product[description]</p>";
    //         echo "</div>";
    //         echo '<form method="POST" action="index.php">          
    //             <input type="hidden" name="action" value="addToCart">
    //             <input type="hidden" name="productId" value="'.$product["productId"].'">
    //             <input type="hidden" name="page" value="webshop">
    //             <input type="submit" value="Toevoegen">
    //         </form>';
    //     } else {
    //         echo "Product niet gevonden.";
    //     }
    // }

}