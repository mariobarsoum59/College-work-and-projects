<?php

/**
 * Class: Register
 *
 * @author gerry.guinane
 * 
 */
class AdminViewOrders extends Model
{

    //class properties
    private $db;
    private $user;
    private $pageTitle;
    private $pageHeading;
    private $postArray;
    private $panelHead_1;
    private $panelContent_1;
    private $panelHead_2;
    private $panelContent_2;
    private $panelHead_3;
    private $panelContent_3;

    //($loggedin,$postArray,$pageTitle,$pageHead,$database)
    //constructor
    //Login($this->postArray,'MVC Example', strtoupper($this->getArray['pageID']),$this->db,$this->user);

    function __construct($postArray, $pageTitle, $pageHead, $database, $user)
    {
        parent::__construct($user->getLoggedinState());

        $this->db = $database;

        $this->user = $user;

        //set the PAGE title
        $this->setPageTitle($pageTitle);

        //set the PAGE heading
        $this->setPageHeading($pageHead);

        //get the postArray
        $this->postArray = $postArray;

        //set the FIRST panel content
        $this->setPanelHead_1();
        $this->setPanelContent_1();


        //set the DECOND panel content
        $this->setPanelHead_2();
        $this->setPanelContent_2();

        //set the THIRD panel content
        $this->setPanelHead_3();
        $this->setPanelContent_3();
    }

    //setter methods
    public function setPageTitle($pageTitle)
    { //set the page title    
        $this->pageTitle = $pageTitle;
    }

//end METHOD -   set the page title       

    public function setPageHeading($pageHead)
    { //set the page heading  
        $this->pageHeading = $pageHead;
    }

//end METHOD -   set the page heading
    //Panel 1
    public function setPanelHead_1()
    {//set the panel 1 heading
        if ($this->loggedin)
            {
            $this->panelHead_1 = '<h3>View Orders</h3>';
            }
        else
            {
            $this->panelHead_1 = '<h3>Please login as an admin to Be able to View orders</h3>';
            }
    }

//end METHOD - //set the panel 1 heading

