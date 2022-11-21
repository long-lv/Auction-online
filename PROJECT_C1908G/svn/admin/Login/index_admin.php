<?php
require_once('database.php');
?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8"/>
        <title>Index</title>
       <link rel="stylesheet" href="bs4/bootstrap.min.css">
        <link rel="stylesheet" href="style_admin.css" type="text/css">
        <link rel="shortcut icon" type="image/png" href="admin.ico"/>
        <style>
            td:hover{
                color: red;
            }
            a:hover{
                color: red;
            }
        </style>
    </head>
    <body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 col-xs-1" id="sidebar">
                <div class="list-group">
            <span class="list-group-item" data-toggle="collapse" data-parent="#sidebar">
                <div class="text-center">
                    <img src="product/upload_img/images.png" style="width: 100px;height: 100px">
                     <?php
                     if(isset($_SESSION['user_login'])){
                         echo $_SESSION['user_login'];
                     }
                     ?>
                </div>
            </span>
                    <a href="New%20Admin.php" class="list-group-item">
                        <i class="fa fa-dashboard"></i>
                        <span class="fas fa-user"></span>
                        <span class="hidden-sm-down">Crete New Admin</span>
                    </a>
                    <a href="product/product_index.php" class="list-group-item">
                        <i class="fa fa-dashboard"></i>
                        <span class="fas fa-user"></span>
                        <span class="hidden-sm-down">Product Manage</span>
                    </a>
                    <a href="category/index_category.php" class="list-group-item">
                        <i class="fa fa-list"></i>
                        <span class="hidden-sm-down">Category Manage</span>
                    </a>
                     <a href="logout_admin.php" class="list-group-item">
                        <i class="fa fa-list"></i>
                        <span class="hidden-sm-down">Logout</span>
                    </a>

                </div>
            </div>
            <div class="col-md-10 col-xs-1">
                <table class="table table-striped table-dark">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Password</th>
                        <th scope="col">Email</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <?php
                    $Admin_set = find_all_Admins();
                    $count = mysqli_num_rows($Admin_set);
                    for ($i = 0; $i < $count; $i++):
                        $Admin = mysqli_fetch_assoc($Admin_set);
                        ?>
                        <tr>
                            <td><?php echo $Admin['Name']; ?></td>
                            <td><?php echo $Admin['Password']; ?></td>
                            <td><?php echo $Admin['Email']; ?></td>
                            <td><a href="<?php echo 'edit_admin.php?id=' . $Admin['id']; ?>">Edit</a></td>
                            <td><a href="<?php echo 'delete_admin.php?id=' . $Admin['id']; ?>">Delete</a></td>
                        </tr>
                    <?php
                    endfor;
                    mysqli_free_result($Admin_set);
                    ?>
                </table>
            </div>
        </div>
    </div>
    </div>
    </div>
   <script src="bootstrap.min.js"></script>
    <script src="jquery-3.4.1.min.js"></script>
    </body>
    </html>

<?php
db_disconnect($db);
?>