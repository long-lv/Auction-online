<?php

require_once('database.php');
$errors = [];

function isFormValidated(){
    global $errors;
    return count($errors) == 0;
}

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    if (empty($_POST['name'])){
        $errors[] = 'Name Title is required';
    }  
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Create New Category</title>
    <style>
        label{
            font-weight : bold;
            line-height: 23px;
            float : left;

        }
        body{
            font-family: helvetica;
            font-size: 14px;
        }

    </style>
    <link rel="stylesheet" href="bs4/bootstrap.min.css">
    <link rel="stylesheet" href="style_admin.css" type="text/css">
</head>
<body>
<div class="container">
    <?php if ($_SERVER["REQUEST_METHOD"] == 'POST' && !isFormValidated()): ?> 
        <div class="alert alert-danger">
            <strong>Please fix the following errors!</strong> 
            <ul>
                <?php
                foreach ($errors as $key => $value){
                    if (!empty($value)){
                        echo '<li>', $value, '</li>';
                    }
                }
                ?>
            </ul>
        </div>
    <?php endif; ?>
    
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" id="form">
        <div class="form-group">
    <label class="col-sm-2 control-label">Name</label>
    <div class="col-sm-3">
      <input class="form-control" type="text" id="name" name="name"  
        value="<?php echo isFormValidated()? '': $_POST['name'] ?>">
    </div>
  </div>
  </div>
               
<div class="container">
&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-success">Sumbit</button> &nbsp; &nbsp; 
<button type="reset" class="btn btn-info">Reset</button>  
</div>
    
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == 'POST' && isFormValidated()): ?> 
        <?php 
        $category = [];
        $category['name'] = $_POST['name'];
        $result = insert_category($category);
        $newCategoryId = mysqli_insert_id($db);
        ?>
        <br><br>
        <div class="container">
        <div class="alert alert-success">
        <strong>Success!</strong>
        <h2>A new category (ID: <?php echo $newCategoryId ?>) has been created:</h2>
        <ul>
        <?php 
            foreach ($_POST as $key => $value) {
                if ($key == 'submit') continue;
                if(!empty($value)) echo '<li>', $key.': '.$value, '</li>';
            }        
        ?>
        </ul>
        </div>
        </div>
    <?php endif; ?>
    
    <br><br>
    <a href="index_category.php">Back to index</a>
    <script src="../bs4/jquery-3.4.1.min.js"></script>
    <script src="../bs4/bootstrap.min.js"></script>
</body>
</html>


<?php
db_disconnect($db);
?>