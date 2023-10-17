<?php
require_once('basicDoc.php');

abstract class productDoc extends basicDoc{
    protected function showActionForm($action, $page, $id = NULL, $buttonLogo = NULL, $text = "send"){
        echo '<form method="POST" action="index.php">          
            <input type="hidden" name="action" value="'.$action.'">';
        if(!empty($id)){
             echo   '<input type="hidden" name="id" value="'.$id.'">';
        }
        echo '<input type="hidden" name="page" value="' . $page . '">';
        if(!empty($buttonLogo)){
            echo'
                 <div class="action-button-wrapper">
                 <input type="image" class="action-button" src="Images/'. $buttonLogo.'" alt="'.$text.'" width="20" height="20">
             </div>';
        } else {
            echo'
                <input type="submit" value="'.$text.'">';
        }
        echo '</form>';
    }
}






// <div>
//             <form method="POST" action="index.php">';
//                 if(!empty($id)) {
//                 echo  '<input type="hidden" name="productId" value="'.$product["productId"].'">';
//                 }
//                 echo  '<input type="hidden" name="page" value="' . $page . '">';