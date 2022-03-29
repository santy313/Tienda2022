<?php
session_start();
if (!isset($_SESSION['rol'])) {
    header("Location: ./Login.php");
}
?>
<!DOCTYPE html>
<html>
    <?php include './templates/cabecera.php'; ?>
    <?php
    // put your code here
    ?>


    <h1>Pag. Index</h1>
    <?php
    print_r($_SESSION['usuario']);
    foreach ($_SESSION['usuario'] as $indice => $datosUsuario) {
        ?>
        <form>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Nombre de Usuario: </label>
                    <input type="text" class="form-control" id="inputEmail4" placeholder="<?php echo $datosUsuario['user_name']; ?>" >
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Contraseña de Usuario: </label>
                    <input type="text" class="form-control" id="inputPassword4" placeholder="<?php echo $datosUsuario['user_pass']; ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Nombre</label>
                    <input type="text" class="form-control" id="inputEmail4" placeholder="<?php echo $datosUsuario['nombre']; ?>" >
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Apellido</label>
                    <input type="text" class="form-control" id="inputPassword4" placeholder="<?php echo $datosUsuario['apellido']; ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Password</label>
                    <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Address</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
            </div>
            <div class="form-group">
                <label for="inputAddress2">Address 2</label>
                <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">City</label>
                    <input type="text" class="form-control" id="inputCity">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">State</label>
                    <select id="inputState" class="form-control">
                        <option selected>Choose...</option>
                        <option>...</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputZip">Zip</label>
                    <input type="text" class="form-control" id="inputZip">
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                        Check me out
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Sign in</button>
        </form>
    <?php }
    ?>









    <?php
    include 'templates/footer.php'
    ?>