<?php
  $conexion = new mysqli("localhost", "root", "", "clinica");

  if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>MedVida - Citas</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- icon -->
  <link href="assets/img/hospital.png" rel="icon">
  <link href="assets/img/hospital.png" rel="apple-touch-icon">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope"></i> <a href="mailto:contact@example.com">contact@contact.com</a>
        <i class="bi bi-phone"></i> +502 5555-5555
      </div>
      <div class="d-none d-lg-flex social-links align-items-center">
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
    </div>
  </div>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="index.html">MedVida</a></h1>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto" href="index.html">Home</a></li>
          <li><a class="nav-link scrollto active" href="citas.php">Citas</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <!-- <a href="#appointment" class="appointment-btn scrollto"><span class="d-none d-md-inline">Make an</span> Appointment</a> -->

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      
    </section> <!--  End Breadcrumbs Section -->

    <!-- ======= Appointment Section ======= -->
    <section id="appointment" class="appointment section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Agenda una Cita</h2>
        </div>

        <form action="#" name="ejemplo" method="post">

          <div class="row">
              <div class="col-md-4 form-group">
                <input type="text" name="nombrePaciente" class="form-control" id="name" placeholder="Nombre" data-rule="minlen:4" data-msg="Por favor ingresa al menos 4 caracteres" required>
                <div class="validate"></div>
              </div>
              <div class="col-md-4 form-group mt-3 mt-md-0">
                <input type="email" class="form-control" name="correoPaciente" id="email" placeholder="Email" data-rule="email" data-msg="Por favor ingresa un email válido" required>
                <div class="validate"></div>
              </div>
              <div class="col-md-4 form-group mt-3 mt-md-0">
                <input type="tel" class="form-control" name="telefonoPaciente" id="phone" placeholder="Celular" data-rule="minlen:4" data-msg="Por favor ingresa al menos 4 caracteres" required>
                <div class="validate"></div>
              </div>
          </div>

          <div class="row">
            <div class="col-md-4 form-group mt-3">
              <input type="text" name="fechaCita" class="form-control datepicker" id="date" placeholder="Fecha" data-rule="minlen:4" data-msg="Por favor ingresa la fecha" required>
              <div class="validate"></div>
            </div>

            <div class="col-md-4 form-group mt-3">
              <input type="time" name="horaCita" class="form-control" id="hora" placeholder="Hora" data-rule="minlen:4" min="08:00" max="16:00" data-msg="Por favor ingresa la hora" required>
              <div class="validate"></div>
            </div>
            <div class="col-md-4 form-group mt-3">
              <select name="nombreEspecialidad" id="especialidad" class="form-select" required>
                <option selected disabled value="">--Seleccionar Especialidad--</option>
                <?php
                  $query = "SELECT nombreEspecialidad FROM especialidad";
                  $result = $conexion->query($query);

                  while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['nombreEspecialidad'] . '">' . $row['nombreEspecialidad'] . '</option>';
                  }
                ?>
              </select>
              <div class="validate"></div>
            </div>
            
          </div>

          <div class="row">


          <div class="col-md-4 form-group mt-3">
              <select name="nombreDoctor" id="doctor" class="form-select" required>
                <option selected disabled value="">--Seleccionar Doctor--</option>
                <?php
                  $query = "SELECT nombreDoctor FROM doctor";
                  $result = $conexion->query($query);

                  while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['nombreDoctor'] . '">' . $row['nombreDoctor'] . '</option>';
                  }
                ?>
              </select>
              <div class="validate"></div>
            </div>

            <div class="col-md-4 form-group mt-3">
              <select name="nombreModalidad" id="modalidad" class="form-select" required>
                <option selected disabled value="">--Seleccionar Modalidad--</option>
                <?php
                  $query = "SELECT nombreModalidad FROM modalidad";
                  $result = $conexion->query($query);

                  while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['nombreModalidad'] . '">' . $row['nombreModalidad'] . '</option>';
                  }
                ?>
              </select>
              <div class="validate"></div>
            </div>
          </div>

          <div class="form-group mt-3">
            <textarea class="form-control" name="mensaje" rows="4" placeholder="Mensaje (Opcional)"></textarea>
            <div class="validate"></div>
          </div>

          <div class="mb-3">
              
          </div>
          <div class="text-center"><button class="btn-form" type="submit" name="registro">Agregar Cita</button></div>
        </form>

      </div>
    </section><!-- End Appointment Section -->

  </main><!-- End #main -->


  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>MedVida</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          <a>Designed by Kevin Solares</a>
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->


  <!-- <div id="preloader"></div> -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- para datepicker -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/i18n/jquery.ui.datepicker-es.js"></script>

  <!-- para alertas -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="sweetAlert.js"></script>
  
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  
  <!-- para datepicker -->
  <script>
    $(function() {
      $.datepicker.regional['es'] = {
      closeText: 'Cerrar',
      prevText: '<Ant',
      nextText: 'Sig>',
      currentText: 'Hoy',
      monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
      dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
      dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
      dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
      weekHeader: 'Sm',
      dateFormat: 'yy/mm/dd',
      firstDay: 1,
      isRTL: false,
      showMonthAfterYear: false,
      yearSuffix: ''
    };

      $.datepicker.setDefaults($.datepicker.regional['es']);

      function disableSundays(date) {
      return [date.getDay() !== 0, ''];
      }

      $(".datepicker").datepicker({
        minDate: 0,
        beforeShowDay: disableSundays
      });
    });
  </script>


