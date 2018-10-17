<!doctype html>
<html lang="pt-br">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="icon" href="img/IT_logo_yellow.png">

<!-- Bootstrap CSS -->
<link rel="stylesheet" type="text/css"
	href="bootstrap/css/bootstrap.min.css">
<!-- Material Design -->
<link rel="stylesheet" type="text/css"
	href="material/iconfont/material-icons.css">
<!-- Estilo personalizado -->
<link rel="stylesheet" type="text/css" href="css/estilo.css">

<title>IT Services - Portal do PES</title>
</head>
<body>
    <!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-topo">
		<div class="container">
			<a href="#" class="navbar-brand"><img alt="IT Solutions" src="img/IT_logo.png" width="80"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
            <div class="collapse navbar-collapse" id="navbarContent">
            	<ul class="navbar-nav">
            		<li class="nav-item"><a class="link-topo nav-link" href="#">Formulário</a></li>
            		<li class="nav-item"><a class="nav-link link-topo" href="#">Sobre o PES</a></li>
            		<li class="nav-item"><a class="nav-link link-topo" href="#">Links Uteis</a></li>
            	</ul>
    	        <form class="form-inline my-2 my-lg-0 ">
        		    <input class="form-control mr-sm-2" type="search" placeholder="Buscar Ticket" aria-label="Search">
            		<button class="btn btn-outline-topo my-2 my-sm-0" type="submit">Buscar</button>
            	</form>
            </div>
		</div>
	</nav>

	<!-- Introdução -->
	<div class="container container-topo">
		<h1>Serviço de Priorização e Escalação - PES IT</h1>
		<hr>
		Olá!<br><br>
		Este é o formulário do PES IT e permite registrar seu pedido de priorização ou escalação de chamados com as equipes de IT.<br><br>
		Por favor complete todos os campos obrigatorios e detalhe da maneira mais completa possível a situação que deseja reportar para podermos atuar com maior eficacia e resolver o seu problema com agilidade.<br><br>
		Todas as informações são obrigatorias.
		<hr>
	</div>

	<!-- Formulário -->
	<div class="container form-pes">
		<form>
			<div class="form-group">
				<label for="oneid">Informe o seu OneID:</label>
				<input type="number" class="form-control col-3" id="oneid" placeholder="OneID" required>
			</div>
			
			<div class="form-group">
				<label for="nome">Confirme o seu nome:</label>
				<input type="text" class="form-control col-6" id="nome" placeholder="Nome" required>
			</div>
			
			<div class="form-group">
				<label for="localidade">Confirme sua localidade:</label>
				<input type="text" class="form-control col-6" id="localidade" aria-describedby="localidadelHelp" placeholder="Localidade" required>
				<small id="localidadeHelp" class="form-text text-muted">ex.: Matriz, Itajaí, Santa Cruz do Sul, etc...</small>
			</div>
			
			<div class="form-group">
				<label for="email">Endereço de e-mail:</label>
				<input type="email" class="form-control col-6 " id="email" aria-describedby="emailHelp" placeholder="email@exemplo.com" required>
				<small id="emailHelp" class="form-text text-muted">Caso a falha a ser reportada seja no seu email, por favor forneça um endereço alternativo.</small>
			</div>
			
			<div class="form-group">
				<label for="telefone">Telefone para contato:</label>
				<input type="text" class="form-control col-6" id="telefone" placeholder="(21)00009500" required>
			</div>
			
			<div class="form-group">
				<label for="descricao">Descreva o impacto que este problema causa para o negócio:</label>
				<textarea class="form-control" id="descricao" rows="4" required></textarea>
			</div>
			
			Selecione o processo ou sistema impactado:<br>
			<select class="custom-select col-6">
				<option selected>Legal</option>
				<option value="1">Leaf</option>
				<option value="2">Outlook</option>
				<option value="3">Skype</option>
			</select><br>
			
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

	</div>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>