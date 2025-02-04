document.addEventListener("DOMContentLoaded", function() {
    let currentStep = 0;
    const formSteps = document.querySelectorAll(".form-step");

    function showStep(step) {
        formSteps.forEach((stepElement, index) => {
            stepElement.style.display = index === step ? "block" : "none";
        });
    }

    // Muestra la primera sección
    showStep(currentStep);

    // Verificar si el correo está registrado
    document.querySelector(".btn-next").addEventListener("click", function() {
        const email = document.getElementById("email").value;

        fetch("../controller/verificar_correo.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `email=${email}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById("pSecreta").value = data.pregunta;
                currentStep++;
                showStep(currentStep);
            } else {
                alert("Correo electrónico no encontrado.");
            }
        })
        .catch(error => console.error("Error:", error));
    });

    // Verificar la respuesta secreta
    document.querySelectorAll(".btn-next")[1].addEventListener("click", function() {
        const email = document.getElementById("email").value;
        const respuesta = document.getElementById("rSecreta").value;

        fetch("../controller/verificar_respuesta.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `email=${email}&rSecreta=${respuesta}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                currentStep++;
                showStep(currentStep);
            } else {
                alert("Respuesta incorrecta.");
            }
        })
        .catch(error => console.error("Error:", error));
    });

    // Botones de atrás
    document.querySelectorAll(".btn-prev").forEach((button, index) => {
        button.addEventListener("click", function() {
            currentStep--;
            showStep(currentStep);
        });
    });

});