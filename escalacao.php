<?php 

require_once 'dao/Ticket.php';
$ticket = new Ticket();


?>
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
	require_once 'inc/topo_admin.php';
	?>
	
	<div class="container">
		<header>
    		<div>
    			<?php foreach ($ticket->loadByID($_GET['ticket_id']) as $res){?>
    			<h1>Detalhes do Ticket: <?=$res['ticket_id']?></h1>
    			<h6>Ultima atualização do PES: 23/08/2018 17:59</h6>
    		</div>
    		<hr>
		</header>
	
    	<section id="detalhes">
    		<label><strong>Nome: </strong><?=$res['nome']?> (<?=$res['oneid']?>)</label><br>
    		<label><strong>E-mail: </strong><?=$res['email']?></label><br>
    		<label><strong>Telefone: </strong><?=$res['telefone']?></label><br>
    		<label><strong>Localidade: </strong><?=$res['localidade']?></label><br>
    		<label><strong>Área Impactada: </strong><?=$res['area_afet']?></label><br>
    		<label><strong>Sistema: </strong><?=$res['sistema_afet']?></label><br>
    		<label><strong>Descrição: </strong><?=$res['descricao']?></label><br>
    		<label><strong>Impacto para o negócio: </strong><?=$res['impacto']?></label><br>
    			<?php }?>
    		<hr>
    	</section> <!-- Fim da sessão detalhes -->
    	
    	<section id="escalacao">
    		<form>
    			<div class="form-row">
    				<div class="form-group col-md-6">
    					<label for="resolver_group">Resolver Group</label>
    					<input type="text" class="form-control" id="resolver_group" name="resolver_group">
    				</div>
					<div class="form-group col-md-3">
    					<label for="dthr_inic_tratativa">Inicio da Tratativa</label>
    					<input type="datetime-local" class="form-control" id="dthr_inic_tratativa" name="dthr_inic_tratativa">
    				</div>
					<div class="form-group col-md-3">
    					<label for="dthr_prim_report">Primeiro Report</label>
    					<input type="datetime-local" class="form-control" id="dthr_prim_report" name="dthr_prim_report">
    				</div>
    			</div>
    			<div class="form-row">
    				<div class="form-group col-md-3">
    					<label for="dthr_priorizacao">Priorização</label>
    					<input type="datetime-local" class="form-control" id="dthr_priorizacao" name="dthr_priorizacao">
    				</div>
    				<div class="form-group col-md-3">
    					<label for="dthr_pri_escalacao">1° Escalação</label>
    					<input type="datetime-local" class="form-control" id="dthr_pri_escalacao" name="dthr_pri_escalacao">
    				</div>
					<div class="form-group col-md-3">
    					<label for="dthr_seg_escalacao">2° Escalação</label>
    					<input type="datetime-local" class="form-control" id="dthr_seg_escalacao" name="dthr_seg_escalacao">
    				</div>
					<div class="form-group col-md-3">
    					<label for="dthr_ter_escalacao">3° Escalação</label>
    					<input type="datetime-local" class="form-control" id="dthr_ter_escalacao" name="dthr_ter_escalacao">
    				</div>
    			</div>
    		</form>
    	</section>
    	
    	<section id="listaEscalacoes">
    		<div class="card">
    			<div class="card-header">
    			<i class="fas fa-level-up-alt"></i>
    				Escalações
    			</div>
    			<div class="card-body">
            		<table class="table table-striped">
            			<thead>
            				<tr>
            					<th>Resolver Group</th>
            					<th>Status</th>
            					<th>Ações</th>
            				</tr>
            			</thead>
            			<tbody>
            				<tr>
            					<td scope="col">AMR Access Control</td>
            					<td scope="col">Ativo</td>
            					<td scope="col">
        							<a class="btn btn-outline-success btn-circle" href="#">
        	            				<i class="fas fa-arrow-up" data-toggle="tooltip" data-placement="top" title="Carregar informações"></i>
        							</a>
        							<a class="btn btn-outline-danger btn-circle" href="#">
        	            				<i class="fas fa-times" data-toggle="tooltip" data-placement="top" title="Carregar informações"></i>
        							</a>
        						</td>
            				</tr>
            			</tbody>
            		</table>
    			</div>
    		</div>
    	</section>

	</div><!-- fim do container -->
	
</body>
</html>