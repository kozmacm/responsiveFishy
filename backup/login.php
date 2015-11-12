<?php
    require("config.php"); 
    $submitted_username = ''; 
    if(!empty($_POST)){ 
        $query = " 
            SELECT 
                id, 
                username, 
                password, 
                salt, 
                email 
            FROM users 
            WHERE 
                username = :username 
        "; 
        $query_params = array( 
            ':username' => $_POST['username'] 
        ); 
          
        try{ 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); } 
        $login_ok = false; 
        $row = $stmt->fetch(); 
        if($row){ 
            $check_password = hash('sha256', $_POST['password'] . $row['salt']); 
            for($round = 0; $round < 65536; $round++){
                $check_password = hash('sha256', $check_password . $row['salt']);
            } 
            if($check_password === $row['password']){
                $login_ok = true;
            } 
        } 
 
        if($login_ok){ 
            // if login is ok then we add a cookie 
            $_POST['username'] = stripslashes($_POST['username']); 
            $hour = time() + 3600; 
            setcookie(ID_my_site, $_POST['username'], $hour); 
            setcookie(Key_my_site, $_POST['password'], $hour); 


            unset($row['salt']); 
            unset($row['password']); 
            $_SESSION['user'] = $row;  
            //$_SESSION['valid_user'] = $_POST['username'];
            header("Location: admin/dashboard.php"); 
            die("Redirecting to: admin/dashboard.php"); 
        } 
        else{ 
            print("Login Failed."); 
            $submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8'); 
        } 
    } 
?>