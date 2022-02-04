<?php

$sql="SELECT title FROM posts WHERE id=:id";
$stmt=$db_connect->prepare($sql);
$stmt->bindParam(':id', $_GET['id']);
$stmt->execute();
$result=$stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_GET['id'])) {
    if(isset($_POST['submit'])) {
        $sql2="DELETE FROM posts where id=:id";
        $stmt2=$db_connect->prepare($sql2);
        $stmt2->bindParam(':id', $_GET['id']);
        $stmt2->execute();
        header('location: index.php?q=posts');
    } 
} else {
    header('location: index.php?q=posts');
}


?>
<h1>Usuń Temat</h1>
Czy na pewno usunąć post:
</br> <?php echo $result['title'];?> (ID postu: <?php echo $_GET['id'];?> ).
</br>
<form method="post">
<input type="submit" name="submit" value="Usun">
</form>
