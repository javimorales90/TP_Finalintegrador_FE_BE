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

    <button type="button" class="btn btn-dark" onclick="cambiarModo()">Oscuro / Claro</button>
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