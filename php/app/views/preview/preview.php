<?php
require ROOT.'/libs/core/Menu.php';
require ROOT.'/libs/core/db.php';
class PreviewPage {

    protected $currentOrders;
    protected $db;

    public function init() {
        $dbhost = 'mysql';
        $dbuser = 'root';
        $dbpass = 'mysecret';
        $dbname = 'test_db';

        $this->$db = new Db($dbhost, $dbuser, $dbpass, $dbname);
        
    }

    public function displayOrderList() {
        // make query 
        $this->$db->query( 'SELECT * FROM orders, customers WHERE  orders.customer_id = customers.customer_id' );

        // fetch
        $this->$currentOrders = $this->$db->fetchAll();
        echo "<ul class='orders-card'>";
        foreach($this->$currentOrders as $order) {
            echo "<li>" . $order['customer_name'] . " " . $order['amount'] . "$" . '</li>';
        }
        echo "</ul>";
    }

}

$obj = new PreviewPage;
$obj->init();
$obj->displayOrderList();