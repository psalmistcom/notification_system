<?php 

    require_once 'auth.php';
    $user = new Auth();

    // Message system from Ajax request
    if(isset($_POST['action']) && $_POST['action'] == 'messageNow'){
        // var_dump($_POST);
        $textmessage = $user->test_input($_POST['textmessage']);
        $result = $user->messageNow('comment', $textmessage, 'unread');
        if (!$result) {
            echo 'Failed';
        }else {
            echo 'Done';
        }
    }

    // Like system from Ajax request
    if(isset($_POST['action']) && $_POST['action'] == 'likeNow'){
        // var_dump($_POST);
        $like = $user->test_input($_POST['like']);
        $result = $user->likeNow($like, 'like', 'unread');
        if (!$result) {
            echo 'Failed';
        }else {
            echo 'Liked';
        }
    }

    //display counter of Notification 
    if(isset($_POST['action']) && $_POST['action'] == 'displayNotification'){
        $result = $user->displayNotificationCount();
        if(count($result)>0){
            echo $counter = count($result);
        }else {
            echo $counter = 0;
        }
    }

    //Fetch all Notifications 
    if(isset($_POST['action']) && $_POST['action'] == 'fetchNotification'){
        $output = '';
        $data =$user->fetchNotifications();

        if(count($data)>0){  
            foreach($data as $row){
                if ($row['type']=='comment') {
                    $theMessage = 'Someone Commented on ur post';
                }else {
                    $theMessage = ucfirst($row['name']) .' liked ur post';
                }
                if ($row['status']=='unread') {
                    $mystyle = 'font-weight: bold';
                 }
                $output .= '
                        <a class="dropdown-item" style="'.$mystyle.'" href="view2.php?id='.$row['id'].'"> 
                            <small class="font-italic text-muted"> '.date('F j, Y, g:i a', strtotime($row['date'])).' </small> <br/>
                            <span class=""> '. $theMessage. ' </span>
                        </a>
                        <div class="dropdown-divider"></div>               
                ';
            }
            echo $output;
        }else {
            echo 'No Records yet';
        }
    
    }
?>