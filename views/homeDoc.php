<?php
  require_once ("basicDoc.php");
  class HomeDoc extends basicDoc {
    protected function showHeader() {
        echo 'Mijn eerste website';
    }
    
    protected function showContent() {
        echo '<div class="welcomeText">
        <p>Welkom op de eerste website van de softwaredeveloper &Ouml;mer. &nbsp;Op deze website vind je informatie over Educom.</p>
        </div>';
    }
  }