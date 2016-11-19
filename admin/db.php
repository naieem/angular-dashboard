<?php
/*** mysql hostname ***/
$hostname = 'localhost';

/*** mysql username ***/
$username = 'root';

/*** mysql password ***/
$password = '';
$dbh = new PDO("mysql:host=$hostname;dbname=test", $username, $password);
$output=[];
//echo $_SERVER['REQUEST_METHOD'];
if ($_SERVER['REQUEST_METHOD'] == 'GET' && empty($_GET)){
    $_GET= json_decode(file_get_contents('php://input'), true);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST)){
    $_POST= json_decode(file_get_contents('php://input'), true);
}

// if ($_SERVER['REQUEST_METHOD'] == 'DELETE' && empty($_DELETE)){
//     $_DELETE= json_decode(file_get_contents('php://input'), true);
// }

if ($_SERVER['REQUEST_METHOD'] == 'PUT' && empty($_PUT)){
    $_PUT= json_decode(file_get_contents('php://input'), true);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    $action=$_GET['action'];
    if($action=='getall'){
        try {
            $stmt = $dbh->query('select * from articles ORDER BY sort ASC');
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($data);    
            
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
    if($action=='searchArticle'){
        try {
            $sql="select * from articles where id=:id";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':id', $_GET['id']); 
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode($data);    
            
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
    if($action=='update'){
        $ids= array();
        $ids=json_decode($_GET['id']);
        //print_r($ids);
        //echo $ids[2];
        for ($x = 0; $x < sizeof($ids); $x++) {
            try {
                $sql="update articles set sort=:sort where id=:id";
                $stmt = $dbh->prepare($sql);
                $stmt->bindParam(':sort',$x);
                $stmt->bindParam(':id', $ids[$x]); 
                $stmt->execute();
                //$data = $stmt->fetch(PDO::FETCH_ASSOC);
                $output[]="done"." ";    
                //
            }
            catch(PDOException $e)
            {
                $output[]=$e->getMessage();
            }
        }
        echo json_encode($output);        
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'PUT'){
    $action=$_PUT['action'];
    if($action=='update'){
        //$output['title']=$_POST['description'];
        if(!isset($_PUT['title'])){
            $output['msg']="Title should not be empty";
        }
        else if(!isset($_PUT['description'])){
            $output['msg']="Description should not be empty";
        }
        else{
            try {
                $sql = "UPDATE articles SET title = :title,description = :description WHERE id= :ID";
                $stmt = $dbh->prepare($sql);                                  
                $stmt->bindParam(':title', $_PUT['title']);       
                $stmt->bindParam(':description', $_PUT['description']);    
                $stmt->bindParam(':ID', $_PUT['id']);
                $stmt->execute();  
                $output['insertId']=$dbh->lastInsertId(); 
                $output['msg']="Article Updated Successfully";  
                
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }   
        }
        echo json_encode($output);

    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $action=$_POST['action'];
    if($action=='create_new'){
        if(!isset($_POST['title'])){
            $output['msg']="Title should not be empty";
        }
        else if(!isset($_POST['description'])){
            $output['msg']="Description should not be empty";
        }
        else{
            try{
                $sql = "INSERT INTO articles(title,description) VALUES (:title, :description)";
                $stmt = $dbh->prepare($sql);
                $stmt->bindParam(':title', $_POST['title']);       
                $stmt->bindParam(':description', $_POST['description']);
                $stmt->execute();
                $output['insertId']=$dbh->lastInsertId(); 
                $output['msg']="Article Inserted Successfully";
            }
            catch(PDOException $e)
            {
                $output['msg']=$e->getMessage();
                //echo json_encode($output);
            }    
        }
        echo json_encode($output);

    }
    if($action=='delete'){
        try{
            $sql = "DELETE FROM articles WHERE id=:ID";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':ID', $_POST['id']);   
            $stmt->execute();
            //$output['insertId']=$dbh->lastInsertId(); 
            $output['msg']=$_POST['id'];
            echo json_encode($output);
        }
        catch(PDOException $e)
        {
            $output['msg']=$e->getMessage();
                //echo json_encode($output);
        }    
        

    }
    
}
// try {
//     $dbh = new PDO("mysql:host=$hostname;dbname=test", $username, $password);
//     $output=[];
//     $output[]=$info;
//     echo json_encode($output);
//     // if($info->action=='create_new'){
//     //     $output[]=$info->action;
//     //     echo json_encode($output);
//     // }
//     // if(isset($post->name)){
//     //     $output[]=$post->name;
//     //     echo json_encode($output);
//     // }
//     // else{
//     //     $stmt = $dbh->query('select * from user');
//     //     $data = $stmt->fetchAll(PDO::FETCH_OBJ);
//     //     echo json_encode($data);
//     // }
//     /*** close the database connection ***/
//     
// }
// catch(PDOException $e)
// {
//     echo $e->getMessage();
// }