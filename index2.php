<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification System with PHP</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/font-awesome.min.css">
    <style>
        body{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a href="#" class="navbar-brand">
            Notification System with PHP
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                        Notifications
                        <span class="badge badge-light" id="notificationDisplay"> 0 </span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01" id="fetchNotify">
                        <a class="dropdown-item" href=""> <small class="font-italic text-muted"> Jan 24, 2022 </small> <br/>
                            <span class=""> Someone Commented on ur post </span>
                        </a>
                        <div class="dropdown-divider"></div>   
                    </div>
                </li>
            </ul>
            <form method="POST" id="message" class="form-inline my-2 my-lg-0">
                <input type="text" name="textmessage" class="form-control" placeholder="Message" required>
                <button type="submit" id="messageBTN" class="btn btn-outline-success my-2 my-sm-0 ml-3"> Submit </button>
            </form>

            <div class="ml-lg-5">
                <form method="POST" id="like" class="form-inline my-2 my-lg-0">
                    <input type="text" name="like" class="form-control" placeholder="Name">
                    <button type="submit" id="likeBTN" class="btn btn-outline-primary my-2 my-sm-0 ml-3"> Like </button>
                </form>
            </div>
        </div>
    </nav>

    <main role="main" class="container-fluid mt-3">
        <h4> Hello Notification System</h4>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quisquam ratione tenetur consequuntur officiis modi sapiente, atque quo vero obcaecati eius, dignissimos laudantium iste quod consectetur pariatur ab? Tempora, nulla ullam!</p>
    </main>


    <script src="./js/jquery.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {

            //Dispplay Notification 
            displayNotification()
            function displayNotification(){
                $.ajax({
                    url: "php/process.php",
                    method: "POST", 
                    data: {action: "displayNotification"},
                    success: function(response){
                        // console.log(response);
                        $("#notificationDisplay").html(response);
                    } 
                })
            }

            //Fetch Notifications 
            fetchNotification()
            function fetchNotification(){
                $.ajax({
                    url: "php/process.php",
                    method: "POST", 
                    data: {action: "fetchNotification"},
                    success: function(response){
                        // console.log(response);
                        $("#fetchNotify").html(response);
                    } 
                })
            }


            //comment system
            $("#messageBTN").on("click", function(e){
                if ($("#message")[0].checkValidity()) {                    
                    e.preventDefault();

                    $("#messageBTN").text('please wait...');

                    $.ajax({
                        url: "php/process.php",
                        method: "POST",
                        data: $("#message").serialize() + '&action=messageNow',                       
                        success: function(response){
                            if (response === 'Done') {
                                console.log("You have sent message")
                                $("#messageBTN").text('Submit');
                                $("#message")[0].reset();
                            }else{
                                console.log("Something went wrong. Please try again")
                                $("#messageBTN").text('Submit');
                            }
                            displayNotification()
                            fetchNotification()
                        }
                    })
                }
            });

            //Like system
            $("#likeBTN").on("click", function(e){
                if ($("#like")[0].checkValidity()) {                    
                    e.preventDefault();

                    $("#likeBTN").text('please wait...');

                    $.ajax({
                        url: "php/process.php",
                        method: "POST",
                        data: $("#like").serialize() + '&action=likeNow',                       
                        success: function(response){
                            console.log(response);
                            if (response === 'Liked') {
                                console.log("You Liked the Post")
                                $("#likeBTN").text('Submit');
                                $("#like")[0].reset();
                            }else{
                                console.log("Something went wrong. Please try again")
                                $("#likeBTN").text('Submit');
                            }
                            displayNotification()
                            fetchNotification()
                        }
                    })
                }
            });
        });
    </script>
</body>
</html>
                