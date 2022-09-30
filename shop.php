<?php include_once("header.php");?>

<section ng-controller="destaques-controller">

	<div class="container" id="destaque-produtos-container">

		<div id="destaque-produtos" class="owl-carousel owl-theme">

			<div class="item" ng-repeat="produto in produtos">
				<div class="row">

					<div class="col-sm-6 col-imagem">
					<a href="produto-{{produto.id_prod}}">
						<img src="img/produtos/{{produto.foto_principal}}" alt="{{produto.nome_prod_longo}}">
					</a>
					</div>
					<div class="col-sm-6 col-descricao">
						<h2>{{produto.nome_prod_longo}}</h2>
						<div class="box-valor">
							<div class="text-no-boleto text-arial-cinza">no boleto</div>
							<div class="text-por text-arial-cinza">por:</div>
							<div class="text-reais text-roxo">R$</div>
							<div class="text-valor text-roxo">{{produto.preco}}</div>
							<div class="text-valor-centavos text-roxo">,{{produto.centavos}}</div>
							<div class="text-parcelas text-arial-cinza">ou em até {{produto.parcelas}}x de R$ {{produto.parcela}}</div>
							<div class="text-total text-arial-cinza	">total a prazo R$ {{produto.total}}</div>	
						</div>
						<a href="carrinhoAdd-{{produto.id_prod}}" class="btn btn-comprar text-roxo"><i class="fa-solid fa-cart-shopping"></i>compre agora</a>
					</div>
				</div>

			</div>
			
		</div>

		<button type="button" id="btn-destaque-prev"><i class="fa-solid fa-angle-left"></i></button>
		<button type="button" id="btn-destaque-next"><i class="fa-solid fa-angle-right"></i></button>
		
	</div>

	<div id="promocoes" class="container">
		<div class="row">
			<div class="col-md-2">
				<div class="box-promocaos box-1">
					<p>escolha por desconto</p>
				</div>

			</div>
			<div class="col-md-10">
				<div class="row">
					<div class="col-md-3">
						<div class="box-promocaos">
							<div class="text-ate">até</div>
							<div class="text-numero">40</div>
							<div class="text-porcentagem">%</div>
							<div class="text-off">off</div>

						</div>
					</div>
					<div class="col-md-3">
						<div class="box-promocaos">
							<div class="text-ate">até</div>
							<div class="text-numero">60</div>
							<div class="text-porcentagem">%</div>
							<div class="text-off">off</div>
							
						</div>
					</div>
					<div class="col-md-3">
						<div class="box-promocaos">
							<div class="text-ate">até</div>
							<div class="text-numero">80</div>
							<div class="text-porcentagem">%</div>
							<div class="text-off">off</div>
							
						</div>
					</div>
					<div class="col-md-3">
						<div class="box-promocaos">
							<div class="text-ate">até</div>
							<div class="text-numero">85</div>
							<div class="text-porcentagem">%</div>
							<div class="text-off">off</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="mais-buscados" class="container">
		<div class="row text-center title-default-roxo">
			<h2>Os mais buscados</h2>
			<hr>
		</div>

		<div class="row">

			<div class="col-md-3" ng-repeat="produto in buscados">
				<div class="box-produto-info">
					<a href="produto-{{produto.id_prod}}">
						<img src="img/produtos/{{produto.foto_principal}}" alt="{{produto.nome_prod_longo}}" class="produto-img">
						<h3>{{produto.nome_prod_longo}}</h3>
						<div class="estrelas" data-score="{{produto.media}}"></div>
						<div class="text-qtd-reviews text-arial-cinza">({{produto.total_reviews}})</div>
						<div class="text-valor text-roxo">R$ {{produto.total}}</div>
						<div class="text-parcelado text-arial-cinza">{{produto.parcelas}}x de {{produto.parcela}} sem juros</div>
					</a>

				</div>
			</div>

		</div>

	</div>

</section>

<?php include_once("footer.php");?>

<script>
angular.module("shop", []).controller("destaques-controller", function($scope, $http){

	$scope.produtos = [];

	var initCarousel = function(){
		$("#destaque-produtos").owlCarousel({

		autoplay: 5000,
		items:1,
		singleItem: true,
		loop:true

		});

		var owl = $("#destaque-produtos");

		owl.owlCarousel();

		$('#btn-destaque-prev').on("click", function(){

		owl.trigger('prev.owl.carousel');

		});

		$('#btn-destaque-next').on("click", function(){

		owl.trigger('next.owl.carousel');

		});
	};

	$http({
		method:'GET',
		url: 'produtos'
	}).then(function successCallBack(response){
		$scope.produtos = response.data;

		setTimeout(initCarousel, 1000);

	}, function errorCallBack(response){

	});

	var initEstrelas = function(){

		$('.estrelas').each(function(){

			$(this).raty({
			starHalf : 'lib/raty/lib/images/star-half.png',
			starOff  : 'lib/raty/lib/images/star-off.png',
			starOn   : 'lib/raty/lib/images/star-on.png',
			score    : parseFloat($(this).data("score"))
			});
		});
	};
	
	$http({
	  method: 'GET',
	  url: 'produtos-mais-buscados'
	}).then(function successCallback(response) {

	    $scope.buscados = response.data;

		setTimeout(initEstrelas, 1000);

	  }, function errorCallback(response) {
		
	  });
	

});

</script>
