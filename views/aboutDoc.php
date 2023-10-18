<?php
require_once('basicDoc.php');
class aboutDoc extends basicDoc{
    protected function showHeader(){
        echo 'About';
    }

    protected function showContent(){
        echo '<div class="aboutContent">
                <div class="aboutText">
                    <p> Ik ben &Ouml;mer, een 24 jarige pas afgestuurdeerde bedrijfskundigen uit Amsterdam.<br>Ik ben altijd opzoek naar nieuwe kansen om te groeien.<br></br> In mijn vrije tijd houd ik mijzelf graag bezig met de volgende activiteiten:</p>
                </div>
                <ul>
                    <li>Gezellig drankje doen met vrienden</li>
                    <li>Naar de film gaan</li>
                    <li>Thuis op de bank Netflixen</li>
                    <li>Reizen</li>
                </ul>
             </div>';
    }
}
