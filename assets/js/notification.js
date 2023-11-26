const showNotification = (status, message) => {
    // Crea un nuevo div para la notificación
    const notification = document.createElement('div');
    // Añade las clases para los estilos
    notification.className = 'notification alert fade-out alert-' + status;
    // Añade el contenido de la notificación
    notification.innerHTML = '<i class="fas fa-' + (status === 'success' ? 'info-circle' : 'exclamation-triangle') + '"></i> ' + message;
    // Añade la notificación al cuerpo del documento
    document.body.appendChild(notification);
    // Después de 5 segundos, elimina la notificación
    setTimeout(function () {
        document.body.removeChild(notification);
    }, 5000);
};


async function formSubmit(e) {
    e.preventDefault();
    const form = e.target;
    const btnSubmit = form.querySelector('button[type="submit"]');
    try {
        const endpoint = form.getAttribute('action');
        const formData = new FormData(form);
        btnSubmit.disabled = true;

        const response = await fetch(endpoint, {
            method: 'POST',
            body: formData
        })
        const data = await response.json();

        if (data.status === 'success') {
            Swal.fire({
                title: 'Éxito',
                text: data.message,
                icon: 'success',
                confirmButtonText: 'Ok',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = data.url;
                }
            })


        } else {
            showNotification(data.status, data.message);
        }

    } catch (error) {
        console.error('Error:', error);
        showNotification("danger", "Error");
    } finally {
        btnSubmit.disabled = false;
        // resetea el formulario si no estoy editando
        // para saber si estoy editando un elemento me fijo en el texto del botón submit que contenga la palabra "Crear"
        if (btnSubmit.innerText.includes('Crear')) {
            form.reset();
        }
    }

}

document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.formSubmit');
    if (form) {
        form.addEventListener('submit', formSubmit)
    }
})
