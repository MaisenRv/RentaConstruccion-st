const registerLink = document.getElementById('register-link');
const registerModal = document.getElementById('register-modal');
const closeRegisterModal = document.getElementById('close-register-modal');
const forgotPasswordLink = document.getElementById('forgot-password-link');
const forgotPasswordModal = document.getElementById('forgot-password-modal');
const closeForgotModal = document.getElementById('close-forgot-modal');
const forgotPasswordForm = document.getElementById('forgot-password-form');
const emailSentMessage = document.getElementById('email-sent-message');

// Abrir el modal de registro
registerLink.addEventListener('click', (e) => {
    e.preventDefault();
    registerModal.style.display = 'flex';
});

// Cerrar el modal de registro
closeRegisterModal.addEventListener('click', () => {
    registerModal.style.display = 'none';
});

// Abrir el modal de recuperar contraseña
forgotPasswordLink.addEventListener('click', (e) => {
    e.preventDefault();
    forgotPasswordModal.style.display = 'flex';
});

// Cerrar el modal de recuperar contraseña
closeForgotModal.addEventListener('click', () => {
    forgotPasswordModal.style.display = 'none';
});

// Cerrar el modal al hacer clic fuera de él
window.addEventListener('click', (e) => {
    if (e.target === registerModal) {
        registerModal.style.display = 'none';
    } else if (e.target === forgotPasswordModal) {
        forgotPasswordModal.style.display = 'none';
    }
});

// Simular envío de correo de recuperación de contraseña
forgotPasswordForm.addEventListener('submit', (e) => {
    e.preventDefault();
    // Simulación de envío de correo
    emailSentMessage.style.display = 'block';
    setTimeout(() => {
        forgotPasswordModal.style.display = 'none';
        emailSentMessage.style.display = 'none';
        forgotPasswordForm.reset();
    }, 2000); // Cierra el modal después de 2 segundos
});