</body>

</html>

<?php
  if(isset($_POST['registro'])){
    $nombrePaciente = $_POST ['nombrePaciente'];
    $correoPaciente = $_POST ['correoPaciente'];
    $telefonoPaciente = $_POST ['telefonoPaciente'];
    $fechaCita = $_POST ['fechaCita'];
    $horaCita = $_POST ['horaCita'];
    $nombreEspecialidad = $_POST ['nombreEspecialidad'];
    $nombreDoctor = $_POST ['nombreDoctor'];
    $nombreModalidad = $_POST ['nombreModalidad'];
    $mensaje = $_POST ['mensaje'];

    // Verifica si la fecha es válida
    if (strtotime($fechaCita) !== false) {
        // La fecha es válida, ahora puedes formatearla en el formato de MySQL 'YYYY-MM-DD'
        $fechaCita = date('Y-m-d', strtotime($fechaCita));

        // Combina la fecha y la hora en un formato de fecha y hora de MySQL
        $fechaHoraCita = $fechaCita . ' ' . $horaCita;
        $fechaHoraCitaMySQL = date('Y-m-d H:i:s', strtotime($fechaHoraCita));
        
        $insertarDatos = "INSERT INTO citas (nombrePaciente, correoPaciente, telefonoPaciente, fechaCita, horaCita, nombreEspecialidad, nombreDoctor, nombreModalidad, mensaje) VALUES ('$nombrePaciente', '$correoPaciente', '$telefonoPaciente', '$fechaCita', '$fechaHoraCitaMySQL', '$nombreEspecialidad', '$nombreDoctor', '$nombreModalidad', '$mensaje')";

        $ejecutarInsertar = mysqli_query($conexion, $insertarDatos);

        if ($ejecutarInsertar) {
          // La inserción fue exitosa, muestra un mensaje de SweetAlert
          echo '<script>
              Swal.fire({
                  title: "Éxito",
                  text: "Su cita se ha agregado exitosamente.",
                  icon: "success",
                  confirmButtonText: "OK"
              }).then((result) => {
                  if (result.isConfirmed) {
                      window.location.href = "index.html"; // Redirige al usuario al archivo index.html
                  }
              });
              </script>';
        } else {
          // Error: Ha ocurrido un error al agregar la cita, muestra un mensaje de SweetAlert
          echo '<script>
              Swal.fire({
                  title: "Error",
                  text: "Ha ocurrido un error al agregar la cita. Por favor, inténtelo de nuevo.",
                  icon: "error",
                  confirmButtonText: "OK"
              });
              </script>';
        }

    } else {
        echo "La fecha ingresada no es válida.";
      }
}
?>