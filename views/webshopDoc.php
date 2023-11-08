<?php

require_once('productDoc.php');
class webshopDoc extends productDoc{

    public $products ="";
    public $succes = true;

    protected function showHeader(){
        echo "Webshop";
    }

    protected function showContent() {
        //echo "De functie showContent wordt uitgevoerd.";

        //var_dump($this->model->products);
        if (isset($this->succes) && $this->succes) {
            $products = $this->model->products;

            if (!empty($products)) {
                $productIndex= 1;
                foreach ($products as $product) {
                   // echo '<div class="webproduct">';
                   echo "<div class='webproduct product-$productIndex'>";
                        echo "<a class='product-link' href='index.php?page=detail&id=$product->productId'>"; // Link naar de detailpagina
                        echo "<img src='Images/$product->productimage' alt='$product->productname'>";
                        echo "<h3 class='productName'>$product->productname</h3>";
                        $number_format = number_format($product->price, 2, ',', '.'); // 2,50 inplaats van 2.50 (twee cijfers achter de komma)
                        echo "<p class='productPrice'>&euro;$number_format</p>";
                        echo "</a>";
                   
                        echo "<div class='rating'>";
                                echo "<i class='fa-solid fa-star' data-index='1'></i>";
                                echo "<i class='fa-solid fa-star' data-index='2'></i>";
                                echo "<i class='fa-solid fa-star' data-index='3'></i>";
                                echo "<i class='fa-solid fa-star' data-index='4'></i>";
                                echo "<i class='fa-solid fa-star' data-index='5'></i>";
                        echo "</div>";
                   
                   $this->showActionForm("addToCart", "webshop", $product->productId, NULL, "Add to cart", "custom-wrapper", null, "customButton");
                   echo "</div>";
                    $productIndex++;
                }
            } else {
                echo "Er zijn geen producten beschikbaar.";
            }
        } else {
            echo "De variabele \$this->succes is niet ingesteld of is niet waar.";
        }
        }
    }