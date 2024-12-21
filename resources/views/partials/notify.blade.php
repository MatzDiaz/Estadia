

    <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="numero">
            
          </a>
          <ul class="dropdown-menu" id="notificaciones-list">
            
          </ul>
        </li>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        async function cargarNotificaciones() {
            try {
                const response = await axios.get('/notificaciones');
                const notificaciones = response.data;

                const listaNotificaciones = document.getElementById('notificaciones-list');
                listaNotificaciones.innerHTML = ''; 

                notificaciones.forEach(notificacion => {
                    const li = document.createElement('li');
                    li.innerHTML = `<a class="dropdown-item" href="#">${notificacion.mensaje}</a>`;
                    listaNotificaciones.appendChild(li);
                });
                


                const numero = document.getElementById('numero');
                numero.innerHTML = `Notificaciones <span class="badge bg-danger">${notificaciones.length}</span>`;

            } catch (error) {
                console.error('Error al cargar las notificaciones:', error);
            }
        }

        cargarNotificaciones();
    </script>

