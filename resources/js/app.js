document.addEventListener('DOMContentLoaded', () => {
    
    // 1. Animación de Entrada de página
    document.body.classList.add('loaded');

    // 2. Interceptamos el botón de borrar para darle estilo
    const deleteButtons = document.querySelectorAll('.delete-form button');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault(); // Detener envío inmediato
            
            const form = this.closest('form');
            const row = this.closest('tr');
            
            // Confirmación nativa pero estilizada por el navegador
            // Si quieres algo mas pro, aquí usarías SweetAlert2
            if (confirm('⚠️ ¿Confirma que desea eliminar este usuario?\nEsta acción no se puede deshacer.')) {
                
                // Efecto visual de eliminación antes de enviar
                if(row) {
                    row.style.transition = "all 0.5s ease";
                    row.style.transform = "translateX(50px)";
                    row.style.opacity = "0";
                }

                // Pequeño delay para ver la animación y luego enviar
                setTimeout(() => {
                    form.submit();
                }, 300);
            }
        });
    });

    // 3. Efecto en la barra de búsqueda (opcional)
    const searchInput = document.querySelector('.search-input');
    if(searchInput) {
        searchInput.addEventListener('focus', () => {
            document.querySelector('.search-form').classList.add('focused');
        });
        searchInput.addEventListener('blur', () => {
            document.querySelector('.search-form').classList.remove('focused');
        });
    }
});