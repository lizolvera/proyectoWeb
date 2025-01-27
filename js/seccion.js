const steps = document.querySelectorAll('.form-step');
        const nextBtns = document.querySelectorAll('.btn-next');
        const prevBtns = document.querySelectorAll('.btn-prev');
        let currentStep = 0;
    
        // Mostrar el paso siguiente
        nextBtns.forEach((btn) => {
            btn.addEventListener('click', () => {
                steps[currentStep].classList.remove('active');
                currentStep++;
                steps[currentStep].classList.add('active');
            });
        });
    
        // Mostrar el paso anterior
        prevBtns.forEach((btn) => {
            btn.addEventListener('click', () => {
                steps[currentStep].classList.remove('active');
                currentStep--;
                steps[currentStep].classList.add('active');
            });
        });
