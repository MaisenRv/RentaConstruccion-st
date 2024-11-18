const registerLink = document.getElementById('register-link');
const registerModal = document.getElementById('register-modal');
const closeRegisterModal = document.getElementById('close-register-modal');
const forgotPasswordLink = document.getElementById('forgot-password-link');
const forgotPasswordModal = document.getElementById('forgot-password-modal');
const closeForgotModal = document.getElementById('close-forgot-modal');
const forgotPasswordForm = document.getElementById('forgot-password-form');
const emailSentMessage = document.getElementById('email-sent-message');



function validateEmail(email) {
    const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return regex.test(email);
}
function validateNotEmpty(field, fieldName,select = false ) {
    if (field.trim() === "" && !select) {
        alert(`${fieldName} no puede estar vacío.`);
        return false;
    }
    if (field == 0 && select) {
        alert(`Debe seleccionar algun elemento en el campo ${fieldName}.`);
        return false;
    }
    return true;
}
const notEmtyForm = (form)=>{
    let inputs = form.querySelectorAll('input, select')
    let isEmty = false
    for (let i = 0; i < inputs.length; i++) {
        if(!validateNotEmpty(inputs[i].value,inputs[i].name)){
            isEmty = true
            break;
        }
        if(inputs[i] instanceof HTMLSelectElement){
            if (!validateNotEmpty(inputs[i].value,inputs[i].name,true)) {
                isEmty = true
                break;
            }
        }
    }
    return isEmty
}
const passCheck = (inputs)=>{
    if (!(inputs[0].value == inputs[1].value)) {
        alert('las contraseñas deben se iguales')
        return true;
    }
    return false;
}

// Validaciones
const formLogin = document.getElementById('formLogin')
formLogin.addEventListener('submit',(e)=>{
    if(notEmtyForm(formLogin)){
        e.preventDefault()
    }
})

const formRegister = document.getElementById('fromRegistro')
formRegister.addEventListener('submit',(e)=>{
    const pass1 = document.getElementById('password-reg');
    const pass2 = document.getElementById('confirm-password');
    if(notEmtyForm(formRegister) || passCheck([pass1,pass2])){
        e.preventDefault()
    }
})





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
// forgotPasswordLink.addEventListener('click', (e) => {
//     e.preventDefault();
//     forgotPasswordModal.style.display = 'flex';
// });

// Cerrar el modal de recuperar contraseña
// closeForgotModal.addEventListener('click', () => {
//     forgotPasswordModal.style.display = 'none';
// });

// Cerrar el modal al hacer clic fuera de él
window.addEventListener('click', (e) => {
    if (e.target === registerModal) {
        registerModal.style.display = 'none';
    } else if (e.target === forgotPasswordModal) {
        forgotPasswordModal.style.display = 'none';
    }
});

// Simular envío de correo de recuperación de contraseña
// forgotPasswordForm.addEventListener('submit', (e) => {
//     e.preventDefault();
//     // Simulación de envío de correo
//     emailSentMessage.style.display = 'block';
//     setTimeout(() => {
//         forgotPasswordModal.style.display = 'none';
//         emailSentMessage.style.display = 'none';
//         forgotPasswordForm.reset();
//     }, 2000); // Cierra el modal después de 2 segundos
// });