<?php

$sql="SELECT name FROM topic WHERE id=:id";
$stmt=$db_connect->prepare($sql);
$stmt->bindParam(':id', $_GET['id']);
$stmt->execute();
$result=$stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_GET['id'])) {
    if(isset($_POST['submit'])) {
        $sql2="DELETE FROM topic where id=:id";
        $stmt2=$db_connect->prepare($sql2);
        $stmt2->bindParam(':id', $_GET['id']);
        $stmt2->execute();
        header('location: index.php?q=topic');

        //delete posts in selected topic
        if($_GET['num_posts']>0) {
            $sql2="DELETE FROM posts where topic_id=:topic_id";
            $sql2=$db_connect->prepare($sql2);
            $sql2->bindParam(':topic_id', $_GET['id']);
            $sql2->execute();
        }
    }
} else {
        header('location: index.php?q=topic');
}
?>

<h1>Usuń Temat</h1>
</br>
<?php 
if($_GET['num_posts']>0) {
    ?>  W temacie <?php echo $result['name'];?> znajdują się posty. Czy usunąć również posty?
    <?php
} else { ?>
    Czy na pewno usunąć temat <?php echo $result['name'];?>?<?php
} ?>
</br>
</br>
<form method="post">
    <button class ="btn btn-danger" name="submit">Usuń</button>
    <a href= "index.php?q=topic"><button type="button" class="btn btn-secondary">Anuluj</button></a>
</form>