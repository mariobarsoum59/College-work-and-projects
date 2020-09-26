<?php
/**
 * Class: User
 * 
 * The user class represents the end user of the application. 
 * 
 * This class is responsible for providing the following functions:
 * 
     * User registration
     * User Login
     * User Logout
     * Persisting user session data by keeping the$_SESSION array up to date
 *
 * @author gerry.guinane
 */
class User extends Model {
    //put your code here
    
    //class properties
    private $session;
    private $db;
    private $userID;
    private $userFirstName;
    private $userLastName;
    private $userType;
    private $postArray;

    //constructor
    function __construct($session,$database) 
    {   
        parent::__construct($session->getLoggedinState());
        $this->db=$database;
        $this->session=$session;
        //get properties from the session object
        $this->userID=$session->getUserID();
        $this->userFirstName=$session->getUserFirstName();
        $this->userLastName=$session->getUserLastName();
        $this->userType=$session->getUserType();
        $this->postArray=array();
    }
    //end METHOD - Constructor

    public function login($userID, $password) {
        //This login function checks both the student and lecturer tables for valid login credentials

        //encrypt the password
        $password = hash('ripemd160', $password);
        
        //set up the SQL query strings
        $SQL1="SELECT FirstName,Surname FROM users WHERE username='$userID' AND password='$password' AND Type=1";
        $SQL2='SELECT FirstName,Surname FROM users WHERE username="'.$userID.'" AND password="'.$password.'" AND Type=0 AND Status="Active"';
        //execute the queries to get the 2 resultsets
        $rs1=$this->db->query($SQL1); //query the lecturer table
        $rs2=$this->db->query($SQL2); //query the student table

        //use the resultsets to determine if login is valid and which type of user has logged on. 
        if(($rs1->num_rows===1)OR($rs2->num_rows===1)){

            if(($rs1->num_rows===1)){//AND($rs2->num_rows===0)){ //lecturer has logged on
                $row=$rs1->fetch_assoc(); //get the users record from the query result             
                $this->session->setUserID($userID);
                $this->session->setUserFirstName($row['FirstName']);
                $this->session->setUserLastName($row['Surname']);
                $this->session->setUserType('LECTURER'); 
                $this->session->setLoggedinState(TRUE);

                $this->userID=$userID;
                $this->userFirstName=$row['FirstName'];
                $this->userLastName=$row['Surname'];
                $this->userType='LECTURER';


                $this->loggedin=TRUE;
                return TRUE;
            }
            else if (($rs2->num_rows===1)){//AND($rs1->num_rows===0)){ //student has logged on
                $row=$rs2->fetch_assoc(); //get the users record from the query result             
                $this->session->setUserID($userID);
                $this->session->setUserFirstName($row['FirstName']);
                $this->session->setUserLastName($row['Surname']);
                $this->session->setUserType('STUDENT'); 
                $this->session->setLoggedinState(TRUE);

                $this->userID=$userID;
                $this->userFirstName=$row['FirstName'];
                $this->userLastName=$row['Surname'];
                $this->userType='STUDENT';

                $this->loggedin=TRUE;
                return TRUE;
            }
            else {  //something has gone wrong - there should not be duplicate entries in the two tables - student and lecturer
                $this->session->setLoggedinState(FALSE);
                $this->loggedin=FALSE;
                return FALSE;
            }    
        }
        else{ //invalid login credentials entered 
            $this->session->setLoggedinState(FALSE);
            $this->loggedin=FALSE;
            return FALSE;
        }

        //close the resultsets
        $rs1->close();
        $rs2->close();
    }
    //end METHOD - User login

    public function logout(){
        //
        $this->session->logout();
    }
    //end METHOD - User login

    public function register($postArray){
        //get the values entered in the registration form
        $firstName=$this->db->real_escape_string($postArray['FirstName']);
        $lastName=$this->db->real_escape_string($postArray['LastName']);
        $username=$this->db->real_escape_string($postArray['username']);
        $email=$this->db->real_escape_string($postArray['email']);
        $password=$this->db->real_escape_string($postArray['pass1']);
        $ProfilePic=$this->db->real_escape_string($postArray['profilepic']);
        $address=$this->db->real_escape_string($postArray['address']);
        //encrypt the password
        $password = hash('ripemd160', $password);
        //construct the INSERT SQL
        //$sql="INSERT INTO users (fname, lname, username, email, password, ProfilePic, Status, Address, Admin) VALUES ('$firstName','$lastName','$username,'$email','$password','$ProfilePic','Active','$address',0)";
        
        $sql = " INSERT INTO users (FirstName, Surname, username, email, password, ProfilePic, Status, Address, Type) 
                VALUES ('" .$postArray['FirstName'] . "', '" . $postArray['LastName'] . "', '" . $postArray['username'] . "', '" . $postArray['email'] . "', '$password', '', 'Active' , '" . $postArray['address'] . "', '0')";
        
       

//$sql="INSERT INTO lecturer (LectID,FirstName,LastName,PassWord) VALUES ('".$postArray['lectID']."','".$postArray['lectFirstName']."','".$postArray['lectLastName']."','".$postArray['lectPass1']."')";
        //execute the insert query
        $rs=$this->db->query($sql); 
        //check the insert query worked
        if ($rs){return TRUE;}else{return FALSE;}
    }
    //end METHOD - Register User 

    //setters
    public function setLoginAttempts($num){$this->session->setLoginAttempts($num);}  
    
    //getters
    public function getLoggedInState(){return $this->session->getLoggedinState();}//end METHOD - getLoggedInState        
    public function getUserID(){return $this->userID;}
    public function getUserFirstName(){return $this->userFirstName;}
    public function getUserLastName(){return $this->userLastName;}
    public function getUserType(){return $this->userType;}
    public function getLoginAttempts(){return $this->session->getLoginAttempts();}    
}
