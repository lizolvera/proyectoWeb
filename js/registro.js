// Para bloqueo de teclado 
function permitirSoloLetras(event) {
    const char = String.fromCharCode(event.keyCode || event.which);
    const regex = /^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]$/; // Solo letras y espacios
    if (!regex.test(char)) {
        event.preventDefault();
    }
}

function permitirLetrasYNumeros(event) {
    const char = String.fromCharCode(event.keyCode || event.which);
    const regex = /^[a-zA-Z0-9]$/; // Letras y números
    if (!regex.test(char)) {
        event.preventDefault();
    }
}

function permitirSoloNumeros(event) {
    const char = String.fromCharCode(event.keyCode || event.which);
    const regex = /^[0-9]$/; // Solo números
    if (!regex.test(char)) {
        event.preventDefault();
    }
}

// Validación de envío del formulario
document.addEventListener("DOMContentLoaded", function () {
    // Asignación de eventos a los campos
    document.getElementById("nombre").addEventListener("keypress", permitirSoloLetras);
    document.getElementById("ap").addEventListener("keypress", permitirSoloLetras);
    document.getElementById("am").addEventListener("keypress", permitirSoloLetras);
    document.getElementById("respuesta-secreta").addEventListener("keypress", permitirSoloLetras);

    document.getElementById("username").addEventListener("keypress", permitirLetrasYNumeros);
    document.getElementById("telefono").addEventListener("keypress", permitirSoloNumeros);

    // Validaciones al enviar el formulario
    document.querySelector("form").addEventListener("submit", function (event) {
        let isValid = true;
        let errorMessage = "";

        // Obtener valores de los campos
        const nombre = document.getElementById("nombre").value.trim();
        const ap = document.getElementById("ap").value.trim();
        const am = document.getElementById("am").value.trim();
        const username = document.getElementById("username").value.trim();
        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value.trim();
        const confirmPassword = document.getElementById("confirm-password").value.trim();
        const telefono = document.getElementById("telefono").value.trim();
        const respuestaSecreta = document.getElementById("respuesta-secreta").value.trim();
        const terminos = document.getElementById("terminos").checked;

        // Expresiones regulares
        const soloLetras = /^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]+$/;
        const letrasYNumeros = /^[a-zA-Z0-9]+$/;
        const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/;
        const telefonoRegex = /^[0-9]{10}$/;

        // Validaciones
        if (!soloLetras.test(nombre)) {
            isValid = false;
            errorMessage += "El campo 'Nombre/s' solo debe contener letras.<br>";
        }
        if (!soloLetras.test(ap)) {
            isValid = false;
            errorMessage += "El campo 'Apellido Paterno' solo debe contener letras.<br>";
        }
        if (!soloLetras.test(am)) {
            isValid = false;
            errorMessage += "El campo 'Apellido Materno' solo debe contener letras.<br>";
        }
        if (!letrasYNumeros.test(username)) {
            isValid = false;
            errorMessage += "El campo 'Nombre de Usuario/Alias' solo debe contener letras y números.<br>";
        }
        if (!emailRegex.test(email)) {
            isValid = false;
            errorMessage += "El campo 'Correo Electrónico' no es válido.<br>";
        }
        if (!passwordRegex.test(password)) {
            isValid = false;
            errorMessage += "La contraseña debe tener al menos 8 caracteres, incluyendo una letra mayúscula, un número y un carácter especial.<br>";
        }
        if (password !== confirmPassword) {
            isValid = false;
            errorMessage += "Las contraseñas no coinciden.<br>";
        }
        if (!telefonoRegex.test(telefono)) {
            isValid = false;
            errorMessage += "El campo 'Número de Teléfono' debe contener exactamente 10 dígitos.<br>";
        }
        if (!soloLetras.test(respuestaSecreta)) {
            isValid = false;
            errorMessage += "El campo 'Respuesta Secreta' solo debe contener letras.<br>";
        }
        if (!terminos) {
            isValid = false;
            errorMessage += "Debe aceptar los términos y condiciones.<br>";
        }

        // Mostrar error con SweetAlert2 si hay fallos
        if (!isValid) {
            event.preventDefault(); // Evita el envío del formulario
            Swal.fire({
                title: "Errores en el formulario",
                html: errorMessage,
                icon: "error",
                confirmButtonText: "Entendido",
                confirmButtonColor: "#4563d9"
            });
        } else {
            // Si todo es válido, mostrar un mensaje de éxito (opcional)
            event.preventDefault(); // Comentar o eliminar esta línea para permitir el envío real del formulario
            Swal.fire({
                title: "Registro exitoso",
                text: "Tu registro se ha completado con éxito.",
                icon: "success",
                confirmButtonText: "Aceptar",
                confirmButtonColor: "#4563d9"
            }).then(() => {
                document.querySelector("form").submit(); // Envía el formulario después de la confirmación
            });
        }
    });
});
