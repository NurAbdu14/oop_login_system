<?php
include("include/header.php");
if(isset($_SESSION['user'])){
  header("location: http://localhost/user/index.php");
}
if(isset($_POST['submit'])){
  $user->auth($_POST['email'],$_POST['pass']);
}
?>

    <div class="container-fluid" style="margin-top: 25px;">
      <div class="row">
        <div class="col-sm-4 offset-sm-4">
          <div class="card">
            <div class="card-header text-sm-center">
                Login Here
            </div>
            <div class="card-block">
            <?php
            if(isset($_SESSION['error'])){
                echo '<div class="alert-danger" role="alert">';
                echo $_SESSION['error'];
                echo '</div>';
                unset($_SESSION['error']);
            }

            ?>

              <form action="" method="post" class="main-form">

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="" class="form-control" placeholder="Enter your Email">
                </div>
                
                <div class="form-group">
                    <label for="pass">Password</label>
                    <input type="password" name="pass" id="" class="form-control" placeholder="Enter your Passord">
                </div>

                
                <button type="submit" name="submit" class="btn btn-primary float-sm-rigt">Login</button>
                
              </form> 
            </div>
          </div>           

        </div>
      </div>
    </div>
    
    <?php
include("include/footer.php")

?>