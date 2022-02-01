<?php

if(!isset($_GET['id']))
{
    header('location: index.php?q=topic');
}
else
{
    //current name of topic
    $sql= "SELECT name From topic WHERE id= :id";
    $stmt=$db_connect->prepare($sql);
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();
    $res_name=$stmt->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST['update_name']))
    {
        $sql2="UPDATE topic SET name= :update_name WHERE ID= :current_id";
        $stmt2= $db_connect->prepare($sql2);
        $stmt2->bindParam(':update_name', $_POST['update_name']);
        $stmt2->bindParam(':current_id', $_GET['id']);
        $stmt2->execute();
        header('location: index.php?q=topic');
    }
        ?>

        <h1>Edytuj Temat</h1>
        <div>
            Obecna nazwa tematu
            </br>
            <?php echo $res_name['name']; ?>
        </div>
        <div>
            <form method="POST">
                <div class="input-group mb-3">
                <!--<span class="input-group-text" id="basic-addon1">Temat</span>-->
                <input type="text" class="form-control" name="update_name" placeholder="Nowa nazwa tematu" aria-label="Update title" aria-describedby="basic-addon1">
            </div>
            </br>
            <div class = "form-group">
                <button class ="btn btn-success btn-lg">Edytuj</button>
            </div>
            </form>
        </div>
        <?php
        
        
}
