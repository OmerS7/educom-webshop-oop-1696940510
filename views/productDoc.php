<?php
require_once('basicDoc.php');

abstract class productDoc extends basicDoc{
    protected function showActionForm($action, $page, $id = NULL, $buttonLogo = NULL, $text = "", $className = NULL, $amount = NULL, $buttonClass = NULL){
        echo '<form method="POST" action="index.php">';
        echo '<input type="hidden" name="action" value="'.$action.'">';

        if(!empty($id)){
             echo '<input type="hidden" name="id" value="'.$id.'">';
        }

        echo '<input type="hidden" name="page" value="' . $page . '">';

        if(!empty($buttonLogo)){
            echo '<div class="action-wrapper">';
            echo '<div class="' . $className . '-button-wrapper">';

                if ($className == "tick") {
                    echo '<input type="number" class="number-button" name="amount" min="1" value="' . $amount . '">';
                }

            echo '<input type="image" class="' . $className . '-button" src="Images/'. $buttonLogo.'" alt="'.$text.'">';
            echo '</div>';
            echo '</div>';        
        } else {
            echo '<input type="submit" class="' . $buttonClass . '" value="'.$text.'">';
        }
        echo '</form>';
    }

    protected function showRating($rating){
        echo 'Rating: ' . $rating . ' / 5';
    }

}




