<?php
/**
 * Class: Navigation
 * This class is used to generate navigation menu items in an an array for the view.
 * 
 * It uses the logged in status and currently selected pageID to determine which items 
 * are included in the menu for that specific page.
 *
 * @author gerry.guinane
 * 
 */

class Navigation extends Model{
	//class properties
        private $pageID;   //currently selected page
        private $menuNav;  //array of menu items    
        private $user;
	
	//constructor
	function __construct($user,$pageID) {   
            parent::__construct($user->getLoggedInState());
            $this->user=$user;
            $this->pageID=$pageID;
            $this->setmenuNav();

	}  //end METHOD constructor
      
        //setter methods
        public function setmenuNav(){//set the menu items depending on the users selected page ID
            if($this->loggedin){  //if user is logged in   
                
                if ($this->user->getUserType()==='LECTURER'){
                    switch ($this->pageID) {
                    case "home":
                        //$this->menuNav[0]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=home"><i class="fa fa-fw fa-home"></i> Home</a>';
                        //$this->menuNav[1]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=messages">My Messages</a>';
                        $this->menuNav[1]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=customerAdmin"><i class="fa fa-users"></i> Customer Administration</a>';
                        $this->menuNav[2]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=viewOrders"><i class="fa fa-truck"></i> View Orders</a>';
                        $this->menuNav[3]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=manageProducts"><i class="fa fa-archive"></i> Manage Products</a>';  
                        $this->menuNav[4]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=account"><i class="fa fa-fw fa-user"></i> My Account</a>';
                        $this->menuNav[5]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=logout"><i class="fa fa-external-link"></i> Log Out</a>';
                        break;
                    case "customerAdmin":
                        $this->menuNav[0]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=home"><i class="fa fa-fw fa-home"></i> Home</a>';
                        //$this->menuNav[1]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=messages">My Messages</a>';
                        //$this->menuNav[1]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=customerAdmin"><i class="fa fa-users"></i> Customer Administration</a>';
                        $this->menuNav[2]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=viewOrders"><i class="fa fa-truck"></i> View Orders</a>';
                        $this->menuNav[3]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=manageProducts"><i class="fa fa-archive"></i> Manage Products</a>';  
                        $this->menuNav[4]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=account"><i class="fa fa-fw fa-user"></i> My Account</a>';
                        $this->menuNav[5]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=logout"><i class="fa fa-external-link"></i> Log Out</a>';
                        break;                    
                    case "viewOrders":
                        $this->menuNav[0]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=home"><i class="fa fa-fw fa-home"></i> Home</a>';
                        //$this->menuNav[1]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=messages">My Messages</a>';
                        $this->menuNav[1]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=customerAdmin"><i class="fa fa-users"></i> Customer Administration</a>';
                        //$this->menuNav[2]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=viewOrders"><i class="fa fa-truck"></i> View Orders</a>';
                        $this->menuNav[3]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=manageProducts"><i class="fa fa-archive"></i> Manage Products</a>';  
                        $this->menuNav[4]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=account"><i class="fa fa-fw fa-user"></i> My Account</a>';
                        $this->menuNav[5]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=logout"><i class="fa fa-external-link"></i> Log Out</a>';
                        break;                    
                    case "manageProducts":
                         $this->menuNav[0]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=home"><i class="fa fa-fw fa-home"></i> Home</a>';
                        //$this->menuNav[1]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=messages">My Messages</a>';
                        $this->menuNav[1]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=customerAdmin"><i class="fa fa-users"></i> Customer Administration</a>';
                        $this->menuNav[2]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=viewOrders"><i class="fa fa-truck"></i> View Orders</a>';
                        //$this->menuNav[3]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=manageProducts"><i class="fa fa-archive"></i> Manage Products</a>';  
                        $this->menuNav[4]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=account"><i class="fa fa-fw fa-user"></i> My Account</a>';
                        $this->menuNav[5]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=logout"><i class="fa fa-external-link"></i> Log Out</a>';
                        break;                    

                    case "account":
                        $this->menuNav[0]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=home"><i class="fa fa-fw fa-home"></i> Home</a>';
                        //$this->menuNav[1]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=messages">My Messages</a>';
                        $this->menuNav[1]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=customerAdmin"><i class="fa fa-users"></i> Customer Administration</a>';
                        $this->menuNav[2]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=viewOrders"><i class="fa fa-truck"></i> View Orders</a>';
                        $this->menuNav[3]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=manageProducts"><i class="fa fa-archive"></i> Manage Products</a>';  
                        //$this->menuNav[4]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=account"><i class="fa fa-fw fa-user"></i> My Account</a>';
                        $this->menuNav[5]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=logout"><i class="fa fa-external-link"></i> Log Out</a>';
                        break;
                   
                    case "logout":  //DUMMY CASE - this case is not actually needed!!
                        $this->menuNav[0]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=home"><i class="fa fa-fw fa-home"></i> Home</a>';
                        $this->menuNav[1]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=register">Register</a>';
                        $this->menuNav[2]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=login"><i class="fa fa-fw fa-user"></i> Login</a>';
                        break;
                    default:
                        $this->menuNav[0]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=home"><i class="fa fa-fw fa-home"></i> Home</a>';
                        //$this->menuNav[1]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=messages">My Messages</a>';
                        $this->menuNav[1]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=customerAdmin"><i class="fa fa-users"></i> Customer Administration</a>';
                        $this->menuNav[2]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=viewOrders"><i class="fa fa-truck"></i> View Orders</a>';
                        $this->menuNav[3]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=manageProducts"><i class="fa fa-archive"></i> Manage Products</a>';  
                        $this->menuNav[4]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=account"><i class="fa fa-fw fa-user"></i> My Account</a>';
                        $this->menuNav[5]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=logout"><i class="fa fa-external-link"></i> Log Out</a>';
                        break;
                
                }//end switch
                }
                else{  //STUDENT menu items
                    switch ($this->pageID) {
                    case "home":
                        //$this->menuNav[0]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=home"><i class="fa fa-fw fa-home"></i> Home</a>';
                        $this->menuNav[1]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=viewProducts"><i class="fa fa-shopping-basket"></i> View Products</a>';
                        $this->menuNav[4]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=wishlist"><i class="fa fa-ellipsis-v"></i> My Wishlist</a>';  
                        $this->menuNav[5]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=cart"><i class="fa fa-cart-plus"></i> My Cart</a>';
                        $this->menuNav[6]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=orders"><i class="fa fa-shopping-bag"></i> My Orders</a>';
                        $this->menuNav[7]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=account"><i class="fa fa-fw fa-user"></i> My Account</a>';
                        $this->menuNav[8]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=logout"><i class="fa fa-external-link"></i> Log Out</a>';
                        break;
                    case "viewProducts":
                        $this->menuNav[0]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=home"><i class="fa fa-fw fa-home"></i> Home</a>';
                        //$this->menuNav[1]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=viewProducts">View Products</a>';
                        $this->menuNav[4]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=wishlist"><i class="fa fa-ellipsis-v"></i> My Wishlist</a>';  
                        $this->menuNav[5]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=cart"><i class="fa fa-cart-plus"></i> My Cart</a>';
                        $this->menuNav[6]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=orders"><i class="fa fa-shopping-bag"></i> My Orders</a>';
                        $this->menuNav[7]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=account"><i class="fa fa-fw fa-user"></i> My Account</a>';
                        $this->menuNav[8]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=logout"><i class="fa fa-external-link"></i> Log Out</a>';
                        break;                                    
                    case "wishlist":
                        $this->menuNav[0]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=home"><i class="fa fa-fw fa-home"></i> Home</a>';
                        $this->menuNav[1]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=viewProducts"><i class="fa fa-shopping-basket"></i> View Products</a>';
                        //$this->menuNav[4]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=wishlist">My Wishlist</a>';  
                        $this->menuNav[5]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=cart"><i class="fa fa-cart-plus"></i> My Cart</a>';
                        $this->menuNav[6]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=orders"><i class="fa fa-shopping-bag"></i> My Orders</a>';
                        $this->menuNav[7]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=account"><i class="fa fa-fw fa-user"></i> My Account</a>';
                        $this->menuNav[8]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=logout"><i class="fa fa-external-link"></i> Log Out</a>';
                        break;
                    case "cart":
                        $this->menuNav[0]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=home"><i class="fa fa-fw fa-home"></i> Home</a>';
                        $this->menuNav[1]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=viewProducts"><i class="fa fa-shopping-basket"></i> View Products</a>';
                        $this->menuNav[4]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=wishlist"><i class="fa fa-ellipsis-v"></i> My Wishlist</a>';  
                        //$this->menuNav[5]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=cart">My Cart</a>';
                        $this->menuNav[6]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=orders"><i class="fa fa-shopping-bag"></i> My Orders</a>';
                        $this->menuNav[7]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=account"><i class="fa fa-fw fa-user"></i> My Account</a>';
                        $this->menuNav[8]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=logout"><i class="fa fa-external-link"></i> Log Out</a>';
                        break;
                    
                    case "orders":
                        $this->menuNav[0]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=home"><i class="fa fa-fw fa-home"></i> Home</a>';
                        $this->menuNav[1]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=viewProducts"><i class="fa fa-shopping-basket"></i> View Products</a>';
                        $this->menuNav[4]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=wishlist"><i class="fa fa-ellipsis-v"></i> My Wishlist</a>';  
                        $this->menuNav[5]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=cart"><i class="fa fa-cart-plus"></i> My Cart</a>';
                        //$this->menuNav[6]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=orders"><i class="fa fa-shopping-bag"></i> My Orders</a>';
                        $this->menuNav[7]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=account"><i class="fa fa-fw fa-user"></i> My Account</a>';
                        $this->menuNav[8]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=logout"><i class="fa fa-external-link"></i> Log Out</a>';
                        break;
                    
                    case "account":
                        $this->menuNav[0]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=home"><i class="fa fa-fw fa-home"></i> Home</a>';
                        $this->menuNav[1]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=viewProducts"><i class="fa fa-shopping-basket"></i> View Products</a>';
                        $this->menuNav[4]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=wishlist"><i class="fa fa-ellipsis-v"></i> My Wishlist</a>';  
                        $this->menuNav[5]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=cart"><i class="fa fa-cart-plus"></i> My Cart</a>';
                        $this->menuNav[6]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=orders"><i class="fa fa-shopping-bag"></i> My Orders</a>';
                        //$this->menuNav[7]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=account"><i class="fa fa-fw fa-user"></i> My Account</a>';
                        $this->menuNav[8]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=logout"><i class="fa fa-external-link"></i> Log Out</a>';
                        break;                    
                    case "logout":  //DUMMY CASE - this case is not actually needed!!
                        $this->menuNav[0]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=home"><i class="fa fa-fw fa-home"></i> Home</a>';
                        $this->menuNav[1]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=register">Register</a>';
                        $this->menuNav[2]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=login"><i class="fa fa-fw fa-user"></i> Login</a>';
                        break;
                    default:
                        //$this->menuNav[0]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=home">Home</a>';
                        $this->menuNav[1]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=viewProducts"><i class="fa fa-shopping-basket"></i> View Products</a>';
                        $this->menuNav[4]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=wishlist"><i class="fa fa-ellipsis-v"></i> My Wishlist</a>';  
                        $this->menuNav[5]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=cart"><i class="fa fa-cart-plus"></i> My Cart</a>';
                        $this->menuNav[6]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=account"><i class="fa fa-fw fa-user"></i> My Account</a>';
                        $this->menuNav[7]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=logout"><i class="fa fa-external-link"></i> Log Out</a>';
                        break;
                
                }//end switch
                }
                

            }
            else{ //user is NOT logged in
                
                  switch ($this->pageID) {
                    case "home":
                        //$this->menuNav[0]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=home"><i class="fa fa-fw fa-home"></i> Home</a>';
                        $this->menuNav[1]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=register"><i class="fa fa-fw fa-pencil"></i> Register</a>';
                        $this->menuNav[2]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=login"><i class="fa fa-fw fa-user"></i> Login</a>';
                        break;
                    case "register":
                        $this->menuNav[0]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=home"><i class="fa fa-fw fa-home"></i> Home</a>';
                        //$this->menuNav[1]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=register">Register</a>';
                        $this->menuNav[2]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=login"><i class="fa fa-fw fa-user"></i> Login</a>';
                        break;         
                    case "login":
                        $this->menuNav[0]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=home"> <i class="fa fa-fw fa-home"></i> Home</a>';
                        $this->menuNav[1]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=register"><i class="fa fa-fw fa-pencil"></i> Register</a>';
                        //$this->menuNav[2]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=login">Login</a>';
                        break;  
                    default:
                        $this->menuNav[0]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=home"><i class="fa fa-fw fa-home"></i> Home</a>';
                        $this->menuNav[1]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=register"><i class="fa fa-fw fa-pencil"></i> Register</a>';
                        $this->menuNav[2]='<a href="'.$_SERVER['PHP_SELF'].'?pageID=login"><i class="fa fa-fw fa-user"></i> Login</a>';
                        break;
            }
        }   
        } //end METHOD - set the menu items depending on the users selected page ID
        
        //getter methods
        public function getMenuNav(){return $this->menuNav;}    //end METHOD - get the navigation menu string   
  
}//end class
        