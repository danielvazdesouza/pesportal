<?php 
require_once 'dao/Ticket.php';
require_once 'dao/Informativo.php';
require_once 'dao/Manutencao.php';

$ticket = new Ticket();
$informativo = new Informativo();
$manutencao = new Manutencao();

if(isset($_GET['enviar'])){
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
    	<header class="mt-4">
    		<h1 align="center">Portal de Escalações PESIT</h1>
    		<hr>
    	</header>
    	
    	<section id="priorizacao">
    	    <form method="get">
    			<label for="ticket_id"><strong>Solicitar Priorização:</strong></label>
    			<div class="input-group">
    				<input type="text" class="form-control col-sm-12 col-md-3" id="ticket_id" name="ticket_id" placeholder="CHXXXXXX">
        			<div class="input-group-append">
    					<button type="submit" name="enviar" class="btn btn-outline-form">Ok</button>
        			</div>
    			</div>
    		</form>
    	</section> <!-- Fim da sessão priorizacao -->
    
    	<section id="alta_prioridade">
    		<div class="card my-4">
    			<div class="card-header">
    				<i class="fas fa-exclamation-triangle"></i>
    				<strong>Tickets de Alta Prioridade</strong>
    			</div>
    			<?php if ($informativo->infoExists()){?>
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
    						<?php foreach ($informativo->loadIndex() as $res){?>
    						<tr>
    							<td scope="col"><?=$res['ticket']?></td>
    							<td scope="col"><?=$res['titulo']?></td>
    							<td scope="col"><?=$res['destinatario']?></td>
    						</tr>
    						<?php }?>
    					</tbody>
    				</table>
    			</div>
    			<?php } else{
                    echo '<div class="mx-4 my-4">Não informações a serem exibidas.</div>';
    			}?>
    		</div>
    	</section><!-- fim da sessão alta prioridade -->
    		
    	<section id="calendario">
    		<div class="card my-4">
    			<div class="card-header">
    			<i class="fas fa-calendar-alt"></i>
    				<strong>Calendário de Manutenções Confirmadas:</strong>
    			</div>
    			<?php if($manutencao->exists()){?>
    			<div class="card-body">
    				<table class="table">
    					<thead>
    						<tr>
        						<th scope="col">Sistemas impactados</th>
        						<th scope="col">Localidade</th>
        						<th scope="col">Início</th>
        						<th scope="col">Termino</th>
    						</tr>
    					</thead>
    					<tbody>
    						<?php foreach ($manutencao->loadIndex() as $res){?>
    						<tr>
    							<td scope="col"><?=$res['localidade']?></td>
    							<td scope="col"><?=$res['descricao']?></td>
        						<td scope="col"><?=date("d/m/Y H:i",strtotime($res['dthr_inicio']))?></td>
    							<td scope="col"><?=date("d/m/Y H:i",strtotime($res['dthr_fim']))?></td>
    						</tr>
    						<?php }?>
    					</tbody>
    				</table>
    			</div>
    			<?php } else {
    			echo '<div class="mx-4 my-4">Não há manutenções programadas</div>';
    			}?>
    		</div>
    	</section><!-- Fim da sessão calendario -->
	</div><!-- fim do containers -->

	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	
	<?php require_once 'inc/rodape.php';?>
</body>
</html>