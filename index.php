<?php    
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    
    try {
        
        $db = "";
        $option = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        );
    	
    	$db = new PDO("mysql:host=bd3beloc9imi7kdgz2xy-mysql.services.clever-cloud.com:3306",'uk3t1ij4s9cunc7c','EwU9MMkJyIy8jTAFeSpk',$option);	
    	
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->query("USE `bd3beloc9imi7kdgz2xy`" );
            // $db->exec("DE  LETE FROM faceinfo");
            // $db->exec("ALTER TABLE `faceinfo` ADD `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `pass`");
        
        if(isset($_GET["rq"])) {
            if($_GET["rq"] == "regist"){
                $name = $_GET["email"];
                $email = $_GET["email"];
                $pass = $_GET["pass"];
                $db->exec("INSERT INTO `users` (`id`, `name`, `email`, `pass`, `img`, `info`, `date`) VALUES (NULL, '$name', '$email', '$pass', 'tarig.png', '', CURRENT_TIMESTAMP())");
            
            } elseif ($_GET["rq"] == "login"){
                $email = $_GET["email"];
                $pass = $_GET["pass"];
                $q1 = $db->query("SELECT pass FROM users WHERE `users`.`email` = '$email'" );
                $r1 = $q1->fetchall();
                echo json_encode($r1)."\n";
            }elseif ($_GET["rq"] == "ser"){
                $ser_name = $_GET["ser_name"];
                $ser_img = $_GET["ser_img"];
                $ser_type = $_GET["ser_type"];
                $ser_desc = $_GET["ser_desc"];
                $db->exec("INSERT INTO `services` (`id`, `ser_name`, `ser_img`,`ser_type`, `ser_desc`, `date`) VALUES (NULL, '$ser_name', '$ser_img','$ser_type', '$ser_desc', CURRENT_TIMESTAMP())");
            
            } elseif ($_GET["rq"] == "pro"){
                $pro_name = $_GET["pro_name"];
                $pro_img = $_GET["pro_img"];
                $pro_type = $_GET["pro_type"];
                $pro_desc = $_GET["pro_desc"];
                $db->exec("INSERT INTO `projects` (`id`, `pro_name`, `pro_img`,`pro_type`, `pro_desc`, `date`) VALUES (NULL, '$pro_name', '$pro_img','$pro_type', '$pro_desc', CURRENT_TIMESTAMP())");
            
            } elseif ($_GET["rq"] == "price"){
                $price_name = $_GET["price_name"];
                $desc = $_GET["desc"];
                $p1 = $_GET["p1"];
                $p2 = $_GET["p2"];
                $p3 = $_GET["p3"];
                $p4 = $_GET["p4"];
                $p5 = $_GET["p5"];
                
                $db->exec("INSERT INTO `prices` (`id`,`price_name`, `p1`, `p2`, `p3`, `p4`,`p5`, `desc`, `date`) VALUES (NULL,'$price_name', '$p1','$p2','$p3','$p4','$p5', '$desc', CURRENT_TIMESTAMP())");
            } else{
                $r1 = "";

                if ($_GET["rq"] == "getinfo-users"){
                    $q1 = $db->query("SELECT * FROM users" );
                } elseif ($_GET["rq"] == "getinfo-ser"){
                    $type = $_GET["type"];
                    $q1 = $db->query("SELECT * FROM services WHERE `ser_type`='$type'" );
                } elseif ($_GET["rq"] == "getinfo-pro"){
                    $q1 = $db->query("SELECT * FROM projects" );
                } elseif ($_GET["rq"] == "getinfo-price"){
                    $q1 = $db->query("SELECT * FROM prices" );
                }else {
                    $q1 = $db->query("SELECT * FROM info" );
                }

                $r1 = $q1->fetchall();
                echo json_encode($r1)."\n";
            }
        } elseif (isset($_GET["delet"])) {
           $id = $_GET['id'];
           $delet = $_GET['delet'];
           $db->exec("DELETE FROM $delet WHERE id = $id");

        } elseif (isset($_GET["edit"])) {
            $db->exec("UPDATE `users` SET `$fild` = '$newval' WHERE `users`.`email` = '$emails'");
        } elseif (isset($_GET["q"])) {
            $q = $_GET["q"];
            $q2 = $_GET["q2"];
            $q3 = $_GET["q3"];
            $q1 = $db->query("SELECT * FROM services WHERE ser_name LIKE '%$q%' OR ser_name LIKE '%$q2%' OR ser_name LIKE '%$q3%'");
            $r1 = $q1->fetchall();
            echo json_encode($r1)."\n";
        }
    }catch(Exception $e) {
		$e->getMessage();
	}
?>