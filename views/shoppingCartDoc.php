<?php
require_once('productDoc.php');
class shoppingCartDoc extends productDoc{
    public $cartLines = [];

    function showHeader(){
        echo 'Winkelwagen';
    }

    function showContent(){
        var_dump($_SESSION);
        echo '<table>';
        if(empty($_SESSION['cart'])){
            echo '<img src="Images/winkelmandIcon.svg" class="iconWinkelmand">';
            echo "<div class='winkelmandtext'>";
            echo "<p>Je winkelmand is leeg.</p>";
            echo "<p>Wanneer je producten toevoegt, zie je</p>";
            echo "<p>ze hier verschijnen.</p>";
            echo "</div>";
            echo '<form method="POST" action="index.php"> 
                <input type="hidden" name="page" value="webshop">
                <button type="submit" class="shopButton">Shop nu</button>
                </form>';
            return;
        }

        foreach ($this->model->cartLines as $cartLine){
            echo '<tr>';
            echo '<td class="product" data-productid="' . $cartLine["productId"] . '">';
            echo '<img src="Images/' . $cartLine["image"] . '" alt="' . $cartLine["productName"] . '" class="product-photo">';
            echo '<div class="product-details">';
            echo '<span class="product-name">' . $cartLine["productName"] . '</span>';
            $this->showActionForm('updateCart', 'shoppingCart', $cartLine["productId"], "tick-svgrepo-com.svg", "", "tick", $cartLine["amount"]);
            // echo '<form method="POST" action="index.php">  
            //         <input type="hidden" name="action" value="updateCart">
            //         <input type="hidden" name="page" value="shoppingCart">
            //         <input type="hidden" name="productId" value="' . $cartLine["productId"] . '">
            //         <div class="tick-button-wrapper">
            //         <input type="number" class="number-button" name="amount" min="1" value="' . $cartLine["amount"] . '">
            //         <input type="image" class="tick-button" src="Images/tick-svgrepo-com.svg" alt="Add" width="20" height="20">
            //         </div>
            //     </form>';
            $this->showActionForm("deleteFromCart", "shoppingCart", $cartLine["productId"], "trash-bin-svgrepo-co.svg", "", "delete");
            // echo '<form method="POST" action="index.php">
            //     <input type="hidden" name="action" value="deleteFromCart">
            //     <input type="hidden" name="page" value="shoppingCart">
            //     <input type="hidden" name="productId" value="' . $cartLine["productId"] . '">
            //     <div class="delete-button-wrapper">
            //         <input type="image" class="delete-button" src="Images/trash-bin-svgrepo-co.svg" alt="Delete" width="20" height="20">
            //     </div>
            //    '</form>';     
            echo '</div>';
            echo '</td>';
            echo '<td>Subtotaal: &euro;' . $cartLine["subTotal"] . '</td>';
            echo '</tr>';
        }

        echo '<tr>';
        echo '<td>Totaal: &euro;' . $this->model->totalPrice . '</td>';
        echo '</tr>';

        echo '</table>';


        if(!empty($this->model->cartLines) ){
            $this->showActionForm('checkOutCart', 'shoppingCart', NULL, NULL, 'Order');
            // echo '<form method="POST" action="index.php">
            // <input type="hidden" name="action" value="checkOutCart">
            // <input type="hidden" name="page" value="shoppingCart">
            // <input type="submit" value="Order">
            //'</form>';
        }
    }
}
