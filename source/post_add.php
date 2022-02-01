<?php
if(isset($_POST['title']))
{
$sql = "INSERT INTO posts (id, title, body, topic_id) VALUES(null, :title, :body,:topic_id)";
$stmt=$db_connect->prepare($sql);
$stmt->bindParam(':title', $_POST['title']);
$stmt->bindParam(':body', $_POST['body']);
$stmt->bindParam(':topic_id', $_POST['topic_id']);
$stmt->execute();
}
else
{
    echo 'Wprowadź tytuł postu';
}
//select menu of topic
$sql2="SELECT name, id FROM topic";
$stmt2=$db_connect->prepare($sql2);
$stmt2->execute();
$result=$stmt2->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Dodaj post</h1>

<form method="post">
    <div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1">Tytuł</span>
    <input type="text" class="form-control" name="title" placeholder="Tytuł postu" aria-label="Title post" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
    <span class="input-group-text">Treść</span>
    <textarea class="form-control" name="body" placeholder="Treśc posta" aria-label="Body post"></textarea>
    </div>
    <div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1">Temat</span>
    <select name='topic_id' class="custom-select" id="inputGroupSelect01">
        <option selected>Wybierz odpowiedni temat dla posta</option>
        <?php
        foreach($result as $results)
        {
        ?>
            <option value= <?php echo $results['id']; ?> > <?php echo $results['name']; ?></option>

        <?php    
        }
        ?>

    </select>
    </div>
    <input type="submit" value="Dodaj post">
</form>
