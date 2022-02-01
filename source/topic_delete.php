<?php

$sql="SELECT name FROM topic WHERE id=:id";
$stmt=$db_connect->prepare($sql);
$stmt->bindParam(':id', $_GET['id']);
$stmt->execute();
$result=$stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_GET['id']))
{
    if(isset($_POST['submit']))
    {
    $sql2="DELETE FROM topic where id=:id";
    $stmt2=$db_connect->prepare($sql2);
    $stmt2->bindParam(':id', $_GET['id']);
    $stmt2->execute();
    echo 'usunieto';
    header('location: index.php?q=topic');
    }
}
else
{
   
    header('location:index.php?q=topic');
}
?>
<h1>Usuń Temat</h1>
Czy na pewno usunąć temat <?php echo $result['name'];?>
</br>
<form method="post">
<input type="submit" name="submit" value="Usun">
</form>