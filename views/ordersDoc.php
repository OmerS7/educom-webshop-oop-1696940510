<?php
require_once('webshopDoc.php');
class ordersDoc extends webshopDoc{
    
    protected function showHeader(){
        echo 'Jouw Orders';
    }

    function showContent(){
    echo '<table>';
            if (isset($this->succes) && $this->succes) {
                $orders = $this->model->orders;

                if (!empty($orders)) {
                foreach ($orders as $order) {
                    echo '<tr>';
                    echo '<div class="order">';
                    echo "<h2>Uw bestelling op:</h2>";
                    $formatted_date = date('d-m-Y', strtotime($order->orderDate));
                    echo "<p> $formatted_date</p>";
                    echo "<p>Met ordernummer:</p>";
                    echo "<p> $order->orderNumber</p>";
                    $number_format = number_format($order->total, 2, ',', '.');
                    echo "<h3>Totaal: &euro;$number_format</h3>";
                    echo "</div>";
                    $this->showActionForm('viewDetails', 'orderDetail', $order->id, NULL, 'Jouw bestelling');
                    echo '</tr>';
        echo '</table>';
                }   
            }
        }
    }
}

 // echo "<p> $order[orderDate]</p>";

   // echo '<form method="POST" action="index.php">
                //     <input type="hidden" name="action" value="viewDetails">
                //     <input type="hidden" name="id" value="'.$order['id'].'">
                //     <input type="hidden" name="page" value="orderDetail">
                //     <input type="submit" value="Jouw bestelling">
                //     </form>';