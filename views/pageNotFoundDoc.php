<?php
require_once('basicDoc.php');
class pageNotFoundDoc extends basicDoc{

    protected function showHeader(){
        echo 'PNF';
    }

    protected function showContent(){
        echo '<div class="pageNotFound">
                <p>Page Not Found</p>
             </div>';
    }
}