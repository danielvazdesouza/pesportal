<?php
require_once 'inc/session.php';
if(!isset($_SESSION['oneid'])){
    header("location: /pesportal/login.php");
}

require_once 'dao/Ticket.php';
require_once 'dao/Escalacao.php';
require_once 'dao/Comentario.php';
$ticket = new Ticket();
$escalacao = new Escalacao();
$comentario = new Comentario();


$_POST['ticket_id'] = $_GET['ticket_id'];
$_POST['oneid'] = $_SESSION['oneid'];

if(isset($_GET['escalacao_id'])){
    $esc = $escalacao->loadByID($_GET['escalacao_id']);
}
?>
<!doctype html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<link rel="icon" href="img/IT_logo_yellow.png">
<?php 
    require_once 'inc/config.php';
?>

<title>IT Services - Portal do PES</title>
</head>
<body>
	<!-- Navbar -->
	<?php 
	   require_once 'inc/topo_admin.php';

	   if(isset($_POST['atualizarTicket'])){
	       $ticket->update($_POST);
	       echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
	    <p align="center">Informações do ticket '.$_POST['ticket_id'].' atualizadas com sucesso!</p>
	    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	    </button>
	    </div>';
	   }
	   
	   if(isset($_POST['novoComentario'])){
	       $comentario->insert($_POST);
	       echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
	    <p align="center">Comentário adicionado com sucesso!</p>
	    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	    </button>
	    </div>';
	   }
	   
	   if(isset($_POST['novaEscalacao'])){
	       $escalacao->insert($_POST);
	       echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
	    <p align="center">Escalação inserida com sucesso!</p>
	    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	    </button>
	    </div>';
	   }
	   
	   if(isset($_POST['atualizarEscalacao'])){
	       $_POST['escalacao_id'] = $_GET['escalacao_id'];
	       $escalacao->update($_POST);
	       echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
	    <p align="center">Escalação atualizada com sucesso!</p>
	    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	    </button>
	    </div>';
	   }
	   
	   if (isset($_POST['arquivar'])) {
	       $ticket->archive($_POST['ticket_id']);
	       echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
	    <p align="center">Ticket '.$_POST['ticket_id'].' arquivado com sucesso!</p>
	    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	    </button>
	    </div>';
	   }
	   
	   if (isset($_POST['inativar'])) {
	       $escalacao->setAsInactive($_POST['escalacao_id']);
	       echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
	    <p align="center">Escalação com '.$_POST['resolver_group'].' encerrada!</p>
	    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	    </button>
	    </div>';
	   }
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
    		<form class="form" method="post">
    			<div class="row">
        			<div class="form-group col-md-3">
        				<label for="origem"><strong>Origem: </strong></label>
        				<input type="text" class="form-control" name="origem" value="<?=$res['origem']?>" required>
        			</div>
        			<div class="form-group col-md-3">
        				<label for="prim_resposta"><strong>Primeira Resposta:</strong></label>
        				<input type="time" class="form-control" name="prim_resposta" value="<?php if(isset($res['prim_resposta'])){echo date("H:i",strtotime($res['prim_resposta']));}?>" required>
        			</div>
    				<div class="form-group col-md-3">
    					<label for="dthr_inic_tratativa"><strong>Inicio da Tratativa</strong></label>
    					<input type="datetime-local" class="form-control" id="dthr_inic_tratativa" name="dthr_inic_tratativa" value="<?php if(isset($res['dthr_inic_tratativa'])){echo date("Y-m-d\TH:i",strtotime($res['dthr_inic_tratativa']));}?>" required>
    				</div>
    				<div class="form-group col-md-3">
    					<label for="dthr_prim_report"><strong>Primeiro Report</strong></label>
    					<input type="datetime-local" class="form-control" id="dthr_prim_report" name="dthr_prim_report" value="<?php if(isset($res['dthr_prim_report'])){echo date("Y-m-d\TH:i",strtotime($res['dthr_prim_report']));}?>" required>
    				</div>
        		</div>
        		<div class="row justify-content-end">
        			<button type="submit" name="atualizarTicket" class="btn btn-outline-success mx-2 my-2">Atualizar Ticket</button>
        			<button type="button" class="btn btn-outline-info mx-2 my-2" data-toggle="modal" data-target="#novoComentario">Novo Comentário</button>
        			<button type="button" class="btn btn-outline-danger mx-2 my-2" data-toggle="modal" data-target="#archive" data-whatever="<?=$res['ticket_id']?>">Encerrar Caso</button>
        		</div>
    		</form>
    			<?php }?>
    		<hr>
    	</section> <!-- Fim da sessão detalhes -->
    	
    	<section id="escalacao">
    		<form class="form" method="post">
    			<div class="form-row">
    				<div class="form-group col-md-6">
    					<label for="resolver_group">Resolver Group</label>
    					<input type="text" class="form-control" id="resolver_group" name="resolver_group" value="<?=(isset($esc['resolver_group'])) ? ($esc['resolver_group']): ('')?>" required>
    				</div>
    			</div>
    			<div class="form-row">
    				<div class="form-group col-md-3">
    					<label for="dthr_priorizacao">Priorização</label>
    					<input type="datetime-local" class="form-control" id="dthr_priorizacao" name="dthr_priorizacao" value="<?php if(isset($esc['dthr_priorizacao'])){echo date("Y-m-d\TH:i",strtotime($esc['dthr_priorizacao']));}?>">
    				</div>
    				<div class="form-group col-md-3">
    					<label for="dthr_pri_escalacao">1° Escalação</label>
    					<input type="datetime-local" class="form-control" id="dthr_pri_escalacao" name="dthr_pri_escalacao" value="<?php if(isset($esc['dthr_pri_escalacao'])){echo date("Y-m-d\TH:i",strtotime($esc['dthr_pri_escalacao']));}?>">
    				</div>
					<div class="form-group col-md-3">
    					<label for="dthr_seg_escalacao">2° Escalação</label>
    					<input type="datetime-local" class="form-control" id="dthr_seg_escalacao" name="dthr_seg_escalacao" value="<?php if(isset($esc['dthr_seg_escalacao'])){echo date("Y-m-d\TH:i",strtotime($esc['dthr_seg_escalacao']));}?>">
    				</div>
					<div class="form-group col-md-3">
    					<label for="dthr_ter_escalacao">3° Escalação</label>
    					<input type="datetime-local" class="form-control" id="dthr_ter_escalacao" name="dthr_ter_escalacao" value="<?php if(isset($esc['dthr_ter_escalacao'])){echo date("Y-m-d\TH:i",strtotime($esc['dthr_ter_escalacao']));}?>">
    				</div>
    			</div>
    			<div class="row justify-content-end">
    				<button type="submit" name="novaEscalacao" class="btn btn-outline-form mx-2 my-2">Iniciar nova escalação</button>
    		    	<button type="submit" name="atualizarEscalacao" class="btn btn-outline-warning mx-2 my-2">Atualizar escalação</button>
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
            			<?php foreach ($escalacao->loadByTicketID($_GET['ticket_id']) as $res){?>
            				<tr>
            					<td scope="col"><?=$res['resolver_group']?></td>
            					<td scope="col">
            					<?php if($res['status'] === "1"){
            					    echo "Ativo";}
            					    else{ echo "Inativo";}?></td>
            					<td scope="col">
        							<a class="btn btn-outline-success btn-circle" id="<?=$res['escalacao_id']?>" href="?ticket_id=<?=$res['ticket_id']?>&escalacao_id=<?=$res['escalacao_id']?>">
        	            				<i class="fas fa-arrow-up" data-toggle="tooltip" data-placement="top" title="Carregar informações"></i>
        							</a>
        							<button type="button" class="btn btn-outline-danger btn-circle" data-toggle="modal" data-target="#inativar" data-whatever="<?=$res['escalacao_id']?>" data-rg="<?=$res['resolver_group']?>">
        								<i class="fas fa-times" data-toggle="tooltip" data-placement="top" title="Inativar escalação"></i>
        							</button>
        						</td>
            				</tr>
            			<?php }?>
            			</tbody>
            		</table>
    			</div>
    		</div>
    	</section>
    	
    	<section id="addComentario">
			<div class="modal fade" id="novoComentario" tabindex="-1" role="dialog">
        		<div class="modal-dialog" role="document">
        			<div class="modal-content">
        				<div class="modal-header">
                    		<h5 class="modal-title">Novo Comentário</h5>
                    		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      		<span aria-hidden="true">&times;</span>
        		            </button>
        				</div>
        				<form method="post">
        					<div class="modal-body">
        						<div class="form-group">
        							<label for="comentario">Comentário:</label>
        							<textarea class="form-control" id="comentario" name="comentario" rows="5" maxlength="254" required></textarea>
        						</div>
        					</div>
        					<div class="modal-footer">
                        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        		<button type="submit" name="novoComentario" class="btn btn-primary">Salvar</button>
        					</div>
        				</form>
        			</div>
        		</div>
            </div>
    	</section>

	</div><!-- fim do container -->
	
	<!-- Modal para arquivar ticket -->
    <div class="modal fade" id="archive" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
            		<h5 class="modal-title"></h5>
            		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span>
		            </button>
				</div>
				<form method="post">
					<input type="hidden" name="ticket_id" id="ticket_id">
					<div class="modal-footer">
                		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                		<button type="submit" name="arquivar" class="btn btn-primary">Arquivar</button>
					</div>
				</form>
			</div>
		</div>
    </div>
    
	<!-- Modal para inativar escalação -->
    <div class="modal fade" id="inativar" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
            		<h5 class="modal-title"></h5>
            		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span>
		            </button>
				</div>
				<form method="post">
					<input type="hidden" name="escalacao_id" id="escalacao_id">
					<input type="hidden" name="resolver_group" id="resolver_group">
					<div class="modal-footer">
                		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                		<button type="submit" name="inativar" class="btn btn-primary">Encerrar</button>
					</div>
				</form>
			</div>
		</div>
    </div>
	
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	
	<script type="text/javascript">
		$('#archive').on('show.bs.modal',function(event){
			var button = $(event.relatedTarget)
			var recipient = button.data('whatever')
			var modal = $(this)
			modal.find('.modal-title').text('Deseja arquivar o ticket ' + recipient + '?')
			modal.find('#ticket_id').val(recipient)
		})
	</script>
	
	<script type="text/javascript">
		$('#inativar').on('show.bs.modal',function(event){
			var button = $(event.relatedTarget)
			var recipient = button.data('whatever')
			var resolver_group = button.data('rg')
			var modal = $(this)
			modal.find('.modal-title').text('Deseja arquivar a escalação com ' + resolver_group + '?')
			modal.find('#escalacao_id').val(recipient)
			modal.find('#resolver_group').val(resolver_group)
		})
	</script>
	
</body>
</html>