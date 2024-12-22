<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Contactos</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }
        body {
            background-color: #f3f4f6;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            display: flex;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid #e5e7eb;
        }
        .header h1 {
            color: #3b82f6;
            font-size: 1.25rem;
        }
        .search-container {
            display: flex;
            align-items: center;
            margin-left: auto;
        }
        .search-bar {
            background: #f3f4f6;
            border: none;
            padding: 0.5rem 1rem 0.5rem 2rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%239ca3af'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: 0.5rem center;
            background-size: 1rem;
            width: 250px; /* Ajustado el ancho para mejor visualización */
        }
        .content {
            display: flex;
            flex: 1;
            overflow: hidden;
            flex-direction: row; /* Ajustamos la dirección para la versión desktop */
        }
        .contacts-list {
            width: 300px;
            border-right: 1px solid #e5e7eb;
            overflow-y: auto;
            transition: width 0.3s ease-in-out; /* Transición suave para cuando cambie */
        }
        .contact-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid #e5e7eb;
            cursor: pointer;
        }
        .contact-item:hover {
            background-color: #f9fafb;
        }
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #e5e7eb;
            margin-right: 1rem;
        }
        .contact-info h3 {
            font-size: 0.875rem;
            font-weight: 500;
        }
        .contact-info p {
            font-size: 0.75rem;
            color: #6b7280;
        }
        .contact-details {
            flex: 1;
            padding: 2rem;
            display: flex;
            flex-direction: column;
        }
        .contact-header {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
        }
        .contact-header .avatar {
            width: 80px;
            height: 80px;
        }
        .contact-header-info {
            margin-left: 1rem;
        }
        .contact-header-info h2 {
            font-size: 1.5rem;
            font-weight: 600;
        }
        .contact-header-info p {
            color: #6b7280;
        }
        .contact-body > div {
            margin-bottom: 1rem;
        }
        .contact-body h3 {
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        .note {
            background-color: #f3f4f6;
            padding: 1rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
        }
        .icon {
            width: 1rem;
            height: 1rem;
            margin-right: 0.5rem;
            color: #3b82f6;
            vertical-align: middle;
        }
        /* Estilos del Popup */
        .modal {
            display: none; /* Ocultar por defecto */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4); /* Fondo oscuro */
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border-radius: 5px;
            width: 80%;
            max-width: 500px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 10px;
            font-weight: bold;
        }

        input {
            margin-top: 5px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        button {
            padding: 10px;
            background-color: #3b82f6;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2563eb;
        }


        /* Responsive styles */
        @media (max-width: 768px) {
            .content {
                flex-direction: column; /* Coloca la lista y los detalles en columna */
            }
            .contacts-list {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #e5e7eb;
            }
            .search-bar {
                width: 200px; /* Reducimos el tamaño en pantallas pequeñas */
            }
            .contact-header .avatar {
                width: 60px;
                height: 60px;
            }
            .contact-header-info h2 {
                font-size: 1.25rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>Mis Contactos</h1>
            <div class="search-container">
                <input type="search" id="search-input" placeholder="Search contacts" class="search-bar" oninput="filterContacts()">
            </div>
            <div class="create-contact-container">
                <button id="openModalBtn" class="btn btn-primary"> + </button>
            </div>
            <div class="search-contact-container">
                <button id="openSearchModal" class="btn btn-primary">Buscar Contacto</button>
            </div>
        </header>
        <main class="content">
            <div class="contacts-list" id="contacts-list">
                @if(isset($contacts['items']) && !empty($contacts['items']))
                    @foreach ($contacts['items'] as $index => $contact)
                        <div class="contact-item" onclick="showContactDetails({{ $index }})">
                            <div class="avatar" style="background-image: url('https://i.pravatar.cc/150?img={{ $index + 1 }}'); background-size: cover;"></div>
                            <div class="contact-info">
                                <h3>{{ $contact['lookupName'] ?? 'No Name' }}</h3>
                                <p>City, Country</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No contacts found.</p>
                @endif
            </div>
            <div class="contact-details" id="contact-details">
                <div class="contact-header">
                    <div class="avatar" id="avatar" style="background-image: url('https://via.placeholder.com/80'); background-size: cover;"></div>
                    <div class="contact-header-info">
                        <h2 id="contact-name">Select a Contact</h2>
                        <h2 id="contact-id">your id is:</h2>
                        <p id="contact-subtitle">Details will appear here</p>
                    </div>
                </div>
                <div class="contact-body">
                    <div>
                        <h3><i class="icon">&#9742;</i>Phone</h3>
                        <p id="contact-phone"></p>
                    </div>
                    <div>
                        <h3><i class="icon">&#127759;</i>Location</h3>
                        <p id="contact-location"></p>
                    </div>
                    <div>
                        <h3><i class="icon">&#128188;</i>Company</h3>
                        <p id="contact-company"></p>
                    </div>

                    <button id="accionBoton" class="btn btn-primary" data-id="{{ $contact['id'] }}">Eliminar Contacto</button>

                </div>
            </div>
        </main>
    </div>

    <div id="contactModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModalBtn">&times;</span>
            <h2>Crear Nuevo Contacto</h2>
            <form id="createContactForm">
                <label for="firstName">Nombre</label>
                <input type="text" id="firstName" name="firstName" required>

                <label for="lastName">Apellido</label>
                <input type="text" id="lastName" name="lastName" required>

                <label for="city">Ciudad</label>
                <input type="text" id="city" name="city" required>

                <label for="country">País</label>
                <input type="text" id="country" name="country" required>

                <label for="zipCode">Código Postal</label>
                <input type="text" id="zipCode" name="zipCode" required>

                <label for="address">Dirección</label>
                <input type="text" id="address" name="address" required>

                <button type="submit" id="createContactBtn">Crear Nuevo Contacto</button>
            </form>
        </div>
    </div>

    <!-- El Popup -->
    <div id="searchModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Buscar Contacto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" id="contactId" class="form-control" placeholder="Ingrese el ID del contacto">
                    <button id="searchContact" class="btn btn-secondary mt-2">Buscar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Cargar Bootstrap JS después de jQuery -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        const contacts = @json($contacts['items'] ?? []);

        // Mostrar el primer contacto por defecto
        if (contacts.length > 0) {
            showContactDetails(0); // Mostrar el primer contacto
        }

        // Función para mostrar los detalles del contacto
        function showContactDetails(index) {
            const contact = contacts[index];
            if (!contact) return;

            // Datos del contacto
            document.getElementById('contact-name').textContent = contact.lookupName ?? 'No Name';
            document.getElementById('contact-id').textContent = contact.id ?? 'No Name';
            document.getElementById('contact-subtitle').textContent = `Agregaste este contacto en: ${contact.createdTime ?? 'N/A'}, Actualizado en : ${contact.updatedTime ?? 'N/A'}`;
            document.getElementById('avatar').style.backgroundImage = `url('https://i.pravatar.cc/150?img=${index + 1}')`;

            // Datos aleatorios
            const phoneNumbers = ['123-456-7890', '555-123-4567', '987-654-3210'];
            const cities = ['New York', 'London', 'Paris', 'Tokyo', 'Berlin'];
            const countries = ['USA', 'UK', 'France', 'Japan', 'Germany'];
            const companies = ['Company A', 'Company B', 'Company C', 'Company D', 'Company E'];

            // Asignar valores aleatorios
            document.getElementById('contact-phone').textContent = phoneNumbers[Math.floor(Math.random() * phoneNumbers.length)];
            document.getElementById('contact-location').textContent = `${cities[Math.floor(Math.random() * cities.length)]}, ${countries[Math.floor(Math.random() * countries.length)]}`;
            document.getElementById('contact-company').textContent = companies[Math.floor(Math.random() * companies.length)];
        }

        // Función para filtrar los contactos
        function filterContacts() {
            const searchValue = document.getElementById('search-input').value.toLowerCase();
            const filteredContacts = contacts.filter(contact =>
                contact.lookupName && contact.lookupName.toLowerCase().includes(searchValue)
            );

            // Actualizar la lista de contactos con los resultados filtrados
            const contactsList = document.getElementById('contacts-list');
            contactsList.innerHTML = ''; // Limpiar la lista actual

            // Mostrar los contactos filtrados
            if (filteredContacts.length > 0) {
                filteredContacts.forEach((contact, filteredIndex) => {
                    const contactElement = document.createElement('div');
                    contactElement.classList.add('contact-item');
                    contactElement.onclick = () => {
                        // Pasamos el índice del contacto filtrado, no el índice original
                        showContactDetails(filteredIndex);
                    };
                    contactElement.innerHTML = `
                        <div class="avatar" style="background-image: url('https://i.pravatar.cc/150?img=${filteredIndex + 1}'); background-size: cover;"></div>
                        <div class="contact-info">
                            <h3>${contact.lookupName ?? 'No Name'}</h3>
                            <p>City, Countrysss</p>
                        </div>
                    `;
                    contactsList.appendChild(contactElement);
                });
            } else {
                contactsList.innerHTML = '<p>No contacts found.</p>';
            }
        }
        $(document).ready(function() {
            $('#accionBoton').click(function() {
                const contactId = document.getElementById('contact-id').textContent.trim(); // Obtener el ID del contacto

                if (!contactId) {
                    swal('No contact ID available!');
                    return;
                }

                // Realiza la solicitud AJAX a la ruta actual
                $.ajax({
                    url: window.location.href, // Usamos la misma URL de la página
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}', // Token CSRF
                        id: contactId, // Pasamos el ID del contacto a la función deleteContact
                        action: 'delete' // Indica que la acción es de eliminar
                    },
                    success: function(response) {
                        // Verificar si la respuesta tiene el mensaje esperado
                        if (response.message) {
                            swal(
                                {
                                    title:'Se ha eliminado el contacto Exitosamente',
                                    text:'Si quieres volver recuperarlo, ingresa a la papelera',
                                    icon:'success'
                                }); // Muestra el mensaje de éxito
                            // Opcional: Actualizar la página o recargar los contactos
                            setTimeout(function() {
                                location.reload(); // Recarga la página
                            }, 10000); // Recarga la página
                        } else {
                            swal(
                                {
                                    title:'Se ha e',
                                    text:'Si quieres volver recuperarlo, ingresa a la papelera',
                                    icon:'success'
                                });                           
                        }
                    },
                    error: function(xhr, status, error) {
                        // Manejo de errores
                        swal(
                                {
                                    title:'Ocurrió un error',
                                    icon:'error'
                                });     
                    }
                });
            });
        });

        // Obtener el modal y el botón de abrir
        var modal = document.getElementById("contactModal");
        var openModalBtn = document.getElementById("openModalBtn");
        var closeModalBtn = document.getElementById("closeModalBtn");

        // Abrir el modal
        openModalBtn.onclick = function() {
            modal.style.display = "block";
        }

        // Cerrar el modal
        closeModalBtn.onclick = function() {
            modal.style.display = "none";
        }

        // Cerrar el modal si el usuario hace clic fuera del modal
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        // Lógica para enviar el formulario (AJAX o similar)
        document.getElementById("createContactForm").onsubmit = function(e) {
            e.preventDefault();

            // Recoger los datos del formulario
            var formData = {
                firstName: document.getElementById("firstName").value,
                lastName: document.getElementById("lastName").value,
                city: document.getElementById("city").value,
                country: document.getElementById("country").value,
                zipCode: document.getElementById("zipCode").value,
                address: document.getElementById("address").value,
                _token: '{{ csrf_token() }}', // Token CSRF
            };

            // Realizar solicitud AJAX para crear el contacto
            $.ajax({
                    url: '/contacts', // Cambia por la ruta que maneje la creación de contactos en tu backend
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        var parsedResponse = JSON.parse(response);  // Si la respuesta es una cadena dentro de un array
                        // Verificar que la respuesta contiene el ID del nuevo contacto
                        if (response) {
                            swal("¡Nuevo contacto creado con éxito! El ID es: " + parsedResponse.id);
                        } else {
                            swal("¡Nuevo contacto creado con éxito!" + response.id);
                        }
                        
                        modal.style.display = "none"; // Cerrar el modal
                        // Actualizar la lista de contactos o recargar la página
                        setTimeout(function() {
                            location.reload(); // Recarga la página
                        }, 10000); // Recarga la página o actualiza la lista de contactos
                    },
                    error: function(xhr, status, error) {
                        swal("Ocurrió un error al crear el contacto.");
                    }
                });
            }

            // Abrir el modal de búsqueda
            document.getElementById('openSearchModal').addEventListener('click', function() {
                $('#searchModal').modal('show');
            });

            // Buscar contacto
            document.getElementById('searchContact').addEventListener('click', function() {
                var contactId = document.getElementById('contactId').value;
                if (contactId) {
                    // Abrir la nueva pestaña con la URL de búsqueda
                    window.open('/contact/' + contactId, '_blank');
                    $('#searchModal').modal('hide');  // Cerrar el modal
                } else {
                    swal('Por favor, ingrese un ID de contacto.');
                }
            });

    </script>

    </body>
</html>
