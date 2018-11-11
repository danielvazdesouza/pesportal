<?php 
require_once 'dao/Ticket.php';
$tkt = new Ticket();

?>
<!doctype html>
<html lang="pt-br">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<?php 
    require_once 'inc/config.php';
?>

<title>IT Services - Portal do PES</title>
</head>
<body>
	<!-- Navbar -->
	<div class="container-fluid bg-topo">
		<header class="container">
			<nav class="navbar navbar-dark">
				<a href="index.php" class="navbar-brand">
					<img alt="IT Solutions" src="img/IT_logo.png" width="80" class="d-inline-block align-top">
				</a>
				<form class="form-inline">
					<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-topo my-2 my-sm-0" type="submit">Search</button>
				</form>
			</nav>
		</header>
	</div>

	<div class="container">
		<h1>PES Portal - Atendimentos</h1>
		
		<!-- Card de Tickets -->
		<div class="card mb-3">
			<div class="card-header bg-topo text-white">
				<h6>Lista de Atendimentos</h6>
			</div>
			<div class="card-body">
        		<table class="table table-bordered table-striped"  id="tableTickets">
        			<thead>
        				<tr>
        					<th>Ticket</th>
        					<th>Status</th>
        					<th>Solicitante</th>
        					<th>Primeira Resposta</th>
        					<th>Última Atualização</th>
        					<th>Ação</th>
        				</tr>
        			</thead>
        			<tbody>
        			<?php foreach ($tkt->loadAll() as $res){?>
        				<tr>
        					<td><?=$res['ticket_id']?></td>
        					<td><?=$res['tstatus']?></td>
        					<td><?=$res['oneid']?></td>
        					<td><?=$res['prim_resposta']?></td>
        					<td>10/10/2018 12:25</td>
        					<td>
        						<i class="fas fa-eye col-4" data-toggle="tooltip" data-placement="top" title="Visualizar detalhes"></i>
        						<i class="btn fas fa-plus col-4" data-toggle="tooltip" data-placement="top" title="Adicionar comentário"></i>
        						<i class="btn fas fa-archive col-3" data-toggle="tooltip" data-placement="top" title="Arquivar caso"></i>
        					</td>
        				</tr>
        				<?php }?>
        			</tbody>
        		</table>
			</div><!-- fim do card-body -->
		</div><!-- fim do card Atendimentos-->
		
		<!-- Comentários -->
		<div class="card mb-3">
			<div class="card-header bg-topo text-white">
				<h6>Comentários Pendente</h6>
			</div>
			<div class="card-body">
        		<table class="table table-bordered table-striped"  id="tableComentarios">
        			<thead>
        				<tr>
        					<th>Ticket</th>
        					<th>Status</th>
        					<th>Nome</th>
        					<th>Publicado em:</th>
        					<th>Ação</th>
        				</tr>
        			</thead>
        			<tbody>
        			<?php foreach ($tkt->loadAll() as $res){?>
        				<tr>
        					<td><?=$res['ticket_id']?></td>
        					<td><?=$res['tstatus']?></td>
        					<td><?=$res['oneid']?></td>
        					<td>10/10/2018 12:25</td>
        					<td>
        						<i class="btn fas fa-eye" data-toggle="tooltip" data-placement="top" title="Visualizar Comentário"></i>
        						<i class="btn fas fa-check" data-toggle="tooltip" data-placement="top" title="Aceitar Comentário"></i>
        					</td>
        				</tr>
        				<?php }?>
        			</tbody>
        		</table>			
			</div><!-- fim do card-body -->
		</div><!-- fim do card Comentários-->


				
	</div><!-- fim do container -->


	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="datatables/datatables.min.js"></script>
	
	<script type="text/javascript">
        $(document).ready( function () {
            $('#tableTickets').DataTable();
        } );
	</script>
	
	<script type="text/javascript">
        $(document).ready( function () {
            $('#tableComentarios').DataTable();
        } );
	</script>
</body>
</html>