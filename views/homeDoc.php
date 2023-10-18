<?php
  require_once ("BasicDoc.php");
  class HomeDoc extends BasicDoc {
    protected function showHeader() {
        echo 'Mijn eerste website';
    }
    
    protected function showContent() {
        echo '<div class="welcomeText">
        <p>Welkom op de eerste website van de softwaredeveloper &Ouml;mer. &nbsp;Op deze website vind je informatie over Educom.</p>
        </div>';
    }
  }