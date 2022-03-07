<h1> Tematy </h1>

<?php
    $sql="SELECT t.id, t.name, count(p.id) AS num_posts FROM topic t left join posts p ON t.id=p.topic_id GROUP BY t.id ORDER BY t.id";
    $stmt=$db_connect->prepare($sql);
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
?>
</br>
<a href= "index.php?q=topic_add"><button type="button" class="btn btn-secondary btn-lg">Dodaj temat</button> </a>
</br>
</br>
<table class="table" style="width:100%">
    <thead>
        <tr>
            <th scope="col" style="width:5%">ID</th>
            <th scope="col" >Nazwa</th>
            <th scope="col" style="width:10%">Liczba postów w temacie</th>
            <th scope="col" style="width:9%">Edytuj temat</th>
            <th scope="col" style="width:8%">Usuń temat</th>
            <th scope="col" style="width:15%">Wyswietl posty</th>
        </tr>
    </thead>
    <tbody>
    <?php
    foreach($result as $topic) {
        ?>
        <tr>
            <td> <?php echo $topic['id'];?></td>
            <td> <?php echo $topic['name'];?></td>
            <td> <?php echo $topic['num_posts']; ?> </td>
            <td>  
                <a href = "index.php?q=topic_edit&id=<?php echo $topic['id'];?>"><button type="button" class="btn btn-success">Edytuj</button></a>
            </td>
            <td>   
                <a href = "index.php?q=topic_delete&id=<?php echo $topic['id'];?>&num_posts=<?php echo $topic['num_posts'];?>"><button type="button" class="btn btn-danger">Usuń</button></a>
                
            </td>
            <td>   
                <a href = "index.php?q=posts&name=<?php echo $topic['name'];?>"><button type="button" class="btn btn-primary">Wyswietl posty</button></a>
            </td>
        </tr>    
    <?php
    }
    ?>
    </tbody>
</table>


