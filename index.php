<?php

$dbname = 'crud_mascotas';
$user = 'root';
$password = '';

try {
    $dsn = "mysql:host=localhost;dbname=$dbname";

    $dbh = new PDO($dsn,$user,$password);

    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e){

    echo $e->getMessage();
}
$sql="SELECT * FROM mascotas LEFT JOIN provincias ON id_provincia=provincia ORDER BY nombre";
$statement = $dbh->prepare($sql);
$statement->execute();
$mascotas = $statement->fetchAll(); // trae todos las mascotas en un array

/*
echo "<pre>";
print_r($mascotas);
echo "</pre>";
*/

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Mascotas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/styleIndex.css">

</head>
<body>

<header class="headerIndex"><img src=""></header>

<div class="divBotonesindex">
    <a href="registrar.php" class="botonRegistrarmascotaIndex">
        <button type="button" class="btn btn-primary">Registrar Mascota</button>
    </a>

    <a href="menuPrincipal.html" class="botonVolveralMenuindex">
        <button type="button" class="btn btn-success">Volver al Menú</button>
    </a>

    <button type="button" class="btn btn-dark" onclick="cambiarModo()">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" fill="currentColor" class="bi bi-moon-stars" viewBox="0 0 16 16">
          <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278zM4.858 1.311A7.269 7.269 0 0 0 1.025 7.71c0 4.02 3.279 7.276 7.319 7.276a7.316 7.316 0 0 0 5.205-2.162c-.337.042-.68.063-1.029.063-4.61 0-8.343-3.714-8.343-8.29 0-1.167.242-2.278.681-3.286z"/>
          <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
      </svg> /
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" fill="currentColor" class="bi bi-sun" viewBox="0 0 16 16">
          <path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
      </svg>
    </button>
</div>

<h1>Registro de Mascotas</h1>

<table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Edad</th>
            <th scope="col">Foto</th>
            <th scope="col">NombrePropietario</th>
            <th scope="col">ApellidoPropietario</th>
            <th scope="col">Telefono</th>
            <th scope="col">Email</th>
            <th scope="col">Provincia</th>
            <th scope="col">Especie</th>
            <th scope="col">Vacunado</th>
            <th scope="col">Esterilizado</th>
          </tr>
        </thead>
        
        <tbody>

        <?php foreach ($mascotas as $i => $mascota) { ?>
            <tr>
                <th scope="row">
                    <?= $i ?>
                </th>

            <td><?= $mascota ['nombre'] ?></td>
            <td><?= $mascota ['edad'] ?></td>
            <td><img src= "<?= $mascota ['foto'] ?>" class= "thumb_image"></td>
            <td><?= $mascota ['nombre_propietario'] ?></td>
            <td><?= $mascota ['apellido_propietario'] ?></td>
            <td><?= $mascota ['telefono'] ?></td>
            <td><?= $mascota ['email'] ?></td>
            <td><?= $mascota ['nombre_provincia'] ?></td>
            <td><?= $mascota ['especie'] ?></td>
            <td><?= $mascota ['vacunado'] ?></td>
            <td><?= $mascota ['esterilizado'] ?></td>

            
            <td>
              <form method="get" action="actualizar.php">
                <input type="hidden" name="id" value="<?= $mascota ['id'] ?>">
                <button type="submit" class="btn btn-primary">Editar</button>
              </form>

              <form method="post" action="borrar.php">
                <input type="hidden" name="id" value="<?= $mascota ['id'] ?>">
                <button type="submit" class="btn btn-danger botonBorrar">Borrar</button>
              </form>
            </td>

          </tr>
          <?php } ?>
        </tbody>
      </table>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <script src="JS/script.js"></script>
    <script src = "JS/scriptModo.js"></script>
    <script src="JS/scriptEvento.js"></script>
</body>
</html>