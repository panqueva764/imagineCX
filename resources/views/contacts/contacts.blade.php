<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Contactos</title>
    <link href="{{ asset('css/contacts.css') }}" rel="stylesheet">

</head>
<body>
    <div class="container">
        <header class="header">
            <h1>Mis Contactos</h1>
            <div class="search-container">
                <input type="search" id="search-input" placeholder="Search contacts" class="search-bar" oninput="filterContacts()">
            </div>
            <div class="create-contact-container">
            </div>
            <button id="openModalBtn" class="btn btn-add" aria-label="Add">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
            </svg>
        </button>
            <button id="openSearchModal" class="btn btn-search" aria-label="Search">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                </svg>
            </button>
        </header>
        <main class="content">
    <div class="contacts-list" id="contacts-list">
        @if(isset($contacts['items']) && !empty($contacts['items']))
            @foreach ($contacts['items'] as $index => $contact)
                <div class="contact-item" onclick="showContactDetails({{ $index }})">
                    <div class="avatar" style="background-image: url('https://i.pravatar.cc/150?img={{ $index + 1 }}');"></div>
                    <div class="contact-info">
                        <h3>{{ $contact['lookupName'] ?? 'No Name' }}</h3>
                        <p>City, Country</p>
                    </div>
                </div>
            @endforeach
        @else
            <p class="no-contacts">No contacts found.</p>
        @endif
    </div>

    <div class="contact-details" id="contact-details">
        <div class="contact-header">
            <div class="avatar" id="avatar"></div>
            <div class="contact-header-info">
                <h2 id="contact-name">Select a Contact</h2>
                <p id="contact-id">Your ID is:</p>
                <p id="contact-subtitle">Details will appear here</p>
            </div>
            <button class="closeContactDetailsBtn" id="closeContactDetailsBtn">x</button>
        </div>

        <div class="contact-body">
            <div class="buttons-contact">
                <button id="updateBoton" class="btn btn-edit" data-id="{{ $contact['id'] ?? '' }}" aria-label="Edit">
                    <svg class="icon" viewBox="0 0 24 24">
                        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
                    </svg>
                </button>
                <button id="accionBoton" class="btn btn-delete" data-id="{{ $contact['id'] ?? '' }}" aria-label="Delete">
                    <svg class="icon" viewBox="0 0 24 24">
                        <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z" />
                    </svg>
                </button>
                <button class="btn btn-more" aria-label="More options">
                    <svg class="icon" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="1"></circle>
                        <circle cx="12" cy="5" r="1"></circle>
                        <circle cx="12" cy="19" r="1"></circle>
                    </svg>
                </button>
            </div>

            <div class="info-contact">
                <div class="info">
                    <svg class="icon" viewBox="0 0 24 24">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                    </svg>
                    <p id="contact-phone"></p>
                </div>
                <div class="info">
                    <svg class="icon" viewBox="0 0 24 24">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    <p id="contact-location"></p>
                </div>
                <div class="info">
                    <svg class="icon" viewBox="0 0 24 24">
                        <path d="M3 3h18v18H3zM9 3v18M15 3v18M3 9h18M3 15h18"></path>
                    </svg>
                    <p>Trabaja en:   -</p>
                    <br>
                    <strong><p id="contact-company">  </p></strong>
                </div>
                <div class="info">
                    <svg class="icon icon-favorite" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                    </svg>
                    <p>Añadir a Favoritos</p>
                </div>
                <div class="info">
                    <svg class="icon icon-whatsapp" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"></path>
                    </svg>
                    <p>Conectar a WhatsApp</p>
                </div>
                <div class="info">
                    <svg class="icon" viewBox="0 0 24 24">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v10z"></path>
                        <path d="M7 8h10M7 12h4"></path>
                    </svg>
                    <p>Enviar Mensaje</p>
                </div>
            </div>
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
                    <button type="button" class="close closeContactDetailsBtn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" id="contactId" class="form-control" placeholder="Ingrese el ID del contacto">
                    <button id="searchContact" class="button-search">Buscar</button>
                </div>
            </div>
        </div>
    </div>
    </body>

    <script>
        window.contacts = @json($contacts['items'] ?? []);
    </script>

    <!-- jQuery primero -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- SweetAlert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Archivo JS personalizado -->
    <script src="{{ asset('js/contacts.js') }}"></script>
    <script>
    $(document).ready(function() {
        $('#accionBoton').click(function() {
            const contactId = document.getElementById('contact-id').textContent.trim(); // Obtener el ID del contacto

            if (!contactId) {
                swal({
                        title:'El Id no está disponible!',
                        icon:'error'
                    });    
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
                                title:'Se ha eliminado el contacto Exitosamente!',
                                text:'Si quieres volver recuperarlo, ingresa a la papelera',
                                icon:'success'
                        }); // Muestra el mensaje de éxito

                        setTimeout(function() {
                            location.reload(); // Recarga la página
                        }, 5000); // Recarga la página

                    } else {
                        swal(
                            {
                                title:'Se ha eliminado el contacto Exitosamente!',
                                text:'Si quieres volver recuperarlo, ingresa a la papelera',
                                icon:'success'
                            });                           
                    }
                },
                error: function(xhr, status, error) {
                    // Manejo de errores
                    swal(
                        {
                                title:'Ocurrió un error inesperado, prueba más tarde',
                                icon:'error'
                    });     
                }
            });
        });
    });

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
                    console.log(response);
                    console.log(response);
                    console.log(response);

                    var parsedResponse = JSON.parse(response.original.original);  // Si la respuesta es una cadena dentro de un array
                    // Verificar que la respuesta contiene el ID del nuevo contacto
                    if (response) {
                        swal(
                            {
                                title:'¡Nuevo contacto creado con éxito!',
                                text:" El ID es: " + parsedResponse.id,
                                icon:'success'
                            });    
                    } else {
                        swal(
                            {
                                title:'¡Nuevo contacto creado con éxito!',
                                text:" El ID es: " + parsedResponse.id,
                                icon:'success'
                            });   
                        }
                    
                    modal.style.display = "none"; // Cerrar el modal
                    // Actualizar la lista de contactos o recargar la página
                    setTimeout(function() {
                        location.reload(); // Recarga la página
                    }, 10000); // Recarga la página o actualiza la lista de contactos
                },
                    error: function(xhr, status, error) {
                        swal({
                            title:'Ocurrió un error al crear el contacto.',
                            icon:'error'
                    });    
                }
            });
        }
    </script>
</html>
