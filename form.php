﻿<?php 
require_once 'dao/Usuario.php';
require_once 'dao/Ticket.php';

$usuario = new Usuario();
$ticket = new Ticket();
$existe = false;

if (isset($_POST['enviar'])){

    if($usuario->exists($_POST['oneid']) == FALSE){
        $usuario->insert($_POST);
    }

    if($ticket->exists($_POST['ticket_id'])){
<<<<<<< HEAD
        $existe = true;
=======
        //echo '<script type="text/javascript">alert("Este Chamado já está em processo de priorização/escalação")</script>';
        $existe = true;
        //header("location: /pesportal/detalhes.php?ticket_id=".$_POST['ticket_id']);
>>>>>>> fa48ee8da3d6e85205db2b322745064147e0205b
    } else {
        $ticket->insert($_POST);
        echo '<script type="text/javascript">alert("Solicitação efetuada, em breve você receberá contato da equipe PES IT")</script>';
        header("location: /pesportal/detalhes.php?ticket_id=".$_POST['ticket_id']);
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
    <!-- Navbar -->
	<?php 
	   require_once 'inc/topo_user.php';

	if($existe){
	    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
	    <p align="center">Ticket <strong>'.$_POST['ticket_id'].'</strong> já está em processo de Priorização/Escalação <a href="detalhes.php?ticket_id='.$_POST['ticket_id'].'">Veja aqui</a></p>
	    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	    </button>
	    </div>';
	}
	?>
	<!-- Introdução -->
	<div class="container">
		<h1 align="center">Serviço de Priorização e Escalação - PES IT</h1>
		<hr>
		Olá!<br><br>
		Este é o formulário do PES IT e permite registrar seu pedido de priorização ou escalação de chamados com as equipes de IT.<br><br>
		Por favor complete todos os campos obrigatorios e detalhe da maneira mais completa possível a situação que deseja reportar para podermos atuar com maior eficacia e resolver o seu problema com agilidade.<br><br>
		Todas as informações são obrigatorias.
		<hr>
	</div>
	
	<!-- Formulário -->
	<div class="container form-pes">
		<form method="post">
			<div class="form-group">
				<label for="oneid">Informe o seu OneID:</label>
				<input type="number" class="form-control col-sm-12 col-md-3" id="oneid" name="oneid" placeholder="OneID" required>
			</div>
			
			<div class="form-group">
				<label for="nome">Confirme o seu nome:</label>
				<input type="text" class="form-control col-sm-12 col-md-6" id="nome" name="nome" placeholder="Nome" required>
			</div>
			
			<div class="form-group">
				<label for="email">Endereço de e-mail:</label>
				<input type="email" class="form-control col-sm-12 col-md-6" id="email" name="email" aria-describedby="emailHelp" placeholder="email@exemplo.com" required>
				<small id="emailHelp" class="form-text text-muted">Caso a falha a ser reportada seja no seu email, por favor forneça um endereço alternativo.</small>
			</div>
			
			<div class="form-group">
				<label for="localidade">Confirme sua localidade:</label>
				<input type="text" class="form-control col-sm-12 col-md-6" id="localidade" name="localidade" aria-describedby="localidadelHelp" placeholder="Localidade" required>
				<small id="localidadeHelp" class="form-text text-muted">ex.: Matriz, Itajaí, Santa Cruz do Sul, etc...</small>
			</div>
			
			<div class="form-group">
				<label for="telefone">Telefone para contato:</label>
				<input type="text" class="form-control col-sm-12 col-md-6" id="telefone" name="telefone" placeholder="(21)00009500" required>
			</div>

			<div class="form-group">
				<label for="ticket_id">Informe o numero do chamado:</label>
				<input type="text" class="form-control col-sm-12 col-md-6" id="ticket_id" name="ticket_id" value="<?php if(isset($_GET['ticket_id'])) {echo $_GET['ticket_id'];}?>" placeholder="ex.: CHXXXXXXX" required>
			</div>
			
			<div class="form-group">
    			Selecione a area impactada:<br>
    			<select class="custom-select col-sm-12 col-md-6" name="area_afet">
    				<option value="Delivery" selected>Delivery</option>
    				<option value="Delivery">Finance</option>
    				<option value="Delivery">IT</option>
    				<option value="Leaf">Leaf</option>
    				<option value="Delivery">Marketing</option>
    				<option value="Operations">Operations</option>
    				<option value="Supply">Supply</option>
    			</select>
			</div>
			
			<div class="form-group">
				<label for="sistema_afet">Sistema impactado</label>
				<input type="text" class="form-control col-sm-12 col-md-6" id="sistema_afet" name="sistema_afet" placeholder="Sistema" required>
			</div>
			
			<div class="form-group">
				<label for="descricao">Descreva o impacto que este problema causa para o negócio:</label>
				<textarea class="form-control" id="descricao" name="descricao" rows="4" required></textarea>
			</div>
			
			<br>Impacto para o negócio:<br>
			<div class="form-check">
				<input class="form-check-input" type="radio" name="impacto" id="baixo" value="baixo" checked>
				<label class="form-check-label" for="baixo">Baixo - Um usuário afetado e sem impacto para o negócio</label>
			</div>
			<div class="form-check">
				<input class="form-check-input" type="radio" name="impacto" id="medio" value="medio">
				<label class="form-check-label" for="medio">Médio - Multiplos usuários afetados e possível impacto para o negócio</label>
			</div>
			<div class="form-check">
				<input class="form-check-input" type="radio" name="impacto" id="alto" value="alto">
				<label class="form-check-label" for="alto">Alto - Área funcional parada ou real risco legal e/ou financeiro</label>
			</div>
			<br>
			<button type="submit" name="enviar" class="btn btn-outline-form mb-2">Enviar</button>
		</form>
		

	</div>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>

