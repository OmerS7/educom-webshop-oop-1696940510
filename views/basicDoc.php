<?php
require_once("HtmlDoc.php");
class Basicdoc extends HtmlDoc{
    protected $model;

    public function __construct($myData){
        $this->model = $myData;
    }
    
    protected function getArrayVar($array, $key, $default='')
    {
        return isset ($array[$key]) ? $array[$key] : $default;
    }

    protected function showHeader() { 
        echo "Basic";
    }

    private function showPageHeader(){
        echo '<header><h1>';
        $this->showHeader(); 
       echo '</h1></header>' . PHP_EOL;
    }

    private function showMenu(){
        echo '<div class="menu">   
        <ul class=>';  
        foreach($this->model->menu as $link => $menuItem) { 
            $this->showMenuItem($link, $menuItem); 
        }
        echo ' 
        </ul>   
    </div>' . PHP_EOL;
    }

    private function showMenuItem($page, $menuItem){
        echo '<li class="menuItem"><a href="index.php?page=' . $page . '">';
        $array = (array) $menuItem;
        var_dump($array);
        if(count($array)>1){
            echo"<img src=\"Images/$array[1]\">";
        }
        echo $array[0];
        echo '</a></li>';
    }

    protected function showContent(){
        echo 'Welkom op de bacic doc';
    }

    private function showPageContent(){
        echo '<section>';
        echo '<span class="error">'. $this->getArrayVar($this->model, 'genericErr'). '</span>';
        $this->showContent(); 
        echo '</section>'; 
    }

    private function showFooter(){
        echo ' <footer>
        <p>&copy;2023&nbsp;</p>
        <p>Omer Seker</p>
    </footer>';
    }

    protected function showHeadContent(){
        echo '<title>';
        $this->showHeader();
        echo '</title>';
        echo '    <link rel="stylesheet"  href="CSS/stylesheet.css">' . PHP_EOL;
    }

    protected function showBodyContent(){
        $this->showPageHeader();
        $this->showMenu();
        $this->showPageContent();
        $this->showFooter();
    }
}