<?php
require_once 'inc/session.php';
if(!isset($_SESSION['oneid'])){
    header('location: /pesportal/login.php');
}

require_once 'dao/Manutencao.php';
$manutencao = new Manutencao();

if(isset($_GET['acao'])){
    switch ($_GET['acao']){
        case "exibir":
            $manutencao->setAsVisible($_GET['manutencao_id']);
            break;
        case "esconder":
            $manutencao->setAsInvisible($_GET['manutencao_id']);
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
	   
	   if(isset($_POST['atualizarManutencao'])){
	       $manutencao->update($_POST);
	       echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
	    <p align="center">Manutenção atualizado com sucesso!</p>
	    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	    </button>
	    </div>';
	   }
	   
	   if(isset($_POST['novaManutencao'])){
	       $manutencao->insert($_POST);
	       echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
	    <p align="center">Manutenção inserida com sucesso!</p>
	    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	    </button>
	    </div>';
	   }
	?>

	<div class="container">
		<h1 class="mt-4">Manutenções Programadas</h1>
		<hr>
		<div class="row justify-content-end">
			<button type="button" class="btn btn-outline-form" data-toggle="modal" data-target="#novaManutencao">Inserir Nova Manutenção</button>
		</div>
		
		<section id="tabelaManutencoes">
    		<table class="table table-bordered table-striped"  id="tableManutencoes">
    			<thead>
    				<tr>
    					<th>Descrição</th>
    					<th>Inicio</th>
    					<th>Fim</th>
    					<th>Localidade</th>
    					<th>Ação</th>
    				</tr>
    			</thead>
    			<tbody>
    			<?php foreach ($manutencao->loadAll() as $res){?>
    				<tr>
    					<td><?=$res['descricao']?></td>
    					<td><?=date("d/m/Y H:i",strtotime($res['dthr_inicio']))?></td>
						<td><?=date("d/m/Y H:i",strtotime($res['dthr_fim']))?></td>
    					<td><?=$res['localidade']?></td>
    					<td>
    					<?php if($res['exibir'] == 0){?>
    						<a class="btn btn-outline-success btn-circle" href="?acao=exibir&manutencao_id=<?=$res['manutencao_id']?>">
        						<i class="fas fa-eye" data-toggle="tooltip" data-placement="top" title="Tornar visivel na página inicial"></i>
    						</a>
    					<?php } else {?>
							<a class="btn btn-outline-danger btn-circle" href="?acao=esconder&manutencao_id=<?=$res['manutencao_id']?>">
        						<i class="fas fa-eye-slash" data-toggle="tooltip" data-placement="top" title="Tornar invisivel na página inicial"></i>
    						</a>
    					<?php }?>
    						<button class="btn btn-outline-warning btn-circle" data-toggle="modal" data-target="#editarManutencao"
								data-whatever="<?=$res['manutencao_id']?>"
								data-descricao="<?=$res['descricao']?>"
								data-inicio="<?=date("Y-m-d\TH:i",strtotime($res['dthr_inicio']))?>"
								data-fim="<?=date("Y-m-d\TH:i",strtotime($res['dthr_fim']))?>"
								data-localidade="<?=$res['localidade']?>"
								>
        						<i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Editar Manutenção"></i>
    						</button>
    					</td>
    				</tr>
    				<?php }?>
    			</tbody>
    		</table>
		</section><!-- fim da sessão tabelaInformativos -->
	</div><!-- fim do container -->
	
	<!-- Modal para editar manutenção -->
	<div class="modal fade" id="editarManutencao" tabindex="-1" role="dialog">
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
						<div class="form-group">
							<label for="descricao"><strong>Descrição:</strong></label>
							<input type="text" class="form-control" id="descricao" name="descricao" required>
						</div>
						<div class="row">
    						<div class="form-group col-md-3">
    							<label for="dthr_inicio"><strong>Inicio:</strong></label>
    							<input type="datetime-local" class="form-control" id="dthr_inicio" name="dthr_inicio" required>
    						</div>
    						<div class="form-group col-md-3">
    							<label for="dthr_fim"><strong>Fim:</strong></label>
    							<input type="datetime-local" class="form-control" id="dthr_fim" name="dthr_fim" required>
    						</div>
							<div class="form-group col-md-6">
    							<label for="localidade"><strong>Localidade:</strong></label>
    							<input type="text" class="form-control" id="localidade" name="localidade">
    						</div>
						</div>
					</div>
					<input type="hidden" name="manutencao_id" id="manutencao_id">
					<div class="modal-footer">
                		<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                		<button type="submit" name="atualizarManutencao" class="btn btn-primary">Atualizar</button>
					</div>
				</form>
			</div>
		</div>
    </div>

	<!-- Modal para incluir manutenção -->
	<div class="modal fade" id="novaManutencao" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
            		<h5 class="modal-title">Inserir nova manutenção</h5>
            		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span>
		            </button>
				</div>
				<form method="post">
					<div class="modal-body">
						<div class="form-group">
							<label for="descricao"><strong>Descrição:</strong></label>
							<input type="text" class="form-control" id="descricao" name="descricao" required>
						</div>
						<div class="row">
    						<div class="form-group col-md-3">
    							<label for="dthr_inicio"><strong>Inicio:</strong></label>
    							<input type="datetime-local" class="form-control" id="dthr_inicio" name="dthr_inicio" required>
    						</div>
    						<div class="form-group col-md-3">
    							<label for="dthr_fim"><strong>Fim:</strong></label>
    							<input type="datetime-local" class="form-control" id="dthr_fim" name="dthr_fim" required>
    						</div>
							<div class="form-group col-md-6">
    							<label for="localidade"><strong>Localidade:</strong></label>
    							<input type="text" class="form-control" id="localidade" name="localidade">
    						</div>
						</div>
					</div>
					<div class="modal-footer">
                		<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                		<button type="submit" name="novaManutencao" class="btn btn-primary">Salvar</button>
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
            $('#tableManutencoes').DataTable();
        } );
	</script>
	
	<script type="text/javascript">
		$('#editarManutencao').on('show.bs.modal',function(event){
			var button = $(event.relatedTarget)
			var recipient = button.data('whatever')
			var descricao = button.data('descricao')
			var dthr_inicio = button.data('inicio')
			var dthr_fim = button.data('fim')
			var localidade = button.data('localidade')
			var modal = $(this)
			modal.find('.modal-title').text('Editar Manutenção ' + recipient)
			modal.find('#manutencao_id').val(recipient)
			modal.find('#descricao').val(descricao)
			modal.find('#dthr_inicio').val(dthr_inicio)
			modal.find('#dthr_fim').val(dthr_fim)
			modal.find('#localidade').val(localidade)
		})
	</script>
	<?php require_once 'inc/rodape.php';?>
</body>
</html>