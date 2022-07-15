<?php
    include 'function.php';
?>
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
                    <a class="nav-link" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Notifications
                        <?php
                            $query = "SELECT * FROM notifications WHERE status = 'unread' ORDER BY date DESC";
                            if (count(fetchAll($query))>0) {
                            ?>
                                <span class="badge badge-light"><?= count(fetchAll($query)) ?></span>
                            <?php                                
                            }else {
                                ?>
                                <span class="badge badge-light">0</span>
                            <?php
                            }
                        ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <?php
                            $query = "SELECT * FROM notifications ORDER BY date DESC";
                            if (count(fetchAll($query))>0) {
                                foreach (fetchAll($query) as $i) {
                                    ?>
                                    <a 
                                        style="<?php
                                            if ($i['status']=='unread') {
                                               echo 'font-weight: bold';
                                            }
                                        ?>"
                                        class="dropdown-item" href="view.php?id=<?php echo $i['id']; ?>"
                                    >
                                    <small class="font-italic text-muted"><?php echo date('F j, Y, g:i a', strtotime($i['date'])); ?></small> <br/>
                                    <span class="">
                                        <?php
                                            if ($i['type']=='comment') {
                                                echo 'Someone Commented on ur post';
                                            }else if($i['type']=='like'){
                                                echo ucfirst($i['name']) .' liked ur post';
                                            }
                                        ?>
                                    </span>
                                </a>
                                <div class="dropdown-divider"></div>                                
                                <?php
                                }
                            }else {
                                echo 'No Records yet';
                            }
                        ?>                                                                        
                    </div>
                </li>
            </ul>

            <?php 
                if (isset($_POST['messageBTN'])) {
                    $message = $_POST['message'];
                    $query = "INSERT INTO notifications (name, type, message, status, date) VALUES ('', 'comment', '$message', 'unread', CURRENT_TIMESTAMP)";
                    if (performQuery($query)) {
                        echo 'yes';
                    //    header('location: index.php');
                    }
                }
            ?>
            <form method="POST" class="form-inline my-2 my-lg-0">
                <input type="text" name="message" class="form-control" placeholder="Message">
                <button type="submit" name="messageBTN" class="btn btn-outline-success my-2 my-sm-0 ml-3"> Submit </button>
            </form>


            <?php 
                if (isset($_POST['likeBTN'])) {
                    $like = $_POST['like'];
                    $query = "INSERT INTO notifications (name, type, message, status, date) VALUES ('$like', 'like', '', 'unread', CURRENT_TIMESTAMP)";
                    if (performQuery($query)) {
                        echo 'yes';
                    //    header('location: index.php');
                    }
                }
            ?>
            <div class="ml-lg-5">
                <form method="POST" class="form-inline my-2 my-lg-0">
                    <input type="text" name="like" class="form-control" placeholder="Name">
                    <button type="submit" name="likeBTN" class="btn btn-outline-primary my-2 my-sm-0 ml-3"> Like </button>
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

   
</body>
</html>