<?php

/**
 * Class: Register
 *
 * @author gerry.guinane
 * 
 */
class Account extends Model
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
            $this->panelHead_1 = '<h3>My Account</h3>';
            }
        else
            {
            $this->panelHead_1 = '<h3>Please login to view Your Wishlist</h3>';
            }
    }

//end METHOD - //set the panel 1 heading

    public function setPanelContent_1()
    {//set the panel 1 content                                  
        if ($this->loggedin)
            {
            //userID   
            $Username = $this->user->getUserID();
            $SQL = 'SELECT * FROM users WHERE username="' . $Username . '"';

            $rs = $this->db->query($SQL);
            $row = $rs->fetch_assoc();





            $this->panelContent_1 = '';
            //$this->panelContent_1 = file_get_contents("forms/MyAccount.php");

            $this->panelContent_1 .='<form method="post" action="index.php?pageID=account">';
            $this->panelContent_1 .='<div class="col-sm-12 col-md-12 col-lg-12">';
            $this->panelContent_1 .='<div class="my-account margin-top">';
            $this->panelContent_1 .='<div class="row">';
            $this->panelContent_1 .='<div class="col-sm-6 col-md-6">';
            $this->panelContent_1 .='<div class="title-box">';
            $this->panelContent_1 .='<h3>Account Information</h3>';
            $this->panelContent_1 .='</div>';
            $this->panelContent_1 .='<ul class="list-unstyled">';
            $this->panelContent_1 .='<li>';
            $this->panelContent_1 .='<div class="form-group">';
            $this->panelContent_1 .='<label for="fname">First Name <span class="required">*</span></label>';
            $this->panelContent_1 .='<input type="text" name="fname" id="fname" class="form-control" value="' . $row["FirstName"] . '" placeholder="">';
            $this->panelContent_1 .='</div>';
            $this->panelContent_1 .='<div class="form-group">';
            $this->panelContent_1 .='<label for="lname">Last Name <span class="required">*</span></label>';
            $this->panelContent_1 .='<input type="text" name="lname" id="lname" class="form-control" value="' . $row["Surname"] . '"placeholder="">';
            $this->panelContent_1 .='</div>';
            $this->panelContent_1 .='</li>';
            $this->panelContent_1 .='<li>';
            $this->panelContent_1 .='<div class="form-group">';
            $this->panelContent_1 .='<label for="emailAddress">Email Address <span class="required">*</span></label>';
            $this->panelContent_1 .='<input type="email" name="email" id="emailAddress" class="form-control" value="' . $row["Email"] . '" placeholder="">';
            $this->panelContent_1 .='</div>';
            $this->panelContent_1 .='</li>';
            $this->panelContent_1 .='<li>';
            $this->panelContent_1 .='<div class="form-group">';
            $this->panelContent_1 .='<label for="Address">Address <span class="required">*</span></label>';
            $this->panelContent_1 .='<input type="text" name="Address" id="Address" class="form-control" value="' . $row["Address"] . '" placeholder="">';
            $this->panelContent_1 .='</div>';
            $this->panelContent_1 .='</li>';
            $this->panelContent_1 .='</ul>';
            $this->panelContent_1 .='</div>';
            $this->panelContent_1 .='<div class="col-sm-6 col-md-6">';
            $this->panelContent_1 .='<div class="title-box">';
            $this->panelContent_1 .='<h3>Change Password</h3>';
            $this->panelContent_1 .='</div>';
            $this->panelContent_1 .='<ul class="list-unstyled">';
            $this->panelContent_1 .='<li>';
            $this->panelContent_1 .='<div class="form-group">';
            $this->panelContent_1 .='<label for="cpassword">Current Password <span class="required">*</span></label>';
            $this->panelContent_1 .='<input type="password" name="cpassword" id="cpassword" class="form-control" required>';
            $this->panelContent_1 .='</div>';
            $this->panelContent_1 .='<div class="form-group">';
            $this->panelContent_1 .='<label for="npassword">New Password <span class="required">*</span></label>';
            $this->panelContent_1 .='<input type="password" name="npassword" id="npassword" class="form-control">';
            $this->panelContent_1 .='</div>';
            $this->panelContent_1 .='</li>';
            $this->panelContent_1 .='<li>';
            $this->panelContent_1 .='<div class="form-group">';
            $this->panelContent_1 .='<label for="cnewpassword">Confirm New Password <span class="required">*</span></label>';
            $this->panelContent_1 .='<input type="password" name="cnewpassword" id="cnewpassword" class="form-control">';
            $this->panelContent_1 .='</div>';
            $this->panelContent_1 .='</li>';
            $this->panelContent_1 .='</ul>';
            $this->panelContent_1 .='</div>';
            $this->panelContent_1 .='</div>';
            $this->panelContent_1 .='<div class="buttons-box clearfix">';
            $this->panelContent_1 .='<button class="btn btn-color" name="btnSave">Save</button>';
            $this->panelContent_1 .='<p></p><span class="required pull-right"><b>*</b> Required Field</span>';
            $this->panelContent_1 .='</div>';
            $this->panelContent_1 .='</div>';
            $this->panelContent_1 .='</div>';
            $this->panelContent_1 .='</form>';


            

            if (isset($_POST['btnSave']))
                {
            $password = hash('ripemd160', $_POST['cpassword']);
            $npassword = hash('ripemd160', $_POST['npassword']);
            $Confirmpassword = hash('ripemd160', $_POST['cnewpassword']);
                if ($npassword != $Confirmpassword)
                    {
                    $this->panelContent_1 .='<h3>The password you entered does not match the confirmation password</h3>';
                    }
                    else if (empty($_POST['npassword']||$_POST['npassword']=="9c1185a5c5e9fc54612808977ee8f548b2258d31"))
                        {
                        
                        $SQL2 = "UPDATE Users SET FirstName = '" . $_POST['fname'] . "',Surname='" . $_POST['lname'] . "', Email= '" . $_POST['email'] . "', Address= '" . $_POST['Address'] . "'   WHERE username ='" . $Username . "' AND Password='" . $password . "'";
                    //echo $SQL1;
                    //$rs = $this->db->query($SQL1);
header("Location: index.php?pageID=account");

                    if ((@$rs = $this->db->query($SQL2)))
                        {  //execute query and check resultset has been returned 
                        if (!$SQL2)
                            { //check if any rows returned from query
                            $this->panelContent_1 .= 'Failed to update your details<br>';
                            }
                        else
                            {
                            $this->panelContent_1 .= 'Details Successfully updated<br>';
                            }
                        }
                        }
                else
                    {
                    $SQL1 = "UPDATE Users SET FirstName = '" . $_POST['fname'] . "',Surname='" . $_POST['lname'] . "', Email= '" . $_POST['email'] . "', Address= '" . $_POST['Address'] . "', Password='" . $Confirmpassword . "'   WHERE username ='" . $Username . "' AND Password='" . $password . "'";
                    echo $SQL1;
                    //$rs = $this->db->query($SQL1);
header("Location: index.php?pageID=account");

                    if ((@$rs = $this->db->query($SQL1)))
                        {  //execute query and check resultset has been returned 
                        if (!$SQL1)
                            { //check if any rows returned from query
                            $this->panelContent_1 .= 'Failed to update your details<br>';
                            }
                        else
                            {
                            $this->panelContent_1 .= 'Details Successfully updated<br>';
                            }
                        }
                    }
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
        