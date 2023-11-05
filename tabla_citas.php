<?php
  session_start();
  // Verifica si el usuario tiene permisos de administrador
  if ($_SESSION['rol'] !== 'admin') {
    // Redirige a una página de acceso denegado o a la página de inicio de usuario
    header("Location: acceso_denegado.php");
    exit;
  }
?>

<?php
  $conexion = new mysqli("localhost", "root", "", "clinica");

  if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
  }

  $sql = "SELECT id, nombrePaciente, correoPaciente, telefonoPaciente, fechaCita, horaCita, nombreEspecialidad, nombreDoctor, nombreModalidad, mensaje FROM citas";
  $resultado = $conexion->query($sql);
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
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- icon -->
  <link href="assets/img/doctor.png" rel="icon">
  <link href="assets/img/doctor.png" rel="apple-touch-icon">

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
          <li><a class="nav-link scrollto" href="index_admin.php">Home</a></li>
          <li><a class="nav-link scrollto active" href="tabla_citas.php">Citas</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <a href="cerrar_sesion.php" class="appointment-btn scrollto logout"><span class="d-none d-md-inline">Cerrar</span> Sesión</a>

      <!-- <a href="#appointment" class="appointment-btn scrollto"><span class="d-none d-md-inline">Make an</span> Appointment</a> -->

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      
    </section> <!--  End Breadcrumbs Section -->

    <!-- ======= table section ======= -->
    <section id="appointment" class="appointment section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Citas</h2>
        </div>

        <div class="table-container">
          <table class="table table-striped table-responsive custom-table2 table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Paciente</th>
                    <th>Telefono Paciente</th>
                    <th>Fecha Cita</th>
                    <th>Hora Cita</th>
                    <th>Especialidad</th>
                    <th>Doctor</th>
                    <th>Modalidad</th>
                    <th>Mensaje</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultado->num_rows > 0) {
                    while ($fila = $resultado->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $fila["id"] . "</td>";
                        echo "<td>" . $fila["nombrePaciente"] . "</td>";
                        echo "<td>" . $fila["telefonoPaciente"] . "</td>";
                        echo "<td>" . $fila["fechaCita"] . "</td>";
                        echo "<td>" . $fila["horaCita"] . "</td>";
                        echo "<td>" . $fila["nombreEspecialidad"] . "</td>";
                        echo "<td>" . $fila["nombreDoctor"] . "</td>";
                        echo "<td>" . $fila["nombreModalidad"] . "</td>";
                        echo "<td>" . $fila["mensaje"] . "</td>";
                        echo '<td>
                                <button type="button" class="btn btn-danger eliminar-Citas" data-id="' . $fila["id"] . '"><i class="far fa-trash-alt"></i></button>
                            </td>';
                        echo "</tr>";
                    }
                } else {
                    echo "No se encontraron registros.";
                }
                $conexion->close();
                ?>
            </tbody>
          </table>
        </div>
        

      </div>
    </section><!-- End Appointment Section -->

  </main><!-- End #main -->


  <!-- <div id="preloader"></div> -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- eliminar -->
    <script>
      // Función para eliminar cita
      function eliminarCitas(idCita) {
        // Petición AJAX para eliminar
        $.ajax({
          url: 'eliminar_citas.php',
          type: 'POST',
          data: { id: idCitas },
          success: function(response) {
            // Recargar la página al eliminar      
            location.reload();
          }
        });
      }

      // Manejador de click para botón eliminar
      $('.eliminar-citas').click(function() {
        let idCitas = $(this).data('id');
        
        eliminarCitas(idCitas); 
      });
    </script>


    <!-- Vendor JS Files -->
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    
    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>


</body>

</html>
