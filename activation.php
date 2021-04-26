<?php
include("include/header.php");
if(isset($_GET['active'])|| isset($_POST['submit'])){
  $tk = isset($_POST['submit']) ? $_POST['active'] : $_GET['active'];
  $id = isset($_POST['submit']) ? $_POST['id'] : $_GET['id'];

  $user->activate($id, $tk);
}
?>

    <div class="container-fluid" style="margin-top: 25px;">
      <div class="row">
        <div class="col-sm-4 offset-sm-4">
          <div class="card">
            <div class="card-header text-sm-center">
                Activate Your Account
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
                    <label for="active">Activation Code</label>
                    <input type="text" name="active" id="" class="form-control" placeholder="Enter your activation code">
                </div>
                <input type="hidden" name="id" id="" value="<?php echo $_SESSION['id'] ?>">
                
                              
                <button type="submit" name="active" class="btn btn-primary float-sm-rigt">Activate</button>
                
              </form> 
            </div>
            <div class="card-footer text-muted text-sm-center">
            we've sent you an email, kindly activate your account<br>
            You can copy and paste the code in the above field or just use the link to activate
            </div>
          </div>           

        </div>
      </div>
    </div>
    
    <?php
include("include/footer.php")

?>