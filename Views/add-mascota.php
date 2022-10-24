<?php
include("nav-bar.php");
?>
<html>

<head>
    <title>Agregar mascota</title>
    <style><?php include(VIEWS_PATH . "/layout/styles/add-mascota.css")?></style>
</head>

<body>
    <div class="agregar-mascota"><h2>Agregar mascota:</h2></div>
    <div class="form_add_pet">
        <form action="<?php echo FRONT_ROOT ?> Mascotas/Add" method=POST>
            <label for="nombre">Nombre de tu mascota:</label>
            <input type="text" name="nombre">
            <br><br>
            <label for="edad">Edad:</label>
            <input type="text" name="edad">
            <br><br>
            <label for="raza">Raza:</label>
            <input type="text" name="raza">
            <br><br>
            <label for="tamanio">Tamaño:</label>
            <input type="radio" name="tamanio" value="pequenio">Pequeño
            <input type="radio" name="tamanio" value="mediano">Mediano
            <input type="radio" name="tamanio" value="grande">Grande
            <br><br>
            <label for="observaciones">Observaciones:</label>
            <textarea name="observaciones" cols="30" rows="10"></textarea>
            <br><br>
            <button type="submit">Agregar</button>
        </form>
    </div>
</body>

</html>