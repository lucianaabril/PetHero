<?php
include("nav-bar.php");
?>
<html>

<head>
    <title>Agregar multimedia</title>
</head>

<body>
    <form action="<?php echo FRONT_ROOT . "File/upload" ?>" method="POST" enctype="multipart/form-data">
        <label>Foto de mascota:</label>
        <input type="file" name="foto"></input>
        <br><br>
        <label>Calendario de vacunación:</label>
        <input type="file" name="vacunacion"></input>
        <br><br>
        <label>Video de mascota:</label>
        <input type="file" name="video"></input>
        <br><br>
        <button type="submit">Guardar</button>
    </form>
</body>

</html>