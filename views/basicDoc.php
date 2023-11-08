<?php
require_once("HtmlDoc.php");
class basicDoc extends HtmlDoc{
    protected $model;

    public function __construct($myData){
        $this->model = $myData;
    }
    
    // protected function getArrayVar($array, $key, $default='')
    // {
    //     return isset ($array[$key]) ? $array[$key] : $default;
    // }

    private function showJquery() {
        echo '<script
               src="https://code.jquery.com/jquery-3.7.1.min.js"
               integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
               crossorigin="anonymous">
               </script>';
             '<script src="main.js"></script>';
    }

    protected function showHeader() { 
        echo "Basic";
    }

    private function showPageHeader(){
        echo '<header><h1>';
        $this->showHeader();
        $this->showMenu(); 
       echo '</h1></header>' . PHP_EOL;
    }

    private function showMenu(){
        echo '<div class="menu">   
        <ul class=>';  
        foreach($this->model->menu as $menuItem) { 
            $this->showMenuItem($menuItem); 
        }
        echo ' 
        </ul>   
    </div>' . PHP_EOL;
    }

    private function showMenuItem($menuItem){
        echo '<li class="menuItem"><a href="index.php?page=' . $menuItem->name . '">';
        if(!empty($menuItem->icon)){
            echo"<img src=\"Images/$menuItem->icon\">";
        } else {
            echo $menuItem->label;
        }
        if(!empty($menuItem->userName)){
            echo  "&nbsp;". $menuItem->userName;
        }
        echo '</a></li>';
    }

    protected function showContent(){
        echo 'Welkom op de basic doc';
    }

    private function showPageContent(){
        echo '<section>';
        echo '<span class="error">'. /*$this->getArrayVar($this->model, 'genericErr').*/ '</span>';
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
        echo '    <script src="https://kit.fontawesome.com/b766139ca2.js" crossorigin="anonymous"></script>' . PHP_EOL;

    }

    protected function showBodyContent(){
        $this->showPageHeader();
       // $this->showMenu();
        $this->showPageContent();
        $this->showFooter();
    }
}