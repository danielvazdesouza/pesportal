<?php 
require_once 'dao/Admin.php';
$admin = new Admin();
if(isset($_POST['login'])){
    if($admin->checkLogin($_POST)){
        session_start();
        $_SESSION['oneid'] = $_POST['oneid'];
        header("location: /pesportal/atendimentos.php");
    } else{
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
	    <p align="center">Login ou senha inválidos, favor verificar!</p>
	    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	    </button>
	    </div>';
    }
}

?>
<!doctype html>
<html lang="pt-br">
<head>
<link rel="icon" href="img/IT_logo_yellow.png">
<?php 
    require_once 'inc/config.php';
?>

<title>IT Services - Portal do PES</title>
</head>
<body>
	<div class="container">
    	<div class="login-form col-md-5 offset-md-3">
			<h1 class="login-title">Login</h1>
			<form method="post">
				<div class="mb-3">
    				<label for="username"><strong>Username</strong></label>
                    <div class="input-group">
                    	<div class="input-group-prepend">
                    		<div class="input-group-text"><i class="fas fa-user"></i></div>
                    	</div>
                    	<input type="text" class="form-control" name="oneid" id="username" placeholder="Username" required>
                    </div>
				</div>
                <div class="mb-3">
    				<label for="password"><strong>Password</strong></label>
                    <div class="input-group">
                    	<div class="input-group-prepend">
                    		<div class="input-group-text"><i class="fas fa-lock"></i></div>
                    	</div>
                    	<input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                    </div>
                </div>
				<button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
			</form>
    	</div>
	</div>


	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>

