<?php 
include("nav-bar.php");
?>
<html>
    <form action="<?php echo FRONT_ROOT . "User/filtrarFecha"?>" method=POST>
        <label>Filtrar por fecha</label> <br><br>
        <input type="date" name="fecha">
        <button type="submit">Filtrar</button>
    </form>
</html>