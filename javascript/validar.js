//----------------------------------------------------------//
// Validar los campos de los formularios generales
//----------------------------------------------------------//

//Ésta es la primera instrucción que se ejecutará cuando el documento esté cargado.
//Se hará una llamada a la función iniciar()
//De esta manera nos aseguramos que las asignaciones de eventos no fallarán ya que todos los objetos están disponibles.
window.onload=iniciar;

//----------------------------------------------------------//
function iniciar(){
    //Al hacer click en el botón del formulario tendrá que llamar a la la función validar que se encargará de validar el formulario.
    //El evento de click lo programamos en la fase de burbujeo (false).
    document.getElementById("enviar").addEventListener('click',validar,false);
}

//----------------------------------------------------------//
//En la variable que pongamos aquí gestionaremos el evento por defecto asociado al botón de "enviar" (type=submit) 
//que en este caso lo que hace por defecto es enviar un formulario
function validar(eventopordefecto){		
    //Validamos cada uno de los apartados con llamadas a sus funciones correspondientes
    if (validarUsuario(this) && validarContrasena(this)){        
        //Salimos de la función devolviendo false	
        return true;
    }
    else{
        //Cancelamos el evento de envío por defecto asignado al boton de submit enviar
        eventopordefecto.preventDefault();	
        //Salimos de la función devolviendo false	
        return false;	
    }
}

//----------------------------------------------------------//
//Funcion para validar el campo Usuario
//Comprueba que el campo no este vacio, sea de tipo texto y tenga de 6 a 10 caracteres
function validarUsuario(){		
    //Comprobamos que el campo no este vacio
    if (document.getElementById("usuario").value != ""){		
        //Patron para comprobar que es de tipo texto
        var patron = /^[a-zA-Z]/;		
        if (patron.test(document.getElementById("usuario").value)){
            //Comprobamos que la cadena tiene entre 6 y 10 caracteres
            if (document.getElementById("usuario").value.length>5 && document.getElementById("usuario").value.length<11){
                return true;
            }
            else{
                //Mostramos una alerta con el error	
                swal("Usuario", "tiene que tener una longitud entre 6 y 10 caracteres", "error");
                //Situamos el foco en el campo usuario
                document.getElementById("usuario").focus();
                return false;
            }
        }
        else{
            //Mostramos una alerta con el error	
            swal("Usuario", "tiene que ser una cadena de texto", "error");	
            //Situamos el foco en el campo usuario
            document.getElementById("usuario").focus();
            return false;                
        }
    }
    else{
        //Mostramos una alerta con el error	
        swal("Usuario", "no puede estar en blanco", "error");
        //Situamos el foco en el campo usuario
        document.getElementById("usuario").focus();
        return false;		
    }
}

//----------------------------------------------------------//
//Funcion para validar el campo Contraseña
//Comprueba que el campo no este vacio y tenga de 6 a 10 caracteres
function validarContrasena(){			
    //Comprobamos que el campo no este vacio
    if (document.getElementById("contrasena").value != ""){		
        //Comprobamos que la cadena tiene entre 6 y 10 caracteres
        if (document.getElementById("contrasena").value.length>5 && document.getElementById("contrasena").value.length<11){
            return true;
        }
        else{
            //Mostramos una alerta con el error	
            swal("Contraseña", "tiene que tener una longitud entre 6 y 10 caracteres", "error");	
            //Situamos el foco en el campo usuario
            document.getElementById("contrasena").focus();
            return false;
        }
    }
    else{
        //Mostramos una alerta con el error	
        swal("Contraseña", "no puede estar en blanco", "error");	
        //Situamos el foco en el campo usuario
        document.getElementById("contrasena").focus();
        return false;		
    }
}
