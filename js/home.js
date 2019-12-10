
// To Set Height Of Header Automatic With Device Window
$('header').height($(window).outerHeight(true));
//----------------------------------------------------------------
// Home Page

let users,temp,userMessages ;

let messagesTemp;





let userID = $('#userID').val();

// Call Function To Display Friends 
getUsers();

// function to display another user messages
function showMessages(x){
    
    $(".myBook").fadeOut(1000);
    $(".searchResult").fadeOut(1000);


    // To Write Message For This getUsers
    $(".send").click(function(){

        var message = prompt("Please enter your Message:", "");
        if (message == null || message == "") {
            alert("You Cant Enter Empty Message , Thanks And Try Again");
        } else {
            //send message to DB 
            $.ajax({
                type : "POST",  //type of method
                url  : "http://localhost/GuestBook/Api/sendMessage.php",  //your page
                data : { user: userID, receiver : x , messages : message },// passing the values
                success: function(res){  
                    alert('Thanks For Your Message');
                    showMessages(x);
                }
            });
            

            
        }
    });

    
        //send data from here and the get data from server
        $.ajax({
                type : "POST",  //type of method
                url  : "http://localhost/GuestBook/Api/userMessages.php",  //your page
                data : { id : x },// passing the values
                success: function(res){  
                           
                    userMessages=JSON.parse(res);
                    messagesTemp="";
    
                    for(let i=0;i<userMessages.length;i++)
                        {
                            if(userMessages[i].sender == userID)
                            {
                                var message_edit=userMessages[i].message;
                                messagesTemp+='<div class="col-12 col-md-12 text-left py-2 border border-danger my-2"> <h4 class="text-danger ">'+userMessages[i].firstName+' '+userMessages[i].lastName+'  </h4> <p> '+userMessages[i].message+'</p> <p class="text-primary"> Reply : '+userMessages[i].reply+'</p>  <button class="btn btn-danger btn-sm" onClick="edit('+"\'"+message_edit+"\'"+')"> Edit </button> <button class="btn btn-danger btn-sm" onClick="remove('+"\'"+message_edit+"\'"+')"> Delete </button> </div>';
                            }
                            else
                            {
                                messagesTemp+='<div class="col-12 col-md-12 text-left py-2 border border-danger my-2"> <h4 class="text-danger ">'+userMessages[i].firstName+' '+userMessages[i].lastName+'  </h4> <p> '+userMessages[i].message+'</p> <p class="text-primary"> Reply : '+userMessages[i].reply+'</p>  </div>';
 
                            }

                        }
                        document.getElementById("anotherUserMessages").innerHTML = messagesTemp; 
                        
                    }
                
            });
        // Show Friend Profile
        $(".anotherUserBook").show(1000);

          
    }

//Function To Edit Message
function edit(y){

    var message = prompt("Please enter your edit message :", y);
    if (message == null || message == "") {
        alert("You Cant Enter Empty Message , Thanks And Try Again");
    } else {
        
        //send message to DB 
        $.ajax({
            type : "POST",  //type of method
            url  : "http://localhost/GuestBook/Api/editMessage.php",  //your page
            data : { old : y , messages:message },// passing the values
            success: function(res){  
                alert("Update Done Just Refresh");
            }
        });
        
    }
        

} 

//Function To delete Message
function remove(y){

    if (confirm("Do You Want To Delete This Message ?")) {
        $.ajax({
                type : "POST",  //type of method
                url  : "http://localhost/GuestBook/Api/deleteMessage.php",  //your page
                data : { messages:y },// passing the values
                success: function(res){  
                    alert("Delete Successful Just Refresh");
                }
            });
    } 
            

} 


       
        

// function to display MyBook
function displayMyBook(x){

    
    $(".searchResult").fadeOut(1000);
    
        //send data from here and the get data from server
        $.ajax({
                type : "POST",  //type of method
                url  : "http://localhost/GuestBook/Api/userMessages.php",  //your page
                data : { id : x },// passing the values
                success: function(res){  
                           
                    userMessages=JSON.parse(res);
                    // Enter Values From DB To Friend Profile
                    messagesTemp="";
    
                    for(let i=0;i<userMessages.length;i++)
                        {
                            var message_reply=userMessages[i].message;
                            messagesTemp+='<div class="col-12 col-md-12 text-left py-2 border border-danger my-2"> <h4 class="text-danger ">'+userMessages[i].firstName+' '+userMessages[i].lastName+'  </h4> <p> '+userMessages[i].message+'</p> <p class="text-primary"> Reply : '+userMessages[i].reply+'</p> <button class="btn btn-danger btn-sm" onClick="reply('+"\'"+message_reply+"\'"+')"> Reply </button> </div>';
                        }
                     document.getElementById("ueserMessages").innerHTML = messagesTemp; 

                    
                    
                }
                    
            });
        // Show Friend Profile
        $(".myBook").fadeIn(1000);
}     
        

// To Close pages
$(".esc").click(function(){
    userMessages=[];
    $("#anotherUserMessages").empty();
    $(".anotherUserBook").hide(1000);
    $(".myBook").fadeOut(1000);
});

// To Logout
function LogOut(){
    location.assign("http://localhost/GuestBook");
}

// function to get users from DB
function getUsers(){

    $.ajax({
                type : "POST",  //type of method
                url  : "http://localhost/GuestBook/Api/displayUsers.php",  //your page
                data : { id : userID },// passing the values
                success: function(res){  
                  users=JSON.parse(res);
                  displayUsers();
                }
        });
    
    
}

//Function to show Display users On Bar
function displayUsers(){

    temp="";
    
    for(let i=0;i<users.length;i++)
        {
            temp+='<div class="d-flex justify-content-between align-items-center p-2 border border-white rounded my-2"> <div class="userPic"> <h3> '+ users[i].firstName+ '<span class="d-md-none">'+" "+users[i].lastName+'</span> </h3>   </div>  <div class="userOptions">   <button class="btn btn-danger" id="friendProfileBtn" onClick="showMessages('+users[i].id+')">  <small> Book </small> </button> </div> </div>';
        }
    document.getElementById("users-menu").innerHTML = temp; 

}

// Function To Replay Message
function reply(y){

    var message = prompt("Please enter or edit your Replay:", "");
        if (message == null || message == "") {
            alert("You Cant Enter Empty Replay , Thanks And Try Again");
        } 
        else {
            
            //send message to DB 
            $.ajax({
                type : "POST",  //type of method
                url  : "http://localhost/GuestBook/Api/replyMessage.php",  //your page
                data : { messages : y , reply : message },// passing the values
                success: function(res){  
                    
                }
            });
            

            
        }


}