    public function setPanelContent_1()
    {//set the panel 1 content                                  
        if ($this->loggedin)
            {
            $sql='SELECT * from products AS p inner join orders AS o inner join Users As u WHERE p.ProductID=o.ProductID AND o.UserID=u.UserID AND o.Shipped=0';
                      if ((@$rs = $this->db->query($sql)) && ($rs->num_rows))
                {  //execute query and check resultset has been returned 
                if (!$rs->num_rows)
                    { //check if any rows returned from query
                    $this->panelContent_1 .= 'No records have been returned - resultset is empty - Nr Rows = ' . $rs->num_rows . '<br>';
                    }
                else
                    {
                    $i = 0;

                    while ($row = $rs->fetch_assoc())
                        {  //fetch associative array
                        $this->panelContent_1 .='<style>';
                        $this->panelContent_1 .='.card {';
                        $this->panelContent_1 .='box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);';
                        $this->panelContent_1 .='max-width: 100%;';
                        $this->panelContent_1 .='margin: auto;';
                        $this->panelContent_1 .='text-align: center;';
                        $this->panelContent_1 .='font-family: arial;';

                        $this->panelContent_1 .='}';

                        $this->panelContent_1 .='.price {';
                        $this->panelContent_1 .='color: grey;';
                        $this->panelContent_1 .='font-size: 22px;';
                        $this->panelContent_1 .='}';

                        $this->panelContent_1 .='.card button {';
                        $this->panelContent_1 .='border: none;';
                        $this->panelContent_1 .='outline: 0;';
                        $this->panelContent_1 .='padding: 12px;';
                        $this->panelContent_1 .='color: white;';
                        $this->panelContent_1 .='background-color: #ff0000;';
                        $this->panelContent_1 .='text-align: center;';
                        $this->panelContent_1 .='cursor: pointer;';
                        $this->panelContent_1 .='width: 100%;';
                        $this->panelContent_1 .='font-size: 18px;';
                        $this->panelContent_1 .='}';

                        
                        
                        $this->panelContent_1 .='.card button:hover {';
                        $this->panelContent_1 .='opacity: 0.7;';
                        $this->panelContent_1.='}';
                        $this->panelContent_1.='</style>';


                        //$this->panelContent_1 .='<div class="col">';
                        $this->panelContent_1 .='<div class="card">';

                        $this->panelContent_1.='<form method="post" action="index.php?pageID=viewOrders">';

                        $this->panelContent_1 .='<img src="images/' . $row['ProductImage'] . '" alt="Product Image" style="width:10%">';
                        $this->panelContent_1 .='<h4>' . $row["ProductName"] . '</h4>';
                        $this->panelContent_1 .='<p class="price">$' . $row["Price"] . '</p>';
                        $this->panelContent_1 .='<p>' . $row["Description"] . '</p>';
                        $this->panelContent_1 .='<p>' . $row["UnitsInStock"] . '  Left in Stock!</p>';
                        $this->panelContent_1 .='<p><strong>Ordered On </strong>' . $row["OrderDate"] . '</p>';
                        $this->panelContent_1 .='<p><strong>Ship to ' . $row["Address"] . '</strong></p>';
                        //$this->panelContent_1 .=file_get_contents("forms/AddToCart.html");
                        $this->panelContent_1 .='<p><button type="submit" id="addtocart" name="removefromOrders" value="' . $row["OrderID"] . '">Cancel Order</button></p>';
                        $this->panelContent_1 .='<p><button type="submit" id="shipped" name="shipped" class="btn btn-success" value="' . $row["OrderID"] . '">Ship</button></p>';
                        $this->panelContent_1.='</form>';
                        $this->panelContent_1 .='</div>';

                        //$this->panelContent_1 .='</div>';
                        }
                    }
                }
            if (isset($_POST['removefromOrders']))
                {

                $DELETE = 'DELETE FROM orders WHERE OrderID=' . $_POST['removefromOrders'] . '';
                //echo $DELETE;
                $rs = $this->db->query($DELETE);
                //check the insert query worked
                if ($rs)
                    {
                    echo '<h4>Item Removed From orders</h4>';
                    header("Location: index.php?pageID=viewOrders");
                    return TRUE;
                    }
                else
                    {
                    echo '<h4>Operation Failed</h4>';
                    return FALSE;
                    }
                }
                            
                 if (isset($_POST['shipped']))
                {
                  
                     
                      $sql3='UPDATE products inner join orders SET products.UnitsInStock=products.UnitsInStock-1 WHERE products.ProductID=orders.ProductID AND orders.Shipped=0 AND orders.OrderID ="'.$_POST['shipped'].'"';
                    $rs2 = $this->db->query($sql3);
                    
                       
                     $sql2 = 'UPDATE orders SET Shipped = "1" WHERE OrderID ='.$_POST['shipped'].'';
                     $rs1 = $this->db->query($sql2);
                    //echo $sql3;
                    header("Location: index.php?pageID=viewOrders");
                //check the insert query worked
//                if ($rs1)
//                    {
//                    echo '<h4>Item marked as shipped</h4>';
//                    
//                    return TRUE;
//                    }
//                else
//                    {
//                    echo '<h4>Operation Failed</h4>';
//                    return FALSE;
//                    }
//                    
                   
                }
                
                    
                
            }
    }

//end METHOD - //set the panel 1 content        
    //Panel 2
    public function setPanelHead_2()
    { //set the panel 2 heading       
//        if ($this->loggedin)
//            {
//            $this->panelHead_2 = '<h3>Wishlist Cost</h3>';
//            }
//        else
//            {
//            $this->panelHead_2 = '<h3>Please log in to see your wishlist</h3>';
//            }
    }

//end METHOD - //set the panel 2 heading     

