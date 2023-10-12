<?php
require_once('basicDoc.php');
class aboutDoc extends basicDoc{
    protected function showHeader(){
        echo 'About';
    }

    protected function showContent(){
        echo '<div>
                <p> Ik ben &Ouml;mer, een 24 jarige pas afgestuurdeerde bedrijfskundigen uit Amsterdam. Ik ben altijd opzoek naar nieuwe kansen om te groeien.</p>
                <p>In mijn vrije tijd houd ik mijzelf graag bezig met de volgende activiteiten:</p>
                    <li>Gezellig drankje doen met vrienden</li>
                    <li>Naar de film gaan</li>
                    <li>Thuis op de bank Netflixen</li>
                    <li>Reizen</li>
                </p>
             </div>';
    }
}
