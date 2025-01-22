document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("login-form").addEventListener("submit", function (event) {
        let isValid = true;
        let errorMessage = "";

        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value.trim();

        // para el correo ese
        const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if (!emailRegex.test(email)) {
            isValid = false;
            errorMessage += "El campo 'Correo Electrónico' no es válido.\n";
        }

        // para la contraseña xd
        const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/;
        if (!passwordRegex.test(password)) {
            isValid = false;
            errorMessage += "La contraseña debe tener al menos 8 caracteres, incluyendo una letra mayúscula, un número y un carácter especial.\n";
        }

        // si el js no funciona
        if (!isValid) {
            event.preventDefault(); // evita que el formulario se envie
            alert(errorMessage); // Muestra errores al usuario cfcff
        }
    });
});