    public function setPanelContent_2()
    {
//        $this->panelContent_2="";
//         if ($this->loggedin)
//            {
//              $Username=$this->user->getUserID();
//                    $SQL='SELECT UserID FROM users WHERE username="'.$Username.'"';
//                        $rs = $this->db->query($SQL);
//              $row = $rs->fetch_assoc();
//             
//            $calculateTotal='SELECT SUM(price) as total from whishlist as w inner join products p where w.ProductID=p.ProductID AND w.UserID='.$row['UserID'];
//            $calculateCount='SELECT Count(price) as count from wishlist as w inner join products p where w.ProductID=p.ProductID AND w.UserID='.$row['UserID'];
//            $GetItems='SELECT * from wishlist as w inner join products p where w.ProductID=p.ProductID AND w.UserID='.$row['UserID'];  
//            $rs = $this->db->query($calculateTotal);
//              $row = $rs->fetch_assoc();
//              
//             $rs1 = $this->db->query($calculateCount);
//              $row1 = $rs1->fetch_assoc();
//              
//              
//              
//         
//            
//              
//              
//              $this->panelContent_2.='';
//             $this->panelContent_2.='<div class="col-25">';
//    $this->panelContent_2.='<div class="container">';
//      $this->panelContent_2.='<h4>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b>'.$row1['count'].'</b></span></h4>';
//       
//      
//      $rs2 = $this->db->query($GetItems);
//              $row2 = $rs2->fetch_assoc();
//              
//       if ((@$rs2 = $this->db->query($GetItems)) && ($rs2->num_rows))
//                {  //execute query and check resultset has been returned 
//                if (!$rs2->num_rows)
//                    { //check if any rows returned from query
//                    $this->panelContent_1 .= 'No records have been returned - resultset is empty - Nr Rows = ' . $rs->num_rows . '<br>';
//                    }
//                else
//                    {
//                    $i = 0;
//
//                    while ($row2 = $rs2->fetch_assoc())
//                        {  //fetch associative array
//      $this->panelContent_2.='<p><a href="#">'.$row2['ProductName'].'</a> <span class="price">$'.$row2['Price'].'</span></p>';
//                        }
//      $this->panelContent_2.='<hr>';
//      $this->panelContent_2.='<p>Total <span class="price" style="color:black"><b>$'.$row['total'].'</b></span></p>';
//    $this->panelContent_2.='</div>';
//  $this->panelContent_2.='</div>';
//              
//                        }
//                    }
//                
//                $this->panelContent_2.='<input type="submit" value="Continue to checkout" class="btn btn-primary">';
//              
//            }
//        else
//            {
//            $this->panelContent_2.='<h2>You must be logged in to checkout</h4>';
//            }
    }

//end METHOD - //set the panel 2 content  
    //Panel 3
    public function setPanelHead_3()
    { //set the panel 3 heading
        if ($this->loggedin)
            {
            $this->panelHead_3 = '<h3>Check Out</h3>';
            }
        else
            {

            $this->panelHead_3 = '<h3>Please log in to Checkout</h3>';
            }
    }

//end METHOD - //set the panel 3 heading

    public function setPanelContent_3()
    { //set the panel 2 content
        if ($this->loggedin)
            {

            $sql = 'SELECT * FROM products';

            $this->panelContent_3 = '';
            if ((@$rs = $this->db->query($sql)) && ($rs->num_rows))
                {  //execute query and check resultset has been returned 
                if (!$rs->num_rows)
                    { //check if any rows returned from query
                    $this->panelContent_3 .= 'No records have been returned - resultset is empty - Nr Rows = ' . $rs->num_rows . '<br>';
                    }
                else
                    {
                    $i = 0;
                    $this->panelContent_3 .= '<table class="table-striped" width=100%>';
                    while ($row = $rs->fetch_assoc())
                        {  //fetch associative array
                        while ($i < 1)
                            {  //trick to generate the HTML table headings
                            $this->panelContent_3 .= '<tr>';
                            foreach ($row as $key => $value)
                                {
                                $this->panelContent_3 .= "<th>$key</th>"; //echo the keys as table headings for the first row of the HTML table
                                }
                            $this->panelContent_3 .= '</tr>';
                            $i = 1;
                            }

                        $this->panelContent_3 .= '<tr>';
                        foreach ($row as $value)
                            {
                            $this->panelContent_3 .= "<td>$value</td>";
                            }
                        }
                    }
                }
            }
    }

//end METHOD - //set the panel 2 content        
    //getter methods
    public function getPageTitle()
    {
        return $this->pageTitle;
    }

    public function getPageHeading()
    {
        return $this->pageHeading;
    }

    public function getMenuNav()
    {
        return $this->menuNav;
    }

    public function getPanelHead_1()
    {
        return $this->panelHead_1;
    }

    public function getPanelContent_1()
    {
        return $this->panelContent_1;
    }

    public function getPanelHead_2()
    {
        return $this->panelHead_2;
    }

    public function getPanelContent_2()
    {
        return $this->panelContent_2;
    }

    public function getPanelHead_3()
    {
        return $this->panelHead_3;
    }

    public function getPanelContent_3()
    {
        return $this->panelContent_3;
    }

    public function getUser()
    {
        return $this->user;
    }

}

//end class
        