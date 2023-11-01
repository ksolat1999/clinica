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

  $sql = "SELECT idDoctor, nombreDoctor FROM doctor";
  $resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>MedVida - Doctores</title>
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
          <li><a class="nav-link scrollto active" href="tabla_doctor.php">Doctores</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <a href="cerrar_sesion.php" class="appointment-btn scrollto logout"><span class="d-none d-md-inline">Cerrar</span> Sesión</a>

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
          <h2>Doctores</h2>
        </div>

        <div class="d-flex justify-content-center mb-3">
          <button type="button" id="btnAgregarDoctor" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarDoctor">Agregar Doctor</button>
        </div>

        <div class="table-container">
          <table class="table table-striped table-responsive custom-table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Doctor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultado->num_rows > 0) {
                    while ($fila = $resultado->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $fila["idDoctor"] . "</td>";
                        echo "<td>" . $fila["nombreDoctor"] . "</td>";
                        echo '<td>
                                <button type="button" class="btn btn-success editar-doctor" data-id="' . $fila["idDoctor"] . '"><i class="fas fa-edit"></i></button>
                                <button type="button" class="btn btn-danger eliminar-doctor" data-id="' . $fila["idDoctor"] . '"><i class="far fa-trash-alt"></i></button>
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

        <!-- modal editar doctor -->
        <div class="modal fade" id="modalEditarDoctor" tabindex="-1" aria-labelledby="modalEditarDoctorLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalEditarDoctorLabel">Editar Doctor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form id="formularioEditarDoctor">
                    <input type="hidden" id="editarIdDoctor" name="idDoctor">
                    <div class="mb-3">
                      <label for="editarNombreDoctor" class="form-label">Nombre del Doctor</label>
                      <input type="text" class="form-control" id="editarNombreDoctor" name="nombreDoctor">
                    </div>
                    <!-- Agrega más campos para editar según tus necesidades -->
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- modal crear doctor -->
        <div class="modal fade" id="modalAgregarDoctor" tabindex="-1" aria-labelledby="modalAgregarDoctorLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalAgregarDoctorLabel">Agregar Doctor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form id="formularioAgregarDoctor">
                  <div class="mb-3">
                    <label for="agregarNombreDoctor" class="form-label">Nombre del Doctor</label>
                    <input type="text" class="form-control" id="agregarNombreDoctor" name="nombreDoctor">
                  </div>
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
              </div>
            </div>
          </div>
        </div>


        

      </div>
    </section><!-- End Appointment Section -->

  </main><!-- End #main -->


  <!-- <div id="preloader"></div> -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- eliminar -->
    <script>
      // Función para eliminar doctor 
      function eliminarDoctor(idDoctor) {
        // Petición AJAX para eliminar
        $.ajax({
          url: 'eliminar_doctor.php',
          type: 'POST',
          data: { id: idDoctor },
          success: function(response) {
            // Recargar la página al eliminar      
            location.reload();
          }
        });
      }

      // Manejador de click para botón eliminar
      $('.eliminar-doctor').click(function() {
        let idDoctor = $(this).data('id');
        
        eliminarDoctor(idDoctor); 
      });
    </script>



    <!-- editar -->
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        // Variables globales para almacenar datos del doctor a editar
        let doctorIdToEdit = null;

        const mensajeExito = document.getElementById('mensaje-exito');
        const mensajeError = document.getElementById('mensaje-error');
        const modalEditar = document.getElementById('modalEditarDoctor');
        const formularioEditar = document.getElementById('formularioEditarDoctor');

        // Función para cargar los detalles del doctor seleccionado
        function cargarDetallesDoctor(idDoctor) {
          // Realiza una solicitud AJAX para obtener los detalles del doctor
          fetch(`obtener_doctor.php?id=${idDoctor}`)
          .then(response => response.json())
          .then(datos => {
              const doctorId = datos.idDoctor; 
              const nombreDoctor = datos.nombreDoctor;

              document.getElementById('editarIdDoctor').value = doctorId;
              document.getElementById('editarNombreDoctor').value = nombreDoctor;

              const modal = new bootstrap.Modal(modalEditar);  
              modal.show();
          })
          .catch(error => {
              console.error("Error al obtener los detalles del doctor", error);
              mensajeError.innerText = 'Error al obtener datos del doctor';
          });
        }

        // Botón editar abre el modal
        document.querySelectorAll('.editar-doctor').forEach(boton => {
          boton.addEventListener('click', () => {
              const idDoctor = boton.getAttribute('data-id');
              cargarDetallesDoctor(idDoctor);
          });
        });

        // Envío del formulario  
        formularioEditar.addEventListener('submit', e => {

          e.preventDefault();

          const nombreDoctor = document.getElementById('editarNombreDoctor').value;  

          // Validaciones
          if(nombreDoctor === '') {
            mensajeError.innerText = 'El nombre del doctor es obligatorio';
            return;
          }

          // Deshabilitar botón enviar
          formularioEditar.submitButton.disabled = true;

          // Petición AJAX
          fetch(url, {
            method: 'POST', 
            body: new FormData(formularioEditar)
          })
          .then(respuesta => {

            formularioEditar.submitButton.disabled = false;

            if(respuesta.ok) {
              mensajeExito.innerText = '¡Doctor actualizado!';
            } else {
              mensajeError.innerText = 'Error al actualizar doctor';
            }
          })
          .catch(error => {
            formularioEditar.submitButton.disabled = false;
            mensajeError.innerText = 'Error en la petición';
          });
        });

        // Antes de cerrar el modal
        modalEditar.addEventListener('hidden.bs.modal', e => {
          if(confirm('¿Guardar cambios al doctor?')) {
          formularioEditar.submit();
          }
        });
      })

    </script>

    <!-- agregar -->
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const btnAgregarDoctor = document.getElementById('btnAgregarDoctor');
        const formularioAgregarDoctor = document.getElementById('formularioAgregarDoctor');

        // Escucha el clic en el botón "Agregar Doctor" para restablecer el formulario
        btnAgregarDoctor.addEventListener('click', function () {
          formularioAgregarDoctor.reset();
        });

        // Escucha el envío del formulario
        formularioAgregarDoctor.addEventListener('submit', function (e) {
          e.preventDefault();

          // Obtiene los datos del formulario
          const nombreDoctor = document.getElementById('nombreDoctor').value; // Obtén otros campos según sea necesario

          // Realiza una solicitud AJAX para agregar el doctor
          fetch('agregar_doctor.php', {
            method: 'POST',
            body: JSON.stringify({
              nombreDoctor: nombreDoctor, // Envía otros campos aquí
            }),
            headers: {
              'Content-Type': 'application/json',
            },
          })
          .then(response => response.json())
          .then(data => {
            // Aquí puedes manejar la respuesta del servidor (éxito o error) y actualizar la tabla si es necesario
            console.log(data);

            // Cierra el modal después de agregar con éxito
            const modalAgregarDoctor = new bootstrap.Modal(document.getElementById("modalAgregarDoctor"));
            modalAgregarDoctor.hide();
          })
          .catch(error => {
            console.error('Error al agregar el doctor', error);
            // Maneja los errores aquí
          });
        });
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
