<style>
    /* estilos para hacer responsive la pagina */
    .nav-item a {
      display: block;
      padding: 10px 20px;
      margin: 5px;
      border: 2px solid transparent;
      border-radius: 5px;
      transition: all 0.3s ease;
      color: whitesmoke;
    }

    .nav-item a:hover {
      background-color: #044B34;
      color: white;
      border-color: #044B34;
    }

    .nav-item a:focus,
    .nav-item a:active {
      background-color: #0B5A41;
      color: white;
      border-color: #0B5A41;
    }

    .menu-toggle {
      display: none;
    }

    /* estilos para responsive en dispositivos moviles */
    @media (max-width: 992px) {
      .menu-toggle {
        display: block;
      }

      .nav-links {
        display: none;
        flex-direction: column;
        width: 100%;
      }

      .nav-links.show {
        display: flex;
      }
    }
  </style>
<body style="background-color: rgb(255, 255, 255)">
	<div class="titulo_principal">
		<h1>HAKUNA MATATA PETS</h1>
	</div>
	<header id="masthead" class="site-header header-main-wrapper d-flex justify-content-center">

		<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #0B5A41; border-radius: 10px">
			<div class="container-fluid">
			  <button class="navbar-toggler menu-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			  </button>
			  <div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav ms-auto nav-links">
				  <li class="nav-item">
					<a class="nav-link" href="index.php"><strong>INICIO</strong></a>
				  </li>
				  <li class="nav-item">
					<a class="nav-link" href="quienesomos.php"><strong>QUIÉNES SOMOS</strong></a>
				  </li>
				  <li class="nav-item">
					<a class="nav-link" href="servicios.php"><strong>SERVICIOS</strong></a>
				  </li>
				  </li>

          <?php if (!isset($_SESSION['usuario_id'])) { ?>    <!--verifica si el usuario ha iniciado sessión-->
				  <li class="nav-item">
					<a class="nav-link" href="registro.php"><strong>REGISTRO</strong></a>
				  </li>
				  </li>
				  <li class="nav-item">
					<a class="nav-link" href="ingreso.php"><strong>INGRESO</strong></a>
				  </li>
          <?php } ?>
          <?php 
          if (isset($_SESSION['usuario_id'])) { 
            include './db_connection.php';
            $id = $_SESSION['usuario_id'];
            $sql = "SELECT * FROM cliente WHERE ID_Cliente = '$id'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              $usuario = $result->fetch_assoc();
            }
            if ($usuario['rol'] == 'admin') {
            ?>
          <li class="nav-item">
					<a class="nav-link" href="perfil.php"><strong>PERFIL</strong></a>
				  </li>
				  <li class="nav-item">
					<a class="nav-link" href="cerrar_sesion.php"><strong>CERRAR SESION</strong></a>
				  </li>
          <li class="nav-item">
					<a class="nav-link" href="dashboard/index.php"><strong>DASHBOARD</strong></a>
				  </li>
          <?php } else { ?>
          <li class="nav-item">
					<a class="nav-link" href="perfil.php"><strong>PERFIL</strong></a>
				  </li>
				  <li class="nav-item">
					<a class="nav-link" href="cerrar_sesion.php"><strong>CERRAR SESION</strong></a>
				  </li>
          <?php } }?>
				</ul>
			  </div>
			</div>
		  </nav>
	</header>