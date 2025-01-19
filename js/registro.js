    // Validación en tiempo real (teclado)
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

    // Validación al enviar el formulario
    document.addEventListener("DOMContentLoaded", function () {
        // Validaciones específicas en tiempo real
        document.getElementById("nombre").addEventListener("keypress", permitirSoloLetras);
        document.getElementById("ap").addEventListener("keypress", permitirSoloLetras);
        document.getElementById("am").addEventListener("keypress", permitirSoloLetras);
        document.getElementById("respuesta-secreta").addEventListener("keypress", permitirSoloLetras);

        document.getElementById("username").addEventListener("keypress", permitirLetrasYNumeros);
        document.getElementById("telefono").addEventListener("keypress", permitirSoloNumeros);

        // Validaciones al enviar el formulario
        document.querySelector("form").addEventListener("submit", function (event) {
            let isValid = true; // Para rastrear si todas las validaciones se pasan
            let errorMessage = ""; // Mensaje de error acumulativo

            // Obtener los valores de los campos
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

            // Validación de cada campo
            if (!soloLetras.test(nombre)) {
                isValid = false;
                errorMessage += "El campo 'Nombre/s' solo debe contener letras.\n";
            }
            if (!soloLetras.test(ap)) {
                isValid = false;
                errorMessage += "El campo 'Apellido Paterno' solo debe contener letras.\n";
            }
            if (!soloLetras.test(am)) {
                isValid = false;
                errorMessage += "El campo 'Apellido Materno' solo debe contener letras.\n";
            }
            if (!letrasYNumeros.test(username)) {
                isValid = false;
                errorMessage += "El campo 'Nombre de Usuario/Alias' solo debe contener letras y números.\n";
            }
            if (!emailRegex.test(email)) {
                isValid = false;
                errorMessage += "El campo 'Correo Electrónico' no es válido.\n";
            }
            if (!passwordRegex.test(password)) {
                isValid = false;
                errorMessage += "La contraseña debe tener al menos 8 caracteres, incluyendo una letra mayúscula, un número y un carácter especial.\n";
            }
            if (password !== confirmPassword) {
                isValid = false;
                errorMessage += "Las contraseñas no coinciden.\n";
            }
            if (!telefonoRegex.test(telefono)) {
                isValid = false;
                errorMessage += "El campo 'Número de Teléfono' debe contener exactamente 10 dígitos.\n";
            }
            if (!soloLetras.test(respuestaSecreta)) {
                isValid = false;
                errorMessage += "El campo 'Respuesta Secreta' solo debe contener letras.\n";
            }
            if (!terminos) {
                isValid = false;
                errorMessage += "Debe aceptar los términos y condiciones.\n";
            }

            // Mostrar mensajes de error si alguna validación falla
            if (!isValid) {
                event.preventDefault(); // Evitar el envío del formulario
                alert(errorMessage); // Mostrar los errores al usuario
            }
        });
    });