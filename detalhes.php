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
			<h1>Detalhes do Ticket: CH1234567</h1>
			<h6>Ultima atualização do PES: 23/08/2018 17:59</h6>
		</div>
		<hr>
	</header>
	
	<section id="detalhes">
		<label><strong>Nome: </strong>Daniel Souza (81256784)</label><br>
		<label><strong>E-mail: </strong>daniel_souza@souzacruz.com.br</label><br>
		<label><strong>Telefone: </strong>51980627078</label><br>
		<label><strong>Localidade: </strong>Interaction Center</label><br>
		<label><strong>Área Impactada: </strong>Leaf</label><br>
		<label><strong>Sistema: </strong>FDV</label><br>
		<label><strong>Descrição: </strong>Compra de fumo está parada devido a este problema</label><br>
		<label><strong>Impacto para o negócio: </strong>Alto</label><br>
		<hr>
	</section> <!-- Fim da sessão detalhes -->

	<section id="comentarios">
		<div class="card align-right">
			<div class="card-header">
				<i class="far fa-comment-dots"></i>
				PES IT - 23/08/2018 17:59
			</div>
			<div class="card-body">
				<p>
				Chamado escalado com a gerência da área, prazo de atendimento de até 5h.
				</p>
			</div>
		</div>
	</section><!-- fim da sessão comentário -->
	
	<section id="adicionar">
		<button type="button" class="btn btn-outline-form" data-toggle="modal" data-target="#novoComentario"><i class="fas fa-plus"> Adicionar Comentário</i></button>
	</section>
	
	</div><!-- fim do containers -->
	
	<!-- Footer -->
	<footer>
		<div class="footer">
		</div>	
	</footer>
	
    <div class="modal" id="novoComentario" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Novo Comentário</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post">
				<div class="form-group">
					<label for="oneid">Informe o seu OneID:</label>
					<input type="number" class="form-control col-sm-12 col-md-6" id="oneid" name="oneid" placeholder="OneID" required>
					<label for="oneid">Comentário:</label>
					<textarea class="form-control" id="descricao" name="descricao" rows="5" required></textarea>
				</div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary">Salvar</button>
          </div>
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