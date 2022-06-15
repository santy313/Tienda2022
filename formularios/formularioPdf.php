<form target="_blank" action="#" method="POST">    
    <?php
    if ($_SESSION['usuario']['idRol'] == 1) {
        ?>
        <div class="form-group col-md-6">
            <label for="rol">Selecciona un usuario:</label>
            <select class="form-control" name="rol">
                <option selected="true" disabled="disabled">Selecciona</option>
                <?php
                $clientes = cargarClientes();                
                foreach ($clientes as $key => $value) {                    
                    echo '<option value="' . $value['IdUsuario'] . '">' . $value['nombre'] . '</option>';
                }
                ?>                                    
            </select>
        </div>
    <?php }
    ?>    
    <div class="form-row">
        <div class="form-group col-md-4">
            <div class=" col-md-12"><h5>Imprimir datos Personales?</h5></div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="radio" value="si" checked>
                <label class="form-check-label" for="exampleRadios1">SI</label>                
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="radio"  value="no" checked>
                <label class="form-check-label" for="exampleRadios1">NO</label>
            </div>
        </div>
        <div class="form-group col-md-4">
            <label for="nombre">Cuantos tiempos quieres?</label>
            <input type="number" class="form-control" name="numeroDeTiempos" id="numeroDeTiempos" min="0">
        </div>
        <div class="form-group col-md-4">
            <label for="fechas">Entre que fechas?</label>
            <input type="date" class="form-control" name="fecha1" id="fecha1">
            <input type="date" class="form-control" name="fecha2" id="fecha2">
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-12">
            <input type="submit" value="Imprimir" name="imprimirPdf">
        </div>
    </div>
</form>