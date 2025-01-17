document.addEventListener("DOMContentLoaded", () => {
    const sections = document.querySelectorAll(".section");

    // Función para mostrar la sección correspondiente
    window.showSection = (sectionId) => {
        sections.forEach((section) => {
            section.classList.remove("active");
        });
        document.getElementById(sectionId).classList.add("active");
    };

    // Inicialmente mostrar la galería
    showSection("gallery");

    // Validaciones para los formularios
    const registerForm = document.getElementById("registerForm");
    const loginForm = document.getElementById("loginForm");
    const recoverForm = document.getElementById("recoverForm");

    // Validación de registro
    registerForm.addEventListener("submit", (e) => {
        e.preventDefault();
        const username = document.getElementById("username").value.trim();
        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value.trim();
        const confirmPassword = document.getElementById("confirmPassword").value.trim();

        if (!username || !email || !password || !confirmPassword) {
            alert("Todos los campos son obligatorios.");
            return;
        }

        if (!/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(password)) {
            alert("La contraseña debe tener al menos 8 caracteres, una mayúscula, un número y un carácter especial.");
            return;
        }

        if (password !== confirmPassword) {
            alert("Las contraseñas no coinciden.");
            return;
        }

        alert("Registro exitoso!");
        registerForm.reset();
    });

    // Validación de login
    loginForm.addEventListener("submit", (e) => {
        e.preventDefault();
        const loginUsername = document.getElementById("loginUsername").value.trim();
        const loginPassword = document.getElementById("loginPassword").value.trim();

        if (!loginUsername || !loginPassword) {
            alert("Todos los campos son obligatorios.");
            return;
        }

        alert("Inicio de sesión exitoso!");
        loginForm.reset();
    });

    // Validación de recuperación de contraseña
    recoverForm.addEventListener("submit", (e) => {
        e.preventDefault();
        const recoverEmail = document.getElementById("recoverEmail").value.trim();

        if (!recoverEmail) {
            alert("El campo de correo electrónico es obligatorio.");
            return;
        }

        alert("Se ha enviado un enlace de recuperación a tu correo.");
        recoverForm.reset();
    });
});
