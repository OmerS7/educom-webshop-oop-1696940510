<?php
  require_once ("basicDoc.php");
  class HomeDoc extends basicDoc {
    protected function showHeader() {
        echo 'Mijn eerste website';
    }
    
    protected function showContent() {
      echo '<div class="homePageText">';
        echo '<div class="titelIntro">';
          echo  '<h1>Introductie</h1>';
      echo "</div>";
        echo '<div class="welcomeText">';
          echo '<p>Welkom op de eerste website van de softwaredeveloper &Ouml;mer.</p>'; 
          echo '<p>&nbsp;Op deze website vind je informatie over de developer.</p>';
          echo '<p>Hiernaast wordt er een introductie gemaakt in het bouwen van een webshop met functionaliteiten als registeren, inloggen, wachtwoord veranderen en dergelijke functies.</p>';
        echo "</div>";
        echo '<div class="homeAfbeelding">';
          echo '<img class="webshopPage" src="Images/webshop.png" alt="pagina webshop">';
          echo '<img class="contactPage"src="Images/contact.png" alt="pagina contact">';
          echo '<img class="cartPage"src="Images/shoppingcart.png" alt="pagina shoppingcart">';
        echo '</div';
      echo "</div>";
     

      //   echo '<div class="titelIntro">
      //   <h1>Introductie</h1>
      //   </div>';
      //   echo '<div class="welcomeText">
      //   <p>Welkom op de eerste website van de softwaredeveloper &Ouml;mer.<br></p> 
      //   <p>&nbsp;Op deze website vind je informatie over de developer.<br>Hiernaast wordt er een introductie gemaakt in het bouwen van een webshop met functionaliteiten als registeren, inloggen, wachtwoord veranderen en dergelijke functies</p>
      //   </div>';
    }
  }