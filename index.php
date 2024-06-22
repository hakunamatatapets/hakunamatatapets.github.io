<?php session_start(); ?>  <!--inicio de sesión con php -->
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>HAKUNA MATATA PETS</title>
	<link rel="stylesheet" href="CSS/style_inicio.css">
	<link rel="stylesheet" href="CSS/style_base.css"> 
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>

<?php include 'template/header.php'?>

	<!-- De acá hacia arriba NO TOCAR -->
	<br>
	<section class="container">
		<article class="articulo">
			<h2 class="subtitulo"><strong>BIENVENIDOS A HAKUNA MATATA PETS</strong></h2>
			<div class="imagen">
				<img src="IMAGENES/mascotas.jpg" width="400" alt="perros_y_gatos">
			</div>
			<p><b><i>
						<p>"El amor por todas las criaturas vivientes es el más noble tributo del ser humano"</p>
			</b></i></p>
			<p><b><i></i>
					<p>Charles Darwin</p></b></i></p>
		</article>
	</section>
	<br>
	<h2 class="subtitulo2">
		<p>Juntos creamos momentos de felicidad y bienestar para tus mascotas. </p>
	</h2>
	<br>

	<div class="container">
		<div class="servicio">
			<h3 class="etiqueta">Peluqueria</h3>
			<img src="IMAGENES/motiladaperrito.jpg" class="peluqueria" alt="">
		</div>
		<div class="servicio">
			<h3 class="etiqueta">Guarderia</h3>
			<img src="IMAGENES/abrazoperro.jpg" class="guarderia" alt="">
		</div>
		<div class="servicio">
			<h3 class="etiqueta">Paseador</h3>
			<img src="IMAGENES/paseo.jpg" class="paseador" alt="">
		</div>
		<div class="servicio">
			<h3 class="etiqueta">Todos son bienvenidos</h3>
			<img src="IMAGENES/regular.jpg" class="paseador" alt="">
		</div>
	</div>
	</section>
	<br>
	<h2 class="subtitulo3"><i>¡Únete a nuestra comunidad de amantes de los peluditos</h2></i>
	<h2 class="subtitulo3"><i>y descubre el encanto que ofrecemos en cada servicio!</h2></i>
	<br>
	<!-- De acá hacia abajo NO TOCAR -->
	
<?php include 'template/footer.php'?>