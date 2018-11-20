<?php 

require_once 'dao/Ticket.php';

require_once 'dao/Comentario.php';

$ticket = new Ticket();
$comentario = new Comentario();

if(isset($_POST['enviar'])){
    if(isset($_POST)){
        $_POST['ticket_id'] = $_GET['ticket_id'];
         $comentario->insert($_POST);
    }
}

$ticket = new Ticket();

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
    
    <section id="comentarios">
    <?php if($comentario->hasComments($_GET['ticket_id'])){

        foreach ($comentario->loadByID($_GET['ticket_id']) as $res){?>
			<div class="card align-right mb-4">
            	<div class="card-header">
                	<i class="far fa-comment-dots"></i> <?=$res['nome']?> - <?=$res['dthr_publicacao']?>
				</div>
				<div class="card-body">
				<p>
					<?=$res['comentario']?>
				</p>
				</div>
			</div><!-- fim do card -->
	<?php  }//fim do foreach
        }//fim do if ?>
	</section>

	<section id="adicionar">
		<button type="button" class="btn btn-outline-form" data-toggle="modal" data-target="#novoComentario"><i class="fas fa-plus"> Adicionar Comentário</i></button>
	</section>
	
	</div><!-- fim do containers -->
	
	<!-- Footer -->
	<footer>
		<div class="footer">
		</div>	
	</footer>
	
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
							<label for="oneid">Informe o seu OneID:</label>
							<input type="number" class="form-control col-sm-12 col-md-6" id="oneid" name="oneid" placeholder="OneID" required>
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
	
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	
</body>
</html>