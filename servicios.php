<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>HAKUNA MATATA PETS</title>
  <link rel="stylesheet" href="CSS/style_servicios.css" />
  <link rel="stylesheet" href="CSS/style_base.css" />
  <link rel="stylesheet" href="CSS/estilo_board.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>
  <?php include 'template/header.php'?>
  <!-- De acá hacia arriba NO TOCAR, espacio para comenzar a editar -->
  <main>
    <br>
    <h1 class="titulo5">Nuestros Servicios</h1>
    <div class="container">
      <div class="servicio" id="guarderia">
        <h3 class="etiqueta">Guarderia</h3>
        <img src="/proyecto/IMAGENES/abrazoperro.jpg" class="guarderia" alt="">
      </div>
      <div class="servicio" id="peluqueria">
        <h3 class="etiqueta">Peluqueria</h3>
        <img src="/proyecto/IMAGENES/motiladaperrito.jpg" class="peluqueria">
      </div>
      <div class="servicio" id="paseos">
        <h3 class="etiqueta">Paseos</h3>
        <img src="/proyecto/IMAGENES/paseo.jpg" class="paseador" alt="">
      </div>
    </div>
    <div id="servicioGuarderia">
      <article>
        <section>
          <div class="titulo2">
            <h1><strong>GUARDERIA</strong></h1>
          </div>
          <div class="container">
            <div class="row">
              <div class="col-md-6">
                <p>
                  Una guardería canina ofrece beneficios significativos para perros y dueños.
                  Proporciona un entorno seguro y enriquecedor para la socialización canina, lo que reduce la ansiedad y
                  el estrés.Para los dueños, garantiza que sus mascotas estén bien cuidadas durante su ausencia,
                  brindando tranquilidad y liberando tiempo para cumplir con sus responsabilidades.
                </p>
                <br />
                <button class="agendar">AGENDAR CITA</button>
              </div>
              <div class="col-md-6">
                <img src="/proyecto/IMAGENES/abrazoperro.jpg" alt="Imagen" class="img-fluid">
              </div>
            </div>
          </div>
        </section>
      </article>
    </div>
    <div id="servicioPeluqueria">
      <section>
        <article>
          <div class="titulo1">
            <h1><strong>SERVICIOS DE PELUQUERÍA</strong></h1>
          </div>
          <div class="parrafo1">
            <p>
              <strong>Te ofrecemos un servicio de peluquería especializado, con un
                equipo de profesionales altamente capacitado</strong>
            </p>
          </div>
        </article>
      </section>
      <section>
        <article>
          <div class="container">
            <div class="row">
              <div class="col-md-3">
                <div class="imgpeluqueria">
                  <img src="/proyecto/IMAGENES/motiladaperrito.jpg" alt="Imagen" class="imagen">
                </div>
                <h3 class="text-center">BAÑO FULL</h3>
                <p>
                  Agradable baño de espuma con Shampoo y Acondicionador<br />
                  Corte de uñas<br />
                  Secado<br />
                  Limpieza de oídos<br />
                  Corte según la raza o indicación
                </p>
              </div>
              <div class="col-md-3">
                <div class="imgpeluqueria">
                  <img src="/proyecto/IMAGENES/regular.jpg" alt="Imagen" class="imagen">
                </div>
                <h3 class="text-center">BAÑO REGULAR</h3>
                <p>
                  Agradable baño de espumas con Shampoo y Acondicionadora.<br />
                  Corte de uñas<br />
                  Secado<br />
                  Limpieza de oídos
                </p>
              </div>
              <div class="col-md-3">
                <div class="imgpeluqueria">
                  <img src="/proyecto/IMAGENES/uñas.jpg" alt="Imagen" class="imagen">
                </div>
                <h3 class="text-center">CORTE DE UÑAS</h3>
                <p>Corte de uñas de la mascota</p>
              </div>
              <div class="col-md-3">
                <div class="imgpeluqueria">
                  <img src="/proyecto/IMAGENES/oidos.jpg" alt="Imagen" class="imagen">
                </div>
                <h3 class="text-center">LIMPIEZA DE OIDOS</h3>
                <p>Limpieza de oídos de la mascota</p>
              </div>
            </div>
          </div>
          <button class="agendar">AGENDAR CITA</button>
        </article>
      </section>
    </div>
    <div id="servicioPaseos">
      <article>
        <section>
          <div class="titulo2">
            <h1><strong> PASEO DE PERROS</strong></h1>
          </div>
          <div class="container">
            <div class="row">
              <div class="col-md-6">
                <p>
                  Los paseos de perros son esenciales para su bienestar físico y mental.
                  No solo satisfacen sus necesidades de ejercicio, sino que también les
                  proporcionan estimulación sensorial, socialización y un vínculo más
                  fuerte. Cada paso es una oportunidad para explorar,
                  aprender y compartir momentos inolvidables.
                </p>
                <br />
                <button class="agendar">AGENDAR CITA</button>
              </div>
              <div class="col-md-6">
                <img src="/proyecto/IMAGENES/paseo.jpg" alt="Imagen" class="img-fluid">
              </div>
            </div>
          </div>
        </section>
      </article>
    </div>
    <div id="modal" class="modalf">
      <div class="modalf-content">
        <span class="cerrar">&times;</span>
        <?php include 'PHP/crear.php'; ?>
      </div>
    </div>
  </main>
  <br />
  <div class="notificacion" id="notificacion">
    ¡Necesitas estar registrado para agendar una cita!
  </div>
  <script src="scripts/script.js"></script>
  <!-- De acá hacia abajo NO TOCAR -->
  <?php include 'template/footer.php'?>