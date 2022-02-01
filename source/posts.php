<h1> Posty </h1>
<a href= "index.php?q=post_add" class= "btn btn-secondary">Dodaj nowy post</a>
</br>

<?php
//all posts or posts from 
if(isset($_POST['title']))
{
    if($_POST['title']!=='all')
    {
    $sql="SELECT posts.id, title, body from posts left join topic on posts.topic_id=topic.id where topic.name= :name_topic";
    $stmt=$db_connect->prepare($sql);
    $stmt->bindParam(':name_topic', $_POST['title']);
    $stmt->execute();
    $result=$stmt->fetchall(PDO::FETCH_ASSOC);
    }
    else
    {
    $sql="SELECT posts.id, title, body from posts left join topic on posts.topic_id=topic.id";
    $stmt=$db_connect->prepare($sql);
    $stmt->execute();
    $result=$stmt->fetchall(PDO::FETCH_ASSOC);
    }
}

//select menu of topic
$sql2="SELECT name FROM topic";
$stmt2=$db_connect->prepare($sql2);
$stmt2->execute();
$row=$stmt2->fetchall(PDO::FETCH_ASSOC);
?>

<!--select menu-->
<div class="input-group mb-3">
    <div class="input-group-prepend">
        <label class="input-group-text" for="inputGroupSelect01">Wybierz temat</label>
    </div>
    <form action="" method="post">
        <select name="title" class="custom-select" id="inputGroupSelect01">
            <!--<option value='all' disabled selected>Wszystkie kategorie</option>-->
            <option value='all'>Wszystkie kategorie</option>
            <?php
            foreach($row as $rows)
                {
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
        <input type="submit" name="submit" value= "Wybierz kategorie">
    </form>
    </div>

<!--list of posts-->
<?php

if(isset($_POST['submit']))
{
    if(!empty($_POST['title']))
    {
        //number of posts to show
        $row_count=count($result);
        if($row_count>0)
        {
            ?>
            <table class=table>
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">ID posta</th>
                        <th scope="col">Tytuł posta</th>
                        <th scope="col">Treść posta</th>
                    </tr>
                </thead>
                <tbody>
                        <?php
                            foreach($result as $results)
                            { 
                                ?>
                                <tr> 
                                    <td> <?php echo $i=1; $i++ ?></td>
                                    <td> <?php echo $results['id'] ?></td>
                                    <td> <?php echo $results['title'] ?></td>
                                    <td> <?php echo $results['body'] ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                </tbody>
            </table>
            <?php
        }
        else
        {
            echo 'Brak postów w kategorii '.$_POST['title'].'.';
        }
    }
    else
    {
        echo 'Wybierz temat';
    }
}



?>