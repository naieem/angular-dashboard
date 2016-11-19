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
    if($action=='getallpop'){
        try {
            $stmt = $dbh->query('select word from popular group by word ORDER BY count(*) DESC limit 4');
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($data);    
            
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
    if($action=='getContent'){
        try {
            $sql="select description from articles where id=:id";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':id', $_GET['id']); 
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_OBJ);

            echo json_encode($data);    
            
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
    if($action=='search'){
        try {
            $sql="select id,title from articles where title LIKE '%".$_GET['q']."%' or description like '%".$_GET['q']."%'";
            $stmt = $dbh->prepare($sql);
            //$stmt->bindParam(':q', "%".$_GET['q']."%"); 
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $count = $stmt->rowCount();
            if($count>0){
                $sql="insert into popular (id,word) values ('',:word)";
                $stmt = $dbh->prepare($sql);
                $stmt->bindParam(':word',$_GET['q']); 
                $stmt->execute();
                $output['info']=$data;
                $output['result']='active';
            }
            else{
             $output['result']='inactive';   
         }
         echo json_encode($output);
         //echo "hjhj";   

     }
     catch(PDOException $e)
     {
        echo $e->getMessage();
    }
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