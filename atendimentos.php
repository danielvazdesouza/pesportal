<?php 
require_once 'dao/Ticket.php';
require_once 'dao/Comentario.php';
$tkt = new Ticket();
$coment = new Comentario();


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
		<h1>PES Portal - Atendimentos</h1>
		
		<section id="cardTickets">
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
            					<td><?=$res['nome']?></td>
            					<td><?=$res['prim_resposta']?></td>
            					<td><?=$res['dthr_ult_atualizacao']?></td>
            					<td>
            						<a href="detalhes.php?ticket_id=<?=$res['ticket_id']?>">
	            						<i class="fas fa-eye col-4" data-toggle="tooltip" data-placement="top" title="Visualizar detalhes"></i>
            						</a>
            						<a href="?atendimento=adicionarComentario&ticket_id=<?=$res['ticket_id']?>">
            							<i class="btn fas fa-plus col-4" data-toggle="tooltip" data-placement="top" title="Adicionar comentário"></i>
            						</a>
            						<a href="?atendimento=arquivar&ticket_id=<?=$res['ticket_id']?>">
	            						<i class="btn fas fa-archive col-3" data-toggle="tooltip" data-placement="top" title="Arquivar caso"></i>
            						</a>
            					</td>
            				</tr>
            				<?php }?>
            			</tbody>
            		</table>
    			</div><!-- fim do card-body -->
    		</div><!-- fim do card Atendimentos-->
		</section><!-- fim da sessão cardTickets -->
		
		<section id="cardComentarios">
    		<div class="card mb-3">
    			<div class="card-header bg-topo text-white">
    				<h6>Comentários Pendente</h6>
    			</div>
    			<div class="card-body">
            		<table class="table table-bordered table-striped"  id="tableComentarios">
            			<thead>
            				<tr>
            					<th>Ticket</th>
            					<th>Comentário</th>
            					<th>Nome</th>
            					<th>Publicado em:</th>
            					<th>Ação</th>
            				</tr>
            			</thead>
            			<tbody>
            			<?php foreach ($coment->loadUnread() as $res){?>
            				<tr>
            					<td><?=$res['ticket_id']?></td>
            					<td><?=$res['comentario']?></td>
            					<td><?=$res['nome']?></td>
            					<td><?=$res['dthr_publicacao']?></td>
            					<td>
            						<i class="btn fas fa-eye" data-toggle="tooltip" data-placement="top" title="Visualizar Comentário"></i>
            						<i class="btn fas fa-check" data-toggle="tooltip" data-placement="top" title="Aceitar Comentário"></i>
            					</td>
            				</tr>
            				<?php }?>
            			</tbody>
            		</table>			
    			</div>
    		</div>
		</section><!-- fim da sessão cardComentarios -->
		
	<div class="modal fade" id="novoComentario" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
            		<h5 class="modal-title">Novo Comentário</h5>
            		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span>
		            </button>
				</div>
				<form method="get">
					<div class="modal-body">
						<div class="form-group">
							<label for="oneid">Comentário:</label>
							<textarea class="form-control" id="comentario" name="comentario" rows="5" required></textarea>
						</div>
					</div>
					<div class="modal-footer">
                		<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                		<button type="submit" name="enviar" class="btn btn-primary">Salvar</button>
					</div>
				</form>
			</div>
		</div>
    </div>

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