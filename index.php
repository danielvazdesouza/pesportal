<?php 
require_once 'dao/Ticket.php';

$ticket = new Ticket();

if(isset($_GET['enviar'])){
    var_dump($_GET['enviar']);
    var_dump($_GET['ticket_id']);
    if($ticket->exists($_GET['ticket_id'])){
        header("location: /pesportal/detalhes.php?ticket_id=".$_GET['ticket_id']."");
    } else {
        header("location: /pesportal/form.php?ticket_id=".$_GET['ticket_id']."");
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
	?>
	<!-- Introdução -->
	<div class="container">
	<header>
		<h1 align="center">Portal de Escalações PESIT</h1>
		<hr>
	</header>
	
	<section id="priorizacao">
	    <form method="get">
			<label for="ticket_id">Solicitar Priorização:</label>
			<div class="input-group">
				<input type="text" class="form-control col-sm-12 col-md-3" id="ticket_id" name="ticket_id" placeholder="CH1234567">
    			<div class="input-group-append">
					<button type="submit" name="enviar" class="btn btn-outline-form">Enviar</button>
    			</div>
			</div>
		</form>
	</section> <!-- Fim da sessão priorizacao -->

	<section id="alta_prioridade">
		<div class="card">
			<div class="card-header">
				<i class="fas fa-exclamation-triangle"></i>
				Tickets de Alta Prioridade
			</div>
			<div class="card-body">
				<table class="table">
					<thead>
						<tr>
    						<th scope="col">Ticket</th>
    						<th scope="col">Descrição</th>
    						<th scope="col">Site Afetado</th>							
						</tr>
					</thead>
					<tbody>
						<tr>
							<td scope="col">CH1234567</td>
							<td scope="col">Internet indisponível em SCS</td>
							<td scope="col">Santa Cruz do Sul</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</section><!-- fim da sessão alta prioridade -->
		
	<section id="calendario">
		<div class="card">
			<div class="card-header">
			<i class="fas fa-calendar-alt"></i>
				Calendário de Manutenções Confirmadas:
			</div>
			<div class="card-body">
				<table class="table">
					<thead>
						<tr>
    						<th scope="col">Incio</th>
    						<th scope="col">Termino</th>
    						<th scope="col">Sistemas impactados</th>							
						</tr>
					</thead>
					<tbody>
						<tr>
							<td scope="col">23/11/2018 22:00</td>
							<td scope="col">24/11/2018 00:00</td>
							<td scope="col">Sistemas legados de tabaco</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</section><!-- Fim da sessão calendario -->
	
	</div><!-- fim do containers -->
	
	<!-- Footer -->
	<footer>
		<div class="footer">
		</div>	
	</footer>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>