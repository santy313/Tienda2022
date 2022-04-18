<?php
session_start();
if (!isset($_SESSION['rol'])) {
    header("Location: ./Login.php");
}
?>
<!DOCTYPE html>
<html>
    <?php include './templates/cabecera.php'; ?>
    <body>
        <?php include './templates/menu.php'; ?>
        <br><br>
        <div class="container">                        
            <form>                
                <fieldset>
                    <legend>Datos Login </legend>
                    <div class="form-row">                
                        <div class="form-group col-md-6">
                            <label for="login">Login: </label>
                            <input type="text" class="form-control" id="login" placeholder="<?php echo $_SESSION['usuario']['user_name']; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="contrasenha">Password: </label>
                            <input type="text" class="form-control" id="contrasenha" placeholder="<?php echo $_SESSION['usuario']['user_pass']; ?>">
                        </div>
                    </div>                        
                </fieldset>
                <fieldset>
                    <legend>Datos Personales </legend>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" placeholder="<?php echo $_SESSION['usuario']['nombre']; ?>" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="apellido">Apellido</label>
                            <input type="text" class="form-control" id="apellido" placeholder="<?php echo $_SESSION['usuario']['apellido']; ?>">
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Mejor Tiempo </legend>
                    <div class="form-row">
                        <div class="form-group col-md-6">                            
                            <input type="text" class="form-control" id="mejorTiempo" placeholder="<?php echo $_SESSION['usuario']['mejorTiempo']; ?>" >
                        </div>                    
                    </div>
                </fieldset>
                <button type="submit" class="btn btn-primary">Sign in</button>
            </form>            
        </div>
        <?php
        include 'templates/footer.php'
        ?>