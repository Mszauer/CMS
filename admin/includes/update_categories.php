
 <form action="" method="POST">
    <div class="form-group">
        <label for="cat_title">Update Category</label>
        <?php 
            if(isset($_GET['edit'])){
                $editId = $_GET['edit'];
                $query = "SELECT * FROM categories WHERE cat_id = {$editId}";
                $queryResult = mysqli_query($connection,$query);
                while($row = mysqli_fetch_assoc($queryResult)){
                    $catTitle = $row['cat_title'];
                    $catId = $row['cat_id'];
        ?> 
        <input value="<?php if(isset($catTitle)){ echo $catTitle; } ?>" class="form-control" type="text" name="cat_title" required/>
        <?php    
                }
            }
        ?>
        <?php
            if(isset($_POST['edit'])){
                $updateTitle = $_POST['cat_title'];
                $query = "UPDATE categories SET cat_title='{$updateTitle}' WHERE cat_id = {$catId} ";
                $updateQuery = mysqli_query($connection,$query);
                if(!$updateQuery){
                    die("Query failed: ") . mysqli_error($connection);
                }
            }
        ?>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit" value="Update Category" />
    </div>
</form>