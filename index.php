<?php include_once('app/DB.class.php'); ?>
<!doctype html>
<html>
<head>
	<meta charset="UTF8" />
	<title>Notificações Facebook</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>
<body>
	<!--BARRA SUPERIOR-->
	<div id="bar">
		<div class="content">
			<ul class="nots">
				<li class="friends">Amizades</li>
				<li class="msgs">Mensagens</li>
				 
				<li class="notifs">Notificações

					<div class="ctnots">0</div> <!--/fim div ctnots-->
					
					<ul class="dp">
						<div class="arrow-down"></div>  <!--/fim div arrow-down-->

						<li class="titlenot">Notificações</li> 
					 	
					 	<div id="res"></div>
  
					</ul> <!--/fim ul.dp-->
				</li>
			</ul> <!--/fim ul.nots-->

		</div> <!--/fim div content-->
	</div> <!--/fim div bar-->
	<!--/FIM BARRA SUPERIOR-->

	<!--FORM ADD NOT-->
	<div class="content">
		<div class="boxform">
			 
				<select class="seluser" id="id_user"> 
					
					<?php 
						$users = DB::Conn()->query("SELECT * FROM tb_users ORDER BY id ASC");
						while($r = $users->fetch(PDO::FETCH_OBJ)){
					?>
					<option value="<?=$r->id?>">id[<?=$r->id?>] : <?=$r->nome?></option> 
					<?php } ?>
					  
				</select>

				<button class="addnot">Adicionar Nova Notificação</button>
			 
		</div> <!--/fim div boxform-->
	</div> <!--/fim div content-->
	<!--/FIM FORM ADD NOT-->
 	
 	<script type="text/javascript" src="assets/js/mod_xhr.js"></script>
 	<script type="text/javascript">
 		document.addEventListener('DOMContentLoaded', function(){
 			var icon_not = document.getElementsByClassName('notifs')[0],
 				dp 	 	 = document.getElementsByClassName('dp')[0],
 				btn_not  = document.getElementsByClassName('addnot')[0],
 				id_user  = document.getElementById('id_user'),
 				total_not= document.getElementsByClassName('ctnots')[0],
 				res 	 = document.getElementById('res');

 			icon_not.addEventListener('click', function(e){
 				e.stopPropagation();
 				dp.style.display = 'block';
 			});

 			document.addEventListener('click', function(){
 				dp.style.display = 'none';
 			});


 			btn_not.addEventListener('click', function(){
 				xhr.get('app/requests.php?acao=addnot&idu='+id_user.value, function(res){
 					alert(res);
 				});
 			});

 			window.setInterval(function(){
 				xhr.get('app/requests.php?acao=verificar', function(total){
	 				total_not.innerHTML = total;
	 			});
 			}, 1000);

 			window.setInterval(function(){
 				xhr.get('app/requests.php?acao=getnots', function(nots){
	 				res.innerHTML = nots;
	 			});
 			}, 1000);

 			res.addEventListener('click', function(e){
 				var elemento = e.target;

 				if(elemento.classList.contains('vis')){
 					xhr.get('app/requests.php?acao=vis&idnot='+elemento.id, function(res){
 						alert(res);
 					});
 				}
 			});
 			
 			
 		});
 	</script>
</body>
</html>