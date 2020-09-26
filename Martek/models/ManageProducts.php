<?php

/**
 * Class: Register
 *
 * @author gerry.guinane
 * 
 */
class ManageProducts extends Model
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
            $this->panelHead_1 = '<h3>Manage Products</h3>';
            }
        else
            {
            $this->panelHead_1 = '<h3>Please login to Manage Products</h3>';
            }
    }

//end METHOD - //set the panel 1 heading

    public function setPanelContent_1()
    {//set the panel 1 content                                  
        if ($this->loggedin)
            {


            $SQL = "SELECT * FROM products";

            $rs = $this->db->query($SQL);
            $row = $rs->fetch_assoc();


            $this->panelContent_1 = '';
            if ((@$rs = $this->db->query($SQL)) && ($rs->num_rows))
                {  //execute query and check resultset has been returned 
                if (!$rs->num_rows)
                    { //check if any rows returned from query
                    $this->panelContent_1 .= 'No records have been returned - resultset is empty - Nr Rows = ' . $rs->num_rows . '<br>';
                    }
                else
                    {
                    $i = 0;

                    $this->panelContent_1.= '<table class="table table-bordered">';
                    $this->panelContent_1.='<tr><th>ProductID</th><th>Product Name</th><th>Description</th><th>CategoryID</th><th>Price</th><th>Units In Stock</th><th>Product Image</th><th>Upload Image</th><th>Save</th><th>Remove</th></tr>'; //table headings
                    $this->panelContent_1.='<tr>';
                    while ($row = $rs->fetch_assoc())
                        {  //fetch associative array
                        $this->panelContent_1.= '<form action="' . $_SERVER["PHP_SELF"] . '?pageID=manageProducts" method="post">';
                        $this->panelContent_1.= '<td>' . $row['ProductID'] . '</td><td><input type="text" id="ProductName" name="ProductName" value="' . $row['ProductName'] . '"></td>'
                                . '<td><input type="text" id="Description" name="Description" size="50" value="' . $row['Description'] . '"></td>'
                                . '<td><input type="text" id="categoryID" name="categoryID" size="4" value="' . $row['categoryID'] . '"></td>'
                                . '<td><input type="text" id="Price" name="Price" size="4" value="' . $row['Price'] . '"></td>'
                                . '<td><input type="text" id="UnitsInStock" size="4" name="UnitsInStock" value="' . $row['UnitsInStock'] . '"></td>'
                                . '<td><img src="images/' . $row['ProductImage'] . '" alt="Product Image" style="width:20%"></td>'
                                . '<td><input type="file" width="10%" id="myfile" name="myfile"></td>';

                        //Transcript button
                        $this->panelContent_1.= '<td>';
                        //$this->panelContent_1.= '<form action="'.$_SERVER["PHP_SELF"].'?pageID=manageProducts" method="post">';
                        $this->panelContent_1.= '<input type="submit" type="button" value="Update" name="btnUpdate">';
                        $this->panelContent_1.= '<input type="hidden" value="' . $row['ProductID'] . '" name="selectedID">';
                        $this->panelContent_1.= '</td>';
                        $this->panelContent_1.= '<td>';
                        $this->panelContent_1 .='<button type="submit" id="removefromshop" name="removefromshop" value="' . $row["ProductID"] . '">Remove</button>';
                        $this->panelContent_1.= '</td>';
                        $this->panelContent_1.= '</form>';
                        $this->panelContent_1.= '</td>';
                        $this->panelContent_1.= '</tr>';  //end table row
                        }
                    $this->panelContent_1.= '</table>';
                    }


                if (isset($_POST['btnUpdate']))
                    {



                    $Update = 'UPDATE products SET ProductName="' . $this->postArray['ProductName'] . '", Description="' . $this->postArray['Description'] . '", categoryID="' . $this->postArray['categoryID'] . '", Price="' . $this->postArray['Price'] . '", UnitsInStock =' . $this->postArray['UnitsInStock'] . ',ProductImage="' . $this->postArray['myfile'] . '" WHERE ProductID =' . $this->postArray['selectedID'];
                    //echo $Update;
                    $rs = $this->db->query($Update);
                    //check the insert query worked
                    if ($rs)
                        {
                        echo '<h4>Item Updated</h4>';
                        header("Location: index.php?pageID=manageProducts");
                        return TRUE;
                        }
                    else
                        {
                        echo '<h4>Operation Failed</h4>';
                        return FALSE;
                        }
                    }



                if (isset($_POST['removefromshop']))
                    {



                    $DELETE = 'DELETE FROM products WHERE ProductID=' . $_POST['removefromshop'] . '';
                    //echo $DELETE;
                    $rs = $this->db->query($DELETE);
                    //check the insert query worked
                    if ($rs)
                        {
                        echo '<h4>Item Removed From Shop</h4>';
                        header("Location: index.php?pageID=manageProducts");
                        return TRUE;
                        }
                    else
                        {
                        echo '<h4>Operation Failed</h4>';
                        return FALSE;
                        }
                    }
                }
            }
    }

//end METHOD - //set the panel 1 content        
    //Panel 2
    public function setPanelHead_2()
    { //set the panel 2 heading       
        if ($this->loggedin)
            {
            $this->panelHead_2 = '<h3>Check out</h3>';
            }
        else
            {
            $this->panelHead_2 = '<h3>Please log in to Checkout</h3>';
            }
    }

