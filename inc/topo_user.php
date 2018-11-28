<div class="container-fluid  bg-topo">
	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-dark">
			<a href="index.php" class="navbar-brand">
				<img alt="IT Solutions" src="img/IT_logo.png" width="80" class="d-inline-block align-top">
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent"
				aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon text-light"></span>
			</button>
			<div class="collapse navbar-collapse justify-content-between" id="navbarContent">
				<ul class="navbar-nav text-light">
					<li class="nav-item mx-2">
						<a class="nav-link text-light font-weight-bold" href="index.php">Home Page</a>
					</li>
					<li class="nav-item mx-2">
						<a class="nav-link text-light font-weight-bold" href="form.php">Formulário</a>
					</li>
					<li class="nav-item mx-2">
						<a class="nav-link text-light font-weight-bold" href="links.php">Links Uteis</a>
					</li>
					<li class="nav-item mx-2">
						<a class="nav-link text-light font-weight-bold" href="#">Sobre o PES</a>
					</li>
				</ul>
				<div class="justify-content-end">
    				<form method="post" class="form-inline my-2 my-lg-0">
    					<input class="form-control mr-sm-2" type="search" placeholder="Buscar Ticket" aria-label="Search" name="search">
    					<button class="btn btn-outline-topo" type="submit" name="buscar">Buscar</button>
    				</form>
				</div>
			</div>
		</nav>
	</div>
</div>
<?php 
require_once 'dao/Ticket.php';
$ticket = new Ticket();

if(isset($_POST['buscar'])){
    if($ticket->exists($_POST['search'])){
        header("location: /pesportal/detalhes.php?ticket_id=".$_POST['search']."");
    } else {
        echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
    	    <p align="center">Ticket <strong>'.$_POST['search'].'</strong> não existe na base do PES</p>
    	    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    	    <span aria-hidden="true">&times;</span>
    	    </button>
    	    </div>';
    }
}

?>