<!doctype html>
<html lang="pt-br">
<head>
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

	<div class="container">
		<h1 class="mt-4">Links para acesso à sistemas corporativos</h1>
		
		<section id="linksUteis">
    		<table class="table table-bordered table-striped"  id="tableTickets">
    			<thead>
    				<tr>
    					<th>Sistema</th>
    					<th>Link</th>
    				</tr>
    			</thead>
    			<tbody>
    				<tr>
    					<td>Neo</td>
    					<td><a href="https://neo.batgen.com">https://neo.batgen.com</a></td>
    				</tr>
					<tr>
    					<td>TechDeck</td>
    					<td><a href="https://fast.fujitsu.fi/main">https://fast.fujitsu.fi/main</a></td>
    				</tr>
					<tr>
    					<td>Onedrive</td>
    					<td><a href="https://bat.onedrive.com">https://bat.onedrive.com</a></td>
    				</tr>
    				<tr>
    					<td>Interact</td>
    					<td><a href="http://interact/">https://interact/</a></td>
    				</tr>
    				<tr>
    					<td>Cherwell IT</td>
    					<td><a href="http://bat.cherwellondemand.com/CherwellClient/Access">http://bat.cherwellondemand.com/CherwellClient/Access</a></td>
    				</tr>
    			</tbody>
    		</table>
		</section><!-- fim da sessão cardTickets -->
		
	</div><!-- fim do container -->
	
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="datatables/datatables.min.js"></script>
	<?php require_once 'inc/rodape.php';?>
</body>
</html>