<?php

if((isset($_POST['submit'])) && (empty($_POST['add_topic']))) {
    echo "wprowadź nazwę";
} elseif (isset($_POST['submit'])) {
    $sql='INSERT INTO topic (id,name) VALUES(null,:add_topic)';
    $stmt=$db_connect->prepare($sql);
    $stmt->bindParam(':add_topic', $_POST['add_topic']);
    $stmt->execute();
    header ('location:index.php?v=topic');
}
    
$sql2= 'SELECT id, name from topic';
$stmt2=$db_connect->prepare($sql2);
$stmt2->execute();

?>

<!--adding a topic-->
<h1> Dodaj temat forum </h1>
</br>
<form method = "post">
    <div class ="form-group">
        <label>Podaj temat</label>
        <input type ="text" class="form-control" name ="add_topic" placeholder="Temat">
        <small class="form-text text-muted">Temat może zawierać 255 znaków</small>
    </div>
    </br>
    <div class = "form-group">
        <button type="submitt" name="submit" class ="btn btn-primary btn-lg">Dodaj</button>
    </div>
</form>
</br>

<!--list of topic to show-->
<h2>Lista obecnych tematów na forum</h2>
</br>
<table class= "table"> 
    <thead>
        <tr>
            <th scope = "col">ID DataBase</th>
            <th scope = "col">Nazwa</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    foreach($stmt2 as $topics) {
        ?>
            <tr>
                <td> <?php echo $topics['id'];?> </td>
                <td> <?php echo $topics['name'];?> </td>
            </tr>
        <?php
    }
    ?>
    </tbody>
</table>



