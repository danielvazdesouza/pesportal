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
	   require_once 'inc/topo.php';
	?>
	<!-- Introdução -->
	<div class="container container-topo">
		<h1 align="center">Serviço de Priorização e Escalação - PES IT</h1>
		<hr>
		Olá!<br><br>
		Este é o formulário do PES IT e permite registrar seu pedido de priorização ou escalação de chamados com as equipes de IT.<br><br>
		Por favor complete todos os campos obrigatorios e detalhe da maneira mais completa possível a situação que deseja reportar para podermos atuar com maior eficacia e resolver o seu problema com agilidade.<br><br>
		Todas as informações são obrigatorias.
		<hr>
	</div>

	<!-- Formulário -->
	<div class="container form-pes">
		<form method="get">
			<div class="form-group">
				<label for="oneid">Informe o seu OneID:</label>
				<input type="number" class="form-control col-sm-12 col-md-3" id="oneid" name="oneid" placeholder="OneID" required>
			</div>
			
			<div class="form-group">
				<label for="nome">Confirme o seu nome:</label>
				<input type="text" class="form-control col-sm-12 col-md-6" id="nome" name="nome" placeholder="Nome" required>
			</div>
			
			<div class="form-group">
				<label for="email">Endereço de e-mail:</label>
				<input type="email" class="form-control col-sm-12 col-md-6" id="email" name="email" aria-describedby="emailHelp" placeholder="email@exemplo.com" required>
				<small id="emailHelp" class="form-text text-muted">Caso a falha a ser reportada seja no seu email, por favor forneça um endereço alternativo.</small>
			</div>
			
			<div class="form-group">
				<label for="localidade">Confirme sua localidade:</label>
				<input type="text" class="form-control col-sm-12 col-md-6" id="localidade" name="localidade" aria-describedby="localidadelHelp" placeholder="Localidade" required>
				<small id="localidadeHelp" class="form-text text-muted">ex.: Matriz, Itajaí, Santa Cruz do Sul, etc...</small>
			</div>
			
			<div class="form-group">
				<label for="telefone">Telefone para contato:</label>
				<input type="text" class="form-control col-sm-12 col-md-6" id="telefone" name="telefone" placeholder="(21)00009500" required>
			</div>
			
			<div class="form-group">
    			Selecione a area impactada:<br>
    			<select class="custom-select col-sm-12 col-md-6" name="area">
    				<option selected>Operations</option>
    				<option value="1">Leaf</option>
    				<option value="2">Supply</option>
    				<option value="3">Delivery</option>
    			</select>
			</div>
			
			<div class="form-group">
				<label for="sistema">Sistema impactado</label>
				<input type="text" class="form-control col-sm-12 col-md-6" id="sistema" name="sistema" placeholder="Sistema" required>
			</div>
			
			<div class="form-group">
				<label for="descricao">Descreva o impacto que este problema causa para o negócio:</label>
				<textarea class="form-control" id="descricao" name="descricao" rows="4" required></textarea>
			</div>
			
			<br>Impacto para o negócio:<br>
			<div class="form-check">
				<input class="form-check-input" type="radio" name="impacto" id="baixo" value="baixo" checked>
				<label class="form-check-label" for="baixo">Baixo - Um usuário afetado e sem impacto para o negócio</label>
			</div>
			<div class="form-check">
				<input class="form-check-input" type="radio" name="impacto" id="medio" value="medio">
				<label class="form-check-label" for="medio">Médio - Multiplos usuários afetados e possível impacto para o negócio</label>
			</div>
			<div class="form-check">
				<input class="form-check-input" type="radio" name="impacto" id="alto" value="alto">
				<label class="form-check-label" for="alto">Alto - Área funcional parada ou real risco legal e/ou financeiro</label>
			</div>
			<br>
			<button type="submit" class="btn btn-outline-form mb-2">Enviar</button>
		</form>
		
<?php
    if(isset($_GET)){
        foreach ($_GET as $key => $value) {
            echo "Nome do campo ". $key ."<br>";
            echo "Valor do campo ". $value;
            echo "<hr>";
        }
    }

?>
	</div>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>

