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

</head>
<body class="bodyRegistrar">

<header class="headerRegistrar"><img src=""></header>

<div class="divBotonesregistrar">
  <a href="menuPrincipal.html" class="botonVolveralMenu">
    <button type="button" class="btn btn-success">Volver al Menú</button>
  </a>

  <a class="nav-link botonConsultarregistroRegistrar" href="index.php">
    <button type="button" class="btn btn-primary">Consultar Registro</button>
  </a>

  <button type="button" class="btn btn-dark" onclick="cambiarModo()">Oscuro / Claro</button>

</div>

<h1 class="tituloRegistrar">Registrá tu Mascota</h1>


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
        <option selected> Seleccione Especie</option>
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

<div class="form-text">No compartiremos sus datos con nadie más.</div>



<footer class="footerRegistrar"><img src=""></footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <script src="JS/script.js"></script>
    <script src="JS/scriptModo.js"></script>
    <script src="JS/scriptEvento.js"></script>

</body>
</html>