//end METHOD - //set the panel 2 heading     

    public function setPanelContent_2()
    {
        $this->panelContent_2 = "";
        if ($this->loggedin)
            {
            $Username = $this->user->getUserID();
            $SQL = 'SELECT UserID FROM users WHERE username="' . $Username . '"';
            $rs = $this->db->query($SQL);
            $row = $rs->fetch_assoc();

            $calculateTotal = 'SELECT SUM(price) as total from cart as c inner join products p where c.ProductID=p.ProductID AND c.UserID=' . $row['UserID'];
            $calculateCount = 'SELECT Count(price) as count from cart as c inner join products p where c.ProductID=p.ProductID AND c.UserID=' . $row['UserID'];
            $GetItems = 'SELECT * from cart as c inner join products p where c.ProductID=p.ProductID AND c.UserID=' . $row['UserID'];
            $rs = $this->db->query($calculateTotal);
            $row = $rs->fetch_assoc();

            $rs1 = $this->db->query($calculateCount);
            $row1 = $rs1->fetch_assoc();



            $this->panelContent_2.='';
            $this->panelContent_2.='<div class="col-25">';
            $this->panelContent_2.='<div class="container">';
            $this->panelContent_2.='<h4>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b>' . $row1['count'] . '</b></span></h4>';


            $rs2 = $this->db->query($GetItems);
            $row2 = $rs2->fetch_assoc();

            if ((@$rs2 = $this->db->query($GetItems)) && ($rs2->num_rows))
                {  //execute query and check resultset has been returned 
                if (!$rs2->num_rows)
                    { //check if any rows returned from query
                    $this->panelContent_2 .= 'No records have been returned - resultset is empty - Nr Rows = ' . $rs->num_rows . '<br>';
                    }
                else
                    {
                    $i = 0;

                    while ($row2 = $rs2->fetch_assoc())
                        {  //fetch associative array
                        $this->panelContent_2.='<form method="post" action="index.php?pageID=cart">';
                        $this->panelContent_2.='<p><a href="#">' . $row2['ProductName'] . '</a> <span class="price">$' . $row2['Price'] . '</span></p>';
                        }
                    $this->panelContent_2.='<hr>';
                    $this->panelContent_2.='<p>Total <span class="price" style="color:black"><b>$' . $row['total'] . '</b></span></p>';
                    $this->panelContent_2.='</div>';
                    $this->panelContent_2.='</div>';
                    }
                }
            //$this->panelContent_2.=file_get_contents('forms/CheckOut.html');
            $this->panelContent_2.='<input type="submit" value="Continue to checkout" name="btnCheckOut" class="btn btn-primary">';
            $this->panelContent_2.='<p style="color:red">Please note that this is for educational purposes and any items selected will not be shipped</p>';
            $this->panelContent_2.='</form>';

            if (isset($_POST['btnCheckOut']))
                {
                $Username = $this->user->getUserID();
                $SQL = 'SELECT UserID FROM users WHERE username="' . $Username . '"';
                $rs = $this->db->query($SQL);
                $row = $rs->fetch_assoc();


                $SQLcheckout = 'INSERT INTO orders (UserId,ProductID,Quantity) SELECT UserID,ProductID,1 FROM cart WHERE UserID=' . $row['UserID'];

                $checkout = $this->db->query($SQLcheckout);

                $sqlRemoveFromCart = 'DELETE FROM cart WHERE UserId=' . $row['UserID'];
                $UpdateCart = $this->db->query($sqlRemoveFromCart);
                header("Location: index.php?pageID=cart");
                }
            }
        else
            {
            $this->panelContent_2.='<h2>You must be logged in to checkout</h4>';
            }
    }

//end METHOD - //set the panel 2 content  
    //Panel 3
    public function setPanelHead_3()
    { //set the panel 3 heading
        if ($this->loggedin)
            {
            $this->panelHead_3 = '<h3>Add Product</h3>';
            }
        else
            {

            $this->panelHead_3 = '<h3>Please log in to AddProduct</h3>';
            }
    }

//end METHOD - //set the panel 3 heading

    public function setPanelContent_3()
    { //set the panel 2 content
        if ($this->loggedin)
            {
$this->panelContent_3 = '';
            $this->panelContent_3 .=file_get_contents('forms/AddProduct.html');

             if (isset($this->postArray['btnAdd']))
                {
                $sql = 'INSERT INTO products(ProductID, ProductName, Description, categoryID, Price, UnitsInStock, ProductImage)'
                        . ' VALUES ("", "' . $this->postArray['ProductName'] . '",'
                        . ' "' . $this->postArray['Description'] . '", '
                        . '"' . $this->postArray['CategoryID'] . '", '
                        . '"' . $this->postArray['Price'] . '", '
                        . '"' . $this->postArray['UnitsInStock'] . '", '
                        . '"' . $this->postArray['ProductImage'] . '")';

                if (@$rs = $this->db->query($sql))
                    {
                    echo "New record created successfully";
                    } else
                    {
                    echo "Error: " . $sql . "<br>" . mysqli_error($this->db);
                    }
                header("Location: index.php?pageID=manageProducts");
                    
                    
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
        