<?php

require ROOT.'/libs/core/Menu.php';
require ROOT.'/libs/core/db.php';

?>

<form action="insert" method="post">
    <p>
        <label for="firstName">First Name:</label>
        <input type="text" name="first_name" id="firstName">
    </p>
    <p>
        <label for="price">Price:</label>
        <input type="text" name="price" id="emailAddress">
    </p>
    <input type="submit" value="Submit">
</form>

<?php

class InsertPage {

    protected $currentOrders;
    protected $db;

    public function init() {
        $dbhost = 'mysql';
        $dbuser = 'root';
        $dbpass = 'mysecret';
        $dbname = 'test_db';

        $this->$db = new Db($dbhost, $dbuser, $dbpass, $dbname);
        
    }

    public function insertInDb() {
        
        $name  = $_REQUEST['first_name'];
        $price = $_REQUEST['price'];
        echo $price;
        echo $name;
        
        if(strlen($name) > 1 && strlen($price) > 1){
            
            $this->$db->query("insert into orders (customer_id, amount) values
            ((select customer_id from customers where customer_name = '" . $name . "'), " . $price . ");");
        }

    }

}

$obj = new InsertPage;
$obj->init();

$obj->insertInDb();

