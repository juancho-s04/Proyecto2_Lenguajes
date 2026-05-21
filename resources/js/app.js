//
// Controla el login desde la vista en Laravel
const loginForm = document.getElementById('loginForm');
const submitButton = document.getElementById('submitButton');
const tokenResult = document.getElementById('tokenResult');
const roleResult = document.getElementById('roleResult');
const statusMessage = document.getElementById('statusMessage');

function resolveRedirectByRole(role) {
    if (role === 'ADMINISTRADOR') {
        return '/admin';
    }
    if (role === 'CLIENTE' || role === 'USUARIO') {
        return '/user';
    }
    return '/';
}

function showStatus(message, type) {
    statusMessage.textContent = message;
    statusMessage.className = `alert alert-${type} status-box d-block`;
}

if (loginForm && submitButton && tokenResult && roleResult && statusMessage) {
    loginForm.addEventListener('submit', async function (event) {
        event.preventDefault();
        submitButton.disabled = true;
        submitButton.textContent = 'Validando acceso...';
        statusMessage.className = 'alert status-box';

        const payload = {
            email: document.getElementById('email').value.trim(),
            password: document.getElementById('password').value
        };

        try {
            const response = await fetch('/api/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            });

            if (!response.ok) {
                throw new Error('Credenciales inválidas o acceso no autorizado.');
            }

            const data = await response.json();
            const token = data.token || '';
            const rol = data.rol || '';

            tokenResult.value = token;
            roleResult.value = rol;

            localStorage.setItem('api_token', token);
            localStorage.setItem('user_role', rol);


            const redirectUrl = resolveRedirectByRole(rol);
            showStatus(`Inicio de sesión exitoso. Redirigiendo a ${redirectUrl}...`, 'success');

            setTimeout(function () {
                window.location.href = redirectUrl;
            }, 900);
        } catch (error) {
            tokenResult.value = '';
            roleResult.value = '';
            showStatus(error.message || 'No fue posible iniciar sesión en este momento.', 'danger');
        } finally {
            submitButton.disabled = false;
            submitButton.textContent = 'Entrar al sistema';
        }
    });
}