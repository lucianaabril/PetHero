<html>
    <form action="<?php echo FRONT_ROOT ."User/filtrarFechas"?>" method=POST>
        <label>Filtrar por fecha</label> <br><br>
        <input type="date" name="inicio">
        <input type="date" name="fin">
        <button type="submit">Filtrar</button>
    </form>
</html>