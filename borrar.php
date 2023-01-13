<?php


$dbname = 'crud_mascotas';
$user = 'root';
$password = '';

try {
    $dsn = "mysql:host=localhost;dbname=$dbname";

    $dbh = new PDO($dsn,$user,$password);

    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e){

    echo $e->getMessage();
}

$id= $_POST ['id'];


// Prepare:

$stmt=$dbh->prepare("DELETE FROM mascotas WHERE id=:id");

// Bind

//$id= $_POST ['id'];


$stmt->bindValue(':id',$id); // Se enlaza al valor 


//Execute

$stmt->execute();// Se insertará

header("Location: index.php");

?>