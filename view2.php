<?php
    include './function.php';

    $id = $_GET['id'];

    $query = "UPDATE notifications SET status = 'read' WHERE id = '$id'";
    performQuery($query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Nnoti</title>
</head>
<body>
    <?php
        $query = "SELECT * FROM notifications WHERE id = '$id'";
        if (count(fetchAll($query))>0) {
            foreach (fetchAll($query) as $i) {
                if ($i['type'] == 'like') {
                    echo ucfirst($i['name']). ' liked your post. <br/>'. $i['date'];
                }else{
                    echo "Someone's comment. <br/>". $i['message'];
                }
            }
        }
    ?>
<br> <br>
    <a href="index.php"> Back home</a>

    <script src="./js/jquery.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>

    <script>
        
    </script>
</body>
</html>