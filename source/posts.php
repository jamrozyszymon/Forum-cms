<?php
if(isset($_GET['name'])) {
    $select_post=$_GET['name'];
} elseif (isset($_POST['submit'])) {
    $select_post=$_POST['title'];
}
if((isset($_POST['submit'])) || (isset($_GET['name']))){
    $sql="SELECT posts.id, title, body from posts left join topic on posts.topic_id=topic.id where topic.name= :name_topic";
    $stmt=$db_connect->prepare($sql);
    $stmt->bindParam(':name_topic', $select_post);
    $stmt->execute();
    $result=$stmt->fetchall(PDO::FETCH_ASSOC);
} else {
    $sql="SELECT posts.id, title, body from posts left join topic on posts.topic_id=topic.id";
    $stmt=$db_connect->prepare($sql);
    $stmt->execute();
    $result=$stmt->fetchall(PDO::FETCH_ASSOC);
}

//select menu of topic
$sql2="SELECT name FROM topic";
$stmt2=$db_connect->prepare($sql2);
$stmt2->execute();
$row=$stmt2->fetchall(PDO::FETCH_ASSOC);
?>

<!--select menu-->
<h1> Posty </h1>
</br>
<a href= "index.php?q=post_add" class= "btn btn-secondary btn-lg">Dodaj post</a>
</br>
</br>
<div class="input-group mb-3">
        <h5>Wyświetl wszystkie posty  </h5>
    <form method="post">
        <button type="submit" class="btn btn-secondary">Wyświetl</button>
    </form>
</div>
<div class="input-group mb-3">
        <h5>Wyświetl posty z wybranego tematu </h5>
    <form method="post">
        <label>
        <select name="title" value="title" class="form-select">
            <option selected>Wybierz temat</option>
            <?php
            foreach($row as $rows) {
                ?>
                    <option value='<?php  echo $rows['name']; ?>'>
                    <?php
                        echo $rows['name'];
                    ?>
                    </option>
                <?php
            }
            ?> 
        </select>
        </label>
        <button type="submit" name="submit" class="btn btn-secondary">Wyświetl</button>
    </form>
        </div>

<!--list of posts-->
<?php
//number of posts to show
$row_count=count($result);
if($row_count>0) {
    ?>
    </br>
    <h4><?php 
        if(isset($_POST['title'])) {
            echo 'Wyświetlam posty z tematu '.$_POST['title'].'.';
        } elseif(isset($_GET['name'])) {
            echo 'Wyświetlam posty z tematu '.$_GET['name'].'.';
        } else{ 
            echo 'Wyświetlam posty ze wszystkich kategorii.';
        }
        ?>
    </h4>
</br>
    <table class=table>
        <thead>
            <tr>
                <th scope="col" style="width:5%">ID postu</th>
                <th scope="col" style="width:30%">Tytuł postu</th>
                <th scope="col">Treść postu</th>
                <th scope="col" style="width:9%">Edytuj post</th>
                <th scope="col" style="width:8%">Usuń post</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($result as $results){ 
            ?>
            <tr> 
                <td> <?php echo $results['id'] ?></td>
                <td> <?php echo $results['title'] ?></td>
                <td> <?php echo $results['body'] ?></td>
                <td>  
                    <a href = "index.php?q=post_edit&id=<?php echo $results['id'];?>"><button type="button" class="btn btn-success">Edytuj</button></a>
                </td>
                <td>   
                    <a href = "index.php?q=post_delete&id=<?php echo $results['id'];?>"><button type="button" class="btn btn-danger">Usuń</button></a>
                    
                </td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
<?php
} elseif(isset($_POST['title'])) { ?> <h4> <?php
    echo 'Brak postów w kategorii: '.$_POST['title']; ?> </h4> <?php
} elseif(isset($_GET['name'])) { ?> <h4> <?php
    echo 'Brak postów w kategorii: '.$_GET['name']; ?> </h4> <?php
}