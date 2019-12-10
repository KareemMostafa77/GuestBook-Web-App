<?php
    
    session_start();
    session_destroy();
    session_start();
    // define variables and set Error Message
    $fnameErr = $lnameErr = $emailErr = $passwordErr =$lemailErr = $lpasswordErr = $loginErr = "";

    // to validate register form
    if(isset($_POST['register'])){
        
        if (empty($_POST["firstName"])) {
            $fnameErr = "First Name is required"; 
        } 
        if (!preg_match("/^[a-zA-Z ]*$/",$_POST["firstName"])) {
            $fnameErr = "Can't Contain Numbers"; 
        } 
        if (empty($_POST["lastName"])) {
            $lnameErr = "Last Name is required";
        }
        if (!preg_match("/^[a-zA-Z ]*$/",$_POST["lastName"])) {
            $lnameErr = "Can't Contain Numbers"; 
        } 
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        }
        if (empty($_POST["password"]) || strlen($_POST["password"]) < 8 ){
            $passwordErr = "Required And Must be at least 8 letters";
        }
        if ( $fnameErr == $lnameErr && $lnameErr == $emailErr && $emailErr == $passwordErr && $passwordErr == "" )
        {   
            $connect=mysqli_connect('localhost','root','','guest_book');

            $fname=$_POST['firstName'];
            $lname=$_POST['lastName'];
            $email=$_POST['email'];
            $password=$_POST['password'];
    
            $query="INSERT INTO `users`(`firstName`, `lastName`, `email`, `password`) 
            VALUES ('$fname','$lname','$email','$password')";

            // store the submited Data
            mysqli_query($connect,$query);

            // delete all data from browser
            session_destroy();

            $loginErr="Register Done Successfuly , Please Log In Now";
        }
             
    }
    // to validate register form
    if(isset($_POST['login'])){
        
        
        if (empty($_POST["lemail"])) {
            $lemailErr = "Email is required";
        }
        if (empty($_POST["lpassword"])){
            $lpasswordErr = "Password is required ";
        }
        if ( $lemailErr == $lpasswordErr && $lpasswordErr == "" )
        {   
            $lemail=$_POST["lemail"];
            $lpassword=$_POST["lpassword"];

            $connect=mysqli_connect('localhost','root','','guest_book');

            $query="SELECT `id`, `firstName`, `lastName` FROM `users` 
            WHERE `email`= '$lemail' AND `password`='$lpassword'";

            $lresult=mysqli_query($connect,$query);

            
            if($lresult->num_rows == 1 ){

                $row = $lresult->fetch_assoc();
                $_SESSION["lid"]=$row['id'];
                $_SESSION["lfName"]=$row['firstName'];
                $_SESSION["llName"]=$row['lastName'];

                $lemailErr = $lpasswordErr = $loginErr = "";

                // to redirect to another page if no problem
                header('location: /GuestBook/Home.php');
                
            }
            else {
                $loginErr="Email Or Password is wrong , Please Try Again";
            }

            
        }
             
    }



?>

<html>

    
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/all.min.css">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>
    
    <body>
    
        <header>
            
            <div class="layout overflow-hidden d-flex justify-content-center align-items-center">
                
                <!-- navbar of page contain login form -->
                
                <nav class="navbar navbar-expand-lg navbar-light border border-white fixed-top bg-transparent">
                    
                    
                    <div>
                      <a class="navbar-brand  text-white font-weight-bold border border-danger px-3" href="/chatapp">GuestBook</a>
                      <br>
                      <span class="d-md-none text-danger font-weight-bold mt-3"> <?php echo $loginErr; ?> </span>

                    </div>

                      <button class="navbar-toggler text-white font-weight-bold border border-danger px-3 py-1" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        Login
                      </button>
                    
                      

                      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <form class="ml-auto pt-3" action="" method="POST">
                            <ul class="navbar-nav">
                          
                              <div class=" mr-md-2 my-2 my-md-0">
                                <input class="form-control" name="lemail" type="text" placeholder="Email"> 
                                <span class=" ml-3 text-danger"> <?php echo $lemailErr; ?> </span>                               
                              </div>
                            
                              <div class="mr-md-2 my-2 my-md-0">
                                <input class="form-control " name="lpassword" type="password" placeholder="Password">
                                <span class=" ml-3 text-danger"> <?php echo $lpasswordErr; ?> </span>
                              </div>
                                
                              <div class="mr-md-2 my-2 my-md-0">
                                <input class="btn btn-danger" value="LogIn" type="submit" name="login">
                              </div>
                          
                            </ul>
                            <span class="d-md-block d-none ml-3 text-danger font-weight-bold mt-3"> <?php echo $loginErr; ?> </span>
                        </form>
                      </div>
                    
                </nav>
                
                <!-- Div contain registration form -->
                
                <div class="container mt-3 mt-md-5">
                    
                    <div class="row justify-content-around align-items-center">
                        
                        <div class="d-md-block d-none col-md-4  border border-white text-center p-3 home-header-info">
                            
                        <h1 class="text-danger mt-3"> GuestBook </h1>
                            <h3 class="text-white mt-3">  Words are free, and one kind word can change someone's entire day. So be the reason someone smiles today. </h3>
                        
                        </div>
                        
                        <div class="col-10 col-md-6 border border-white px-3">
                            
                            <h3 class="text-danger mt-3"> Create a new account </h3>
                            <h5 class="text-white mt-3"> It's quick and easy. </h5>
                            <form action="" method="post">
                                
                                <div class="row text-center">
                                    
                                    <div class="col-12 col-md-6 text-left">
                                        
                                        <input type="text" name="firstName" placeholder="First Name" class="form-control"> 
                                        <span class=" ml-3 text-danger"> <?php echo $fnameErr; ?> </span>
                                        <!-- To Show Error Message For Input -->
                                        <br>
                                    
                                    </div>
                                    
                                    <div class="col-12 col-md-6 text-left">
                                        
                                        <input type="text" name="lastName" placeholder="Last Name" class="form-control"> 
                                        <span class=" ml-3 text-danger"> <?php echo $lnameErr; ?> </span>
                                        <br>
                                    
                                    </div>
                                    
                                    <div class="col-12 text-left">
                                        
                                        <input type="email" name="email" placeholder="Email" class="form-control">
                                        <span class=" ml-3 text-danger"> <?php echo $emailErr; ?> </span>
                                        <br>
                                    
                                    </div>
                                    
                                    <div class="col-12 text-left">
                                        
                                        <input type="password" name="password" placeholder="Password" class="form-control">
                                        <span class=" ml-3 text-danger"> <?php echo $passwordErr; ?> </span>
                                        <br>
                                    
                                    </div>
                                    
                                
                                    
                                    <div class="col-12">
                                        
                                        <input type="submit" name="register" value="Register" class="btn btn-danger">
                                        <br>
                                    
                                    </div>
                                
                                </div>
                            
                            </form>
                            
                        
                        </div>
                    
                    </div>
                
                </div>
            
            
            </div>
        
        </header>
        
        
        
        
        
        <script src="js/jquery-3.4.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/mine.js"></script>
    </body>




</html>