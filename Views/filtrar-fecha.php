<?php 
include("nav-bar.php");
?>
<html>
    <form action="<?php echo FRONT_ROOT . "User/filtrarFecha"?>" method=POST>
        <label>Filtrar por fecha</label> <br><br>
        <p>Ingrese un rango de fechas:</p>
        <input type="date" name="inicio">
        <input type="date" name="fin">
        <button type="submit">Filtrar</button>
    </form>

    <a  class="backMenu" href= <?php echo(FRONT_ROOT . "User/getView")?>>
            <input type="button" value="Volver al Menú" />
        </a>
</html>