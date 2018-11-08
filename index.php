<?php 
require_once 'dao/Ticket.php';
$tkt = new Ticket();

?>
<!doctype html>
<html lang="pt-br">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="material/iconfont/material-icons.css">
<link rel="stylesheet" type="text/css" href="datatables/datatables.min.css">
<link rel="stylesheet" type="text/css" href="css/estilo.css">

<title>IT Services - Portal do PES</title>
</head>
<body>
	<!-- Navbar -->
	<div class="container-fluid bg-topo">
		<header class="container">
			<nav class="navbar navbar-dark">
				<a href="#" class="navbar-brand">
					<img alt="IT Solutions" src="img/IT_logo.png" width="80" class="d-inline-block align-top">
				</a>
				<form class="form-inline">
					<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-topo my-2 my-sm-0" type="submit">Search</button>
				</form>
			</nav>
		</header>
	</div>

	<!-- Atendimentos -->
	<div class="container container-topo">
		<h1>PES Portal - Atendimentos</h1>
		<hr>
		<h6>Lista de Atendimentos</h6>
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
					<td class="row">
						<i class="material-icons col-3">visibility</i>
						<i class="material-icons col-3">edit</i>
						<i class="material-icons col-3">note_add</i>
						<i class="material-icons col-3">archive</i>
					</td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</div>

	<!-- Comentários pendentes -->
	<div class="container">
		<h6>Comentários Pendentes Aprovação</h6>
		<table class="table table-striped">
			<thead class="col-auto">
				<tr class="row">
					<th class="col-2">Ticket</th>
					<th class="col-3">Status</th>
					<th class="col-3">Solicitante</th>
					<th class="col-2">Data da Publicação</th>
					<th class="col-2">Ação</th>
				</tr>
			</thead>
			<tbody>
				<tr class="row">
					<td class="col-2">CH123122</td>
					<td class="col-3">Novo</td>
					<td class="col-3">Cauan Santos</td>
					<td class="col-2">10/10/2018 12:25</td>
					<td class="row col-2"><i class="material-icons col-6">visibility</i>
						<i class="material-icons col-6">thumb_up_alt</i></td>
				</tr>
			</tbody>
		</table>
	</div>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="datatables/datatables.min.js"></script>
	
	<script type="text/javascript">
        $(document).ready( function () {
            $('#tableTickets').DataTable();
        } );
	</script>
</body>
</html>