<?php
require_once('basicDoc.php');

abstract class productDoc extends basicDoc{
    public function showActionForm($page, $productId){
        echo '
        <div>
            <form method="POST" action="index.php">';
                if(!empty($id)) {
                echo  '<input type="hidden" name="productId" value="'.$product["productId"].'">';
                }
                echo  '<input type="hidden" name="page" value="' . $page . '">';
    }
    
}