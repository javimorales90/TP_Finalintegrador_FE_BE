<?php

function randomString($n){
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $str = '';
  for ($i = 0; $i < $n; $i++){
    $index = rand(0,strlen($characters) - 1);
    $str = $str . $characters[$index]; // es igual que $str .= $characters[$index]
  }
  return $str;
}

if (count($_POST)>0){ // O también if ($_SERVER['REQUEST_METHOD']=='POST')

  // echo '<pre>';
  // print_r($_POST);
  // echo '</pre>';
  // exit;


  $dbname = 'crud_mascotas';
  $user='root';
  $password='';

  try {
      
      $dsn = "mysql:host=localhost;dbname=$dbname";
      $dbh = new PDO($dsn, $user, $password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  } catch (PDOException $e){
      echo $e->getMessage();
  } 

  // Prepare:

  $stmt = $dbh->prepare("INSERT INTO mascotas (nombre, edad, foto, nombre_propietario, apellido_propietario, telefono, email, provincia, especie, vacunado, esterilizado) 
                                      VALUES (:nombre, :edad, :foto, :nombre_propietario, :apellido_propietario, :telefono, :email, :provincia, :especie, :vacunado, :esterilizado)");

  // Bind

  $nombre = $_POST['nombre'];
  $edad = $_POST['edad'];
  //$foto = $_POST['foto'];
  $nombre_propietario = $_POST['nombre_propietario'];
  $apellido_propietario = $_POST['apellido_propietario'];
  $telefono = $_POST['telefono'];
  $email = $_POST['email'];
  $provincia = $_POST['provincia'];
  $especie = $_POST['especie'];
  $vacunado = $_POST['vacunado'];
  $esterilizado = $_POST['esterilizado'];

// print_r($_POST);
// exit;

  $foto=$_FILES['foto'] ?? null;
  if($foto){
    if (!is_dir('fotos')){ // Si el directorio no existe se crea.
      mkdir('fotos');
    }
    $ruta_foto = 'fotos/'.randomString(8).'/'.$foto['name'];
    mkdir(dirname($ruta_foto));
    move_uploaded_file($foto['tmp_name'], $ruta_foto);
  
  }


        // Se enlaza al valor
  $stmt->bindValue(':nombre', $nombre);  
  $stmt->bindValue(':edad', $edad); 
  $stmt->bindValue(':foto', $ruta_foto); 
  $stmt->bindValue(':nombre_propietario', $nombre_propietario); 
  $stmt->bindValue(':apellido_propietario', $apellido_propietario); 
  $stmt->bindValue(':telefono', $telefono);  
  $stmt->bindValue(':email', $email); 
  $stmt->bindValue(':provincia', $provincia); 
  $stmt->bindValue(':especie', $especie); 
  $stmt->bindValue(':vacunado', $vacunado); 
  $stmt->bindValue(':esterilizado', $esterilizado); 


  //Execute

  $stmt->execute(); // Se inserta

  header("Location: index.php"); // Redirecciona al index.php

}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrá tu Mascota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styleRegistrar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

</head>
<body class="bodyRegistrar">

<header class="headerRegistrar"><img src=""></header>

<div class="divBotonesregistrar">
  <a href="menuPrincipal.html" class="botonVolveralMenu">
    <button type="button" class="btn btn-success animate__animated animate__swing">Volver al Menú</button>
  </a>

  <a class="nav-link botonConsultarregistroRegistrar" href="index.php">
    <button type="button" class="btn btn-primary animate__animated animate__swing">Consultar Registro</button>
  </a>

  <button type="button" class="btn btn-dark animate__animated animate__swing" onclick="cambiarModo()">
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" fill="currentColor" class="bi bi-moon-stars" viewBox="0 0 16 16">
          <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278zM4.858 1.311A7.269 7.269 0 0 0 1.025 7.71c0 4.02 3.279 7.276 7.319 7.276a7.316 7.316 0 0 0 5.205-2.162c-.337.042-.68.063-1.029.063-4.61 0-8.343-3.714-8.343-8.29 0-1.167.242-2.278.681-3.286z"/>
          <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
      </svg> /
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" fill="currentColor" class="bi bi-sun" viewBox="0 0 16 16">
          <path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
      </svg>  
  </button>

</div>

<h1 class="tituloRegistrar">Registrá tu Mascota</h1>
<h5 class="tituloRegistrar">¡IMPORTANTE!: Carga foto actualizada de tu mascota</h5>


<form method="post" action="registrar.php" enctype="multipart/form-data" class="formRegistrar" name="formRegistrar">

  <div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="nombre" name="nombre">
  </div>

  <div class="mb-3">
    <label for="edad" class="form-label">Edad</label>
    <input type="number" class="form-control" id="edad" name="edad">
  </div>

  <div class="mb-3">
    <label for="foto" class="form-label">Foto de la mascota</label>
    <input class="form-control" type="file" id="foto" name="foto">
  </div>

  <div class="mb-3">
    <label for="nombre_propietario" class="form-label">Nombre del propietario</label>
    <input type="text" class="form-control" id="nombre_propietario" name="nombre_propietario">
  </div>

  <div class="mb-3">
    <label for="apellido_propietario" class="form-label">Apellido del propietario</label>
    <input type="text" class="form-control" id="apellido_propietario" name="apellido_propietario">
  </div>

  <div class="mb-3">
    <label for="telefono" class="form-label">Teléfono</label>
    <input type="tel" class="form-control" id="telefono" name="telefono">
  </div>

  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
  </div>

  <div class="mb-3">
    <select class="form-select" aria-label="Default select example" id="provincia" name="provincia">
      <option value="" selected disabled>Seleccione Provincia</option>
    </select>
  </div>

  <div class="mb-3">
    <select class="form-select" aria-label="Default select example" id="especie" name="especie">
        <option selected>Seleccione Especie</option>
        <option value="perro">Perro</option>
        <option value="gato">Gato</option>
        <option value="ave">Ave</option>
        <option value="roedor">Roedor</option>
        <option value="pez">Pez</option>
        <option value="reptil">Reptil</option>
        <option value="anfibio">Anfibio</option>
        <option value="insecto">Insecto</option>
        <option value="artropodo">Artropodo</option>
        <option value="otro">Otro</option>
    </select>
  </div>

  <div class="mb-3">
    <select class="form-select" aria-label="Default select example" id="vacunado" name="vacunado">
      <option selected>Vacunado?</option>
      <option value="si">Si</option>
      <option value="no">No</option>
    </select>
  </div>

  <div class="mb-3">
    <select class="form-select" aria-label="Default select example" id="esterilizado" name="esterilizado">
      <option selected>Esterilizado?</option>
      <option value="si">Si</option>
      <option value="no">No</option>
    </select>
  </div>


  <button type="submit" class="btn btn-primary botonRegistrar">Registrar</button>
</form>

<div class="form-text leyendaInferior">No compartiremos sus datos con nadie más.</div>



<footer class="footerRegistrar"><img src=""></footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <script src="JS/script.js"></script>
    <script src="JS/scriptModo.js"></script>
    <script src="JS/scriptEvento.js"></script>

</body>
</html>