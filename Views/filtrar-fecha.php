<?php 
include("nav-bar.php");
?>
<html>
    <form action="<?php echo FRONT_ROOT . "User/filtrarFecha"?>" method=POST>
        <label>Filtrar por fecha</label> <br><br>
        <input type="date" name="fecha">
        <button type="submit">Filtrar</button>
    </form>

    <a  class="backMenu" href= <?php echo( FRONT_ROOT . "User/getView")?>>
            <input type="button" value="Volver al Menú" />
        </a>
</html>