<?php 
date_default_timezone_set('America/Sao_Paulo');
require_once 'dao/Ticket.php';
require_once 'dao/Escalacao.php';
$ticket = new Ticket();
$escalacao = new Escalacao();

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
	<?php 
	   require_once 'inc/topo_admin.php';
	?>
	
	<div class="container">
		<section id="detalhes">
    		<div>
    			<?php foreach ($ticket->loadByID($_GET['ticket_id']) as $res){?>
    			<h1>Detalhes do Ticket: <?=$res['ticket_id']?></h1>
    			<h6>Ultima atualização: <?=date("d/m/Y H:i", strtotime($res['dthr_ult_atualizacao']))?></h6>
    			<h6>Status: <?=$res['tstatus']?></h6>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-md-6">
					<label><strong>Nome: </strong><?=$res['nome']?> (<?=$res['oneid']?>)</label>
    			</div>
    			<div class="col-md-6">
		    		<label><strong>E-mail: </strong><?=$res['email']?></label>
    			</div>
    		</div>
			<div class="row">
    			<div class="col-md-6">
					<label><strong>Telefone: </strong><?=$res['telefone']?></label>
    			</div>
    			<div class="col-md-6">
		    		<label><strong>Localidade: </strong><?=$res['localidade']?></label>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-md-6">
					<label><strong>Área Impactada: </strong><?=$res['area_afet']?></label>
    			</div>
    			<div class="col-md-6">
		    		<label><strong>Sistema: </strong><?=$res['sistema_afet']?></label>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-md-6">
    				<label><strong>Impacto para o negócio: </strong><?=$res['impacto']?></label>
				</div>
				<div class="col-md-6">
    				<label><strong>Recebido em: </strong><?=date("d/m/Y H:i",strtotime($res['dthr_recebimento']))?></label>
				</div>
    		</div>
    		<div class="row">
    			<div class="col-md-12">
    				<label><strong>Descrição: </strong><?=$res['descricao']?></label>
    			</div>
    		</div>
    		<form class="form">
    			<div class="row">
        			<div class="form-group col-md-3">
        				<label for="origem"><strong>Origem: </strong></label>
        				<input type="text" class="form-control" name="origem" value="<?=$res['origem']?>">
        			</div>
        			<div class="form-group col-md-3">
        				<label for="prim_resposta"><strong>Primeira Resposta:</strong></label>
        				<input type="time" class="form-control" name="prim_resposta" value="<?php if(isset($res['prim_resposta'])){echo date("H:i",strtotime($res['prim_resposta']));}?>">
        			</div>
    				<div class="form-group col-md-3">
    					<label for="dthr_inic_tratativa"><strong>Inicio da Tratativa</strong></label>
    					<input type="datetime-local" class="form-control" id="dthr_inic_tratativa" name="dthr_inic_tratativa" value="<?php if(isset($res['dthr_inic_tratativa'])){echo date("Y-m-d\TH:i",strtotime($res['dthr_inic_tratativa']));}?>">
    				</div>
    				<div class="form-group col-md-3">
    					<label for="dthr_prim_report"><strong>Primeiro Report</strong></label>
    					<input type="datetime-local" class="form-control" id="dthr_prim_report" name="dthr_prim_report" value="<?php if(isset($res['dthr_prim_report'])){echo date("Y-m-d\TH:i",strtotime($res['dthr_prim_report']));}?>">
    				</div>
        		</div>
        		<div class="row justify-content-end">
        			<button type="button" class="btn btn-outline-success mx-2 my-2">Atualizar Ticket</button>
        			<button type="button" class="btn btn-outline-info mx-2 my-2">Novo Comentário</button>
        			<button type="button" class="btn btn-outline-danger mx-2 my-2">Encerrar Caso</button>
        		</div>
        		
    		</form>
    			<?php }?>
    		<hr>
    	</section> <!-- Fim da sessão detalhes -->
    	
    	<section id="escalacao">
    		<form>
    			<div class="form-row">
    				<div class="form-group col-md-6">
    					<label for="resolver_group">Resolver Group</label>
    					<input type="text" class="form-control" id="resolver_group" name="resolver_group" required>
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
    			<div class="row justify-content-end">
    				<button type="button" class="btn btn-outline-form mx-2 my-2">Iniciar nova escalação</button>
    		    	<button type="button" class="btn btn-outline-warning mx-2 my-2">Atualizar escalação</button>
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
            			<?php foreach ($escalacao->loadByID($_GET['ticket_id']) as $res){?>
            				<tr>
            					<td scope="col"><?=$res['resolver_group']?></td>
            					<td scope="col">
            					<?php if($res['status'] === "1"){
            					    echo "Ativo";}
            					    else{"Inativo";}?></td>
            					<td scope="col">
        							<a class="btn btn-outline-success btn-circle" id="<?=$res['escalacao_id']?>" href="#">
        	            				<i class="fas fa-arrow-up" data-toggle="tooltip" data-placement="top" title="Carregar informações"></i>
        							</a>
        							<a class="btn btn-outline-danger btn-circle" href="#">
        	            				<i class="fas fa-times" data-toggle="tooltip" data-placement="top" title="Inativar escalação"></i>
        							</a>
        						</td>
            				</tr>
            			<?php }?>
            			</tbody>
            		</table>
    			</div>
    		</div>
    	</section>

	</div><!-- fim do container -->
	
</body>
</html>