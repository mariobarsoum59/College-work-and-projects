<?php

/**
 * Class: Register
 *
 * @author gerry.guinane
 * 
 */
class CustomerAdmin extends Model
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
            $this->panelHead_1 = '<h3>Manage Users</h3>';
            }
        else
            {
            $this->panelHead_1 = '<h3>Please login as an admin to Be able to manage users</h3>';
            }
    }

//end METHOD - //set the panel 1 heading

    public function setPanelContent_1()
    {//set the panel 1 content                                  
        if ($this->loggedin)
            {
           $sql = 'SELECT UserID,FirstName,Surname,username,Email,Address,Status,Type FROM users Where Type!=1';

            $this->panelContent_1 = '';
            if ((@$rs = $this->db->query($sql)) && ($rs->num_rows))
                {  //execute query and check resultset has been returned 
                if (!$rs->num_rows)
                    { //check if any rows returned from query
                    $this->panelContent_1 .= 'No records have been returned - resultset is empty - Nr Rows = ' . $rs->num_rows . '<br>';
                    }
                else
                    {
                    
                           $this->panelContent_1.= '<table class="table table-bordered">';
                                $this->panelContent_1.='<tr><th>userID</th><th>First Name</th><th>Surname</th><th>Username</th><th>Email</th><th>Address</th><th>Status</th><th>Admin</th><th>Block</th><th>Activate</th><th>Reset Password</th></tr>';//table headings
                                while ($row = $rs->fetch_assoc()) { //fetch associative array from resultset
                                        $this->panelContent_1.='<tr>';//--start table row
                                           foreach($row as $key=>$value){
                                                    $this->panelContent_1.= "<td>$value</td>";
                                            }
                                            //Transcript button
                                            $this->panelContent_1.= '<td>';
                                            $this->panelContent_1.= '<form action="'.$_SERVER["PHP_SELF"].'?pageID=customerAdmin" method="post">';
                                            $this->panelContent_1.= '<input type="submit" type="button" value="Block" name="btnBlock">';
                                            $this->panelContent_1.= '<td><input type="submit" type="button" value="Activate" name="btnActivate"></td>';
                                            $this->panelContent_1.= '<td><input type="submit" type="button" value="Reset Password" name="btnResetPass"></td>';
                                            $this->panelContent_1.= '<input type="hidden" value="'.$row['UserID'].'" name="selectedID">';
                                                //when the button is pressed the 
                                                //studentID 'hidden' value is inserted 
                                                //into the $_POST array
                                            $this->panelContent_1.= '</form>';
                                            $this->panelContent_1.= '</td>';
                                            $this->panelContent_1.= '</tr>';  //end table row
                                        }
                                $this->panelContent_1.= '</table>';   
//$this->panelContent_1.='The Block/Activate button has been pressed -  selected ID='.$this->postArray['selectedID']; //comment out for diagnostic purposes
                        if(isset($_POST['btnBlock']))
                            {
                            $SQLB='UPDATE users SET Status = "Blocked" WHERE UserID ='.$this->postArray['selectedID'];
                            $this->db->query($SQLB);
                            header("Location: index.php?pageID=customerAdmin");
                            }
                            
                        if(isset($_POST['btnActivate']))
                            {
                            $SQLA='UPDATE users SET Status = "Active" WHERE UserID ='.$this->postArray['selectedID'];
                            $this->db->query($SQLA);
                            header("Location: index.php?pageID=customerAdmin");
                            }
                            
                        if(isset($_POST['btnResetPass']))
                            {
                            $password = hash('ripemd160', "123456789");
                            $SQLRP='UPDATE users SET Password = "'.$password.'" WHERE UserID ='.$this->postArray['selectedID'];
                            $this->db->query($SQLRP);
                            $this->panelContent_1.='<h3>The Password For the User with the userID '.$this->postArray['selectedID'].' Has been set to "123456789"</h3>';

                            //header("Location: index.php?pageID=customerAdmin");
                            
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
        