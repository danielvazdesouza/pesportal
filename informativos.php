<?php
require_once 'inc/session.php';
require_once 'dao/Informativo.php';
$informativo = new Informativo();

if(!isset($_SESSION['oneid'])){
    header("location: /pesportal/login.php");
}

if(isset($_GET['acao'])){
    switch ($_GET['acao']){
        case "exibir":
            $informativo->setAsVisible($_GET['informativos_id']);
            break;
        case "esconder":
            $informativo->setAsInvisible($_GET['informativos_id']);
            break;
    }
}

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
	   
	   if(isset($_POST['atualizarInformativo'])){
           $informativo->update($_POST);
           echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
    	    <p align="center">Informativo atualizado com sucesso!</p>
    	    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    	    <span aria-hidden="true">&times;</span>
    	    </button>
    	    </div>';
	   }
	   
	   if(isset($_POST['novoInformativo'])){
	       $informativo->insert($_POST);
	       echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        	    <p align="center">Informativo adicionado com sucesso!</p>
        	    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        	    <span aria-hidden="true">&times;</span>
        	    </button>
        	    </div>';
	   }
	?>

	<div class="container">
		<h1 class="mt-4">Informativos</h1>
		<hr>
		<div class="row justify-content-end mr-2">
			<button class="btn btn-outline-form" data-toggle="modal" data-target="#novoInformativo">Novo informativo</button>
		</div>
			
		<section id="tabelaInformativos">
    		<table class="table table-bordered table-striped"  id="tableInformativos">
    			<thead>
    				<tr>
    					<th>Titulo</th>
    					<th>Data Solicitação</th>
    					<th>Publico</th>
    					<th>Enviado</th>
    					<th>Ação</th>
    				</tr>
    			</thead>
    			<tbody>
    			<?php foreach ($informativo->loadAll() as $res){?>
    				<tr>
    					<td><?=$res['titulo']?></td>
    					<td><?=date("d/m/Y H:i",strtotime($res['dthr_solicitacao']))?></td>
    					<td><?=$res['destinatario']?></td>
    					<td><?=(isset($res['dthr_envio'])) ? "Sim" : "Não"?></td>
    					<td>
    					<?php if($res['exibir'] == 0){?>
    						<a class="btn btn-outline-success btn-circle" href="?acao=exibir&informativos_id=<?=$res['informativos_id']?>">
        						<i class="fas fa-eye" data-toggle="tooltip" data-placement="top" title="Tornar visivel na página inicial"></i>
    						</a>
    					<?php } else {?>
							<a class="btn btn-outline-danger btn-circle" href="?acao=esconder&informativos_id=<?=$res['informativos_id']?>">
        						<i class="fas fa-eye-slash" data-toggle="tooltip" data-placement="top" title="Tornar invisivel na página inicial"></i>
    						</a>
    					<?php }?>
    						<button class="btn btn-outline-warning btn-circle" data-toggle="modal" data-target="#editarInformativo"
								data-whatever="<?=$res['informativos_id']?>"
								data-titulo="<?=$res['titulo']?>"
								data-oneid="<?=$res['oneid']?>"
								data-solicitacao="<?=date("Y-m-d\TH:i",strtotime($res['dthr_solicitacao']))?>"
								data-envaprovacao="<?=(isset($res['dthr_env_aprovacao'])) ? date("Y-m-d\TH:i",strtotime($res['dthr_env_aprovacao'])) : ('')?>"
								data-envio="<?=(isset($res['dthr_envio'])) ? date("Y-m-d\TH:i",strtotime($res['dthr_envio'])) : ('')?>"
								data-aprovacao="<?=(isset($res['dthr_aprovacao'])) ? date("Y-m-d\TH:i",strtotime($res['dthr_aprovacao'])) : ('')?>"
								data-destinatario="<?=$res['destinatario']?>"
								data-categoria="<?=$res['categoria']?>"
								data-ticket="<?=$res['ticket']?>"
								>
        						<i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Editar Informativo"></i>
    						</button>
    					</td>
    				</tr>
    				<?php }?>
    			</tbody>
    		</table>
		</section><!-- fim da sessão tabelaInformativos -->
	</div><!-- fim do container -->
	
	<!-- Modal para editar informativo -->
	<div class="modal fade" id="editarInformativo" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
            		<h5 class="modal-title"></h5>
            		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span>
		            </button>
				</div>
				<form method="post">
					<div class="modal-body">
						<div class="row">
    						<div class="form-group col-md-8">
    							<label for="titulo">Titulo:</label>
    							<input type="text" class="form-control" id="titulo" name="titulo" required>
    						</div>
							<div class="form-group col-md-4">
    							<label for="oneid">Solicitante (OneID):</label>
    							<input type="number" class="form-control" id="oneid" name="oneid" required>
    						</div>
						</div>
						<div class="row">
    						<div class="form-group col-md-3">
    							<label for="dthr_solicitacao">Solicitação:</label>
    							<input type="datetime-local" class="form-control" id="dthr_solicitacao" name="dthr_solicitacao" required>
    						</div>
    						<div class="form-group col-md-3">
    							<label for="dthr_env_aprovacao">Envio para Aprovação:</label>
    							<input type="datetime-local" class="form-control" id="dthr_env_aprovacao" name="dthr_env_aprovacao">
    						</div>
    						<div class="form-group col-md-3">
    							<label for="dthr_envio">Envio:</label>
    							<input type="datetime-local" class="form-control" id="dthr_envio" name="dthr_envio">
    						</div>
    						<div class="form-group col-md-3">
    							<label for="dthr_aprovacao">Aprovação:</label>
    							<input type="datetime-local" class="form-control" id="dthr_aprovacao" name="dthr_aprovacao">
    						</div>
						</div>
						<div class="row">
    						<div class="form-group col-md-6">
    							<label for="destinatario">Destinatário:</label>
    							<input type="text" class="form-control" id="destinatario" name="destinatario">
    						</div>
    						<div class="form-group col-md-3">
    							<label for="categoria">Categoria:</label>
    							<input type="text" class="form-control" id="categoria" name="categoria">
    						</div>
    						<div class="form-group col-md-3">
    							<label for="ticket">Ticket:</label>
    							<input type="text" class="form-control" id="ticket" name="ticket">
    						</div>
						</div>
					</div>
					<input type="hidden" name="informativos_id" id="informativos_id">
					<div class="modal-footer">
                		<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                		<button type="submit" name="atualizarInformativo" class="btn btn-primary">Salvar</button>
					</div>
				</form>
			</div>
		</div>
    </div>
	
	<!-- Modal para adicionar Informativo -->
	<div class="modal fade" id="novoInformativo" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
            		<h5 class="modal-title">Inserir novo informativo</h5>
            		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span>
		            </button>
				</div>
				<form method="post">
					<div class="modal-body">
						<div class="row">
    						<div class="form-group col-md-8">
    							<label for="titulo">Titulo:</label>
    							<input type="text" class="form-control" id="titulo" name="titulo" required>
    						</div>
							<div class="form-group col-md-4">
    							<label for="oneid">Solicitante (OneID):</label>
    							<input type="number" class="form-control" id="oneid" name="oneid" required>
    						</div>
						</div>
						<div class="row">
    						<div class="form-group col-md-3">
    							<label for="dthr_solicitacao">Solicitação:</label>
    							<input type="datetime-local" class="form-control" id="dthr_solicitacao" name="dthr_solicitacao" required>
    						</div>
    						<div class="form-group col-md-3">
    							<label for="dthr_env_aprovacao">Envio para Aprovação:</label>
    							<input type="datetime-local" class="form-control" id="dthr_env_aprovacao" name="dthr_env_aprovacao">
    						</div>
    						<div class="form-group col-md-3">
    							<label for="dthr_envio">Envio:</label>
    							<input type="datetime-local" class="form-control" id="dthr_envio" name="dthr_envio">
    						</div>
    						<div class="form-group col-md-3">
    							<label for="dthr_aprovacao">Aprovação:</label>
    							<input type="datetime-local" class="form-control" id="dthr_aprovacao" name="dthr_aprovacao">
    						</div>
						</div>
						<div class="row">
    						<div class="form-group col-md-6">
    							<label for="destinatario">Destinatário:</label>
    							<input type="text" class="form-control" id="destinatario" name="destinatario">
    						</div>
    						<div class="form-group col-md-3">
    							<label for="categoria">Categoria:</label>
    							<input type="text" class="form-control" id="categoria" name="categoria">
    						</div>
    						<div class="form-group col-md-3">
    							<label for="ticket">Ticket:</label>
    							<input type="text" class="form-control" id="ticket" name="ticket">
    						</div>
						</div>
					</div>
					<div class="modal-footer">
                		<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                		<button type="submit" name="novoInformativo" class="btn btn-primary">Salvar</button>
					</div>
				</form>
			</div>
		</div>
    </div>
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="datatables/datatables.min.js"></script>
	
	<script type="text/javascript">
        $(document).ready( function () {
            $('#tableInformativos').DataTable();
        } );
	</script>
	
	<script type="text/javascript">
		$('#editarInformativo').on('show.bs.modal',function(event){
			var button = $(event.relatedTarget)
			var recipient = button.data('whatever')
			var titulo = button.data('titulo')
			var oneid = button.data('oneid')
			var dthr_solicitacao = button.data('solicitacao')
			var dthr_env_aprovacao = button.data('envaprovacao')
			var dthr_envio = button.data('envio')
			var dthr_aprovacao = button.data('aprovacao')
			var destinatario = button.data('destinatario')
			var categoria = button.data('categoria')
			var ticket = button.data('ticket')
			var modal = $(this)
			modal.find('.modal-title').text('Editar Informativo ' + recipient)
			modal.find('#informativos_id').val(recipient)
			modal.find('#titulo').val(titulo)
			modal.find('#oneid').val(oneid)
			modal.find('#dthr_solicitacao').val(dthr_solicitacao)
			modal.find('#dthr_env_aprovacao').val(dthr_env_aprovacao)
			modal.find('#dthr_envio').val(dthr_envio)
			modal.find('#dthr_aprovacao').val(dthr_aprovacao)
			modal.find('#destinatario').val(destinatario)
			modal.find('#categoria').val(categoria)
			modal.find('#ticket').val(ticket)
		})
	</script>
	
</body>
</html>