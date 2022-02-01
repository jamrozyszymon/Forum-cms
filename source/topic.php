<h1> Tematy </h1>

<?php
    $sql="SELECT * FROM topic";
    $stmt=$db_connect->prepare($sql);
    $stmt->execute();

    //number of posts in topic
    $sql2="SELECT count(id) AS num_posts FROM posts GROUP BY topic_id";
    $stmt2=$db_connect->prepare($sql2);
    $stmt2->execute();
?>
</br>
<a href= "index.php?q=topic_add"><button type="button" class="btn btn-secondary">Dodaj temat</button> </a>
</br>
</br>
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Edytuj</th>
            <th scope="col">Usuń</th>
            <th scope="col">Wyswietl posty</th>
        </tr>
    </thead>

    <?php
        foreach($stmt as $topic)
        {
            ?>
            <tr>
            <td> <?php echo $topic['id'];?></td>
            <td>  <?php echo $topic['name'];?></td>
            <td>  
                <a href = "index.php?q=topic_edit&id=<?php echo $topic['id'];?>"><button type="button" class="btn btn-success">Edytuj</button></a>
            </td>
            <td>   
                <a href = "index.php?q=topic_delete&id=<?php echo $topic['id'];?>"><button type="button" class="btn btn-danger">Usuń</button></a>
                
            </td>
             </tr>
             <?php
        }
            ?>

        

</table>

