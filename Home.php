<?php
   session_start();
   $userID = $_SESSION["lid"];
?>

<html>

    
    <head>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/home.css" rel="stylesheet">
    </head>
    
    <body>
    
        <header>
            
            <div class="layout overflow-hidden d-flex justify-content-center align-items-center text-center text-white">
                
                <div class="home-app border border-white overflow-auto">

                    <div class="row no-gutters m-0 h-100 position-relative">

                        <!-- Left Side Bar -->
                        <div class="overflow-auto col-12 col-md-3 d-flex justify-content-center  flex-wrap h-100 leftBar">

                            <div class="profile-header w-100 bg-danger border border-white p-3 col-12 h-25 d-flex align-items-center">
                                
                                <!-- Profile Name Or Picture -->
                                <div class="col-12" id="profile"> 
                                    <h3> <?php echo $_SESSION["lfName"]." ".$_SESSION["llName"]; ?> </h3>
                                    <!-- Account Hidden Info -->
                                    <input type="hidden" id="userID" value="<?php echo $userID ?>">
                                    <input type="hidden" id="userFname" value="<?php echo $_SESSION["lfName"] ;?>">
                                    <div class="col-12 justify-content-around">
                                        <button class="btn btn-light text-danger" onclick="displayMyBook(<?php echo $userID; ?>)"> <small>My Book</small>  </button>
                                        <button class="btn btn-light text-danger" onclick="LogOut()"> <small>LogOut</small>  </button>
                                    </div>
                                </div>
                             
                                
                            </div>

                            <!-- users Bar -->
                            <div class="w-100 h-75">
                                
                                <!-- users Menu -->
                                <div class="users-menu px-2 " id="users-menu"> 

                                    <!-- user Item -->
                                    

                                    
                                </div>

                            </div>

                            

                      

                        </div>

                        <!-- My Book -->
                        <div class="col-12 offset-md-3 col-md-9 myBook py-5 px-5 pb-md-0">
                            <span class="position-absolute border border-danger esc px-3 "> <h2> x </h2> </span>
                            
                            
                            <div class="row  justify-content-center mt-2" id="ueserMessages">

                                    

                                    
                                     
                                   
                                    
                            </div>
                        </div>

                        <!-- Another User Book -->
                        <div class="col-12 col-md-12 anotherUserBook p-5">
                            <span class="position-absolute border border-danger esc px-3"> <h2> x </h2> </span>
                            <span class="position-absolute border border-danger send px-3 "> <h2> Write Message </h2> </span>
                            <div class="row  justify-content-center mt-3" id ="anotherUserMessages">
                                
                            </div>
                        </div>


                    </div>
                    

                </div>
                
               
               
            
            </div>
        
        </header>
        
        
        
        
        
        <script src="js/jquery-3.4.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/home.js"></script>
    </body>




</html>