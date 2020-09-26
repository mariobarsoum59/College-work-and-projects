<?php

/**
 * Class: Register
 *
 * @author gerry.guinane
 * 
 */
class ViewProducts extends Model
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
            $this->panelHead_1 = '<h3>Products</h3>';
            }
        else
            {
            $this->panelHead_1 = '<h3>Please login to view products</h3>';
            }
    }

//end METHOD - //set the panel 1 heading

    public function setPanelContent_1()
    {//set the panel 1 content                                  
        if ($this->loggedin)
            {

            $sql = 'SELECT * FROM products';

            $this->panelContent_1 = '';
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
                        $this->panelContent_1 .='background-color: #000;';
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

                        $this->panelContent_1.='<form method="post" action="index.php?pageID=viewProducts">';
                        
                        $this->panelContent_1 .='<img src="images/' . $row['ProductImage'] . '" alt="Product Image" style="width:40%">';
                        $this->panelContent_1 .='<h1>' . $row["ProductName"] . '</h1>';
                        $this->panelContent_1 .='<p class="price">$' . $row["Price"] . '</p>';
                        $this->panelContent_1 .='<p>' . $row["Description"] . '</p>';
                        $this->panelContent_1 .='<p>' . $row["UnitsInStock"] . '  Left in Stock!</p>';
                        //$this->panelContent_1 .=file_get_contents("forms/AddToCart.html");
                        $this->panelContent_1 .='<p><button type="submit" id="addtocart" name="btnaddtocart" value="'.$row["ProductID"].'">Add to Cart</button></p>';
                        $this->panelContent_1 .='<p><button type="submit" id="addtowhishlist" name="btnaddtowishlist" value="'.$row["ProductID"].'">Add to Wishlist</button></p>';

                        $this->panelContent_1.='</form>';
                        $this->panelContent_1 .='</div>';

                        //$this->panelContent_1 .='</div>';
                       
                        
                        }
                        
                    }
                }
                if (isset($_POST['btnaddtocart']))
                        {      
                    $Username=$this->user->getUserID();
                    $SQL='SELECT UserID FROM users WHERE username="'.$Username.'"';
                    
                    
                        
                        $rs = $this->db->query($SQL);
                        $row = $rs->fetch_assoc();
                      
                        
                        
                        
                        
                        $INSERT='INSERT INTO Cart (UserID, ProductID) VALUES ('.$row["UserID"].','.$_POST['btnaddtocart'].')';
                         $rs=$this->db->query($INSERT); 
        //check the insert query worked
                        if ($rs)
                        {
                            echo '<h4>Item added to Cart</h4>';
                         return TRUE;
                        }
                        else
                        {
                            echo '<h4>Item Not to Cart</h4>';
                        return FALSE;
                        }
                            
                        } 
                       
                        
                        
                        
                         else if (isset($_POST['btnaddtowishlist']))
                        {      
                    $Username=$this->user->getUserID();
                    $SQL='SELECT UserID FROM users WHERE username="'.$Username.'"';
                    
                    
                        
                        $rs = $this->db->query($SQL);
                        $row = $rs->fetch_assoc();
                      
                        
                        
                        
                        
                        $INSERT='INSERT INTO wishlist (UserID, ProductID) VALUES ('.$row["UserID"].','.$_POST['btnaddtowishlist'].')';
                         $rs=$this->db->query($INSERT); 
        //check the insert query worked
                        if ($rs)
                        {
                            echo '<h4>Item added to Wishlist</h4>';
                         return TRUE;
                        }
                        else
                        {
                            echo '<h4>Item Not to Cart</h4>';
                        return FALSE;
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
            $this->panelHead_2 = '<h3>Products</h3>';
            }
        else
            {
            $this->panelHead_2 = '<h3>Products</h3>';
            }
    }

//end METHOD - //set the panel 2 heading     

    public function setPanelContent_2()
    {//set the panel 2 content
    }

//end METHOD - //set the panel 2 content  
    //Panel 3
    public function setPanelHead_3()
    { //set the panel 3 heading
        if ($this->loggedin)
            {
            $this->panelHead_3 = '<h3>Products</h3>';
            }
        else
            {

            $this->panelHead_3 = '<h3>Products</h3>';
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
        