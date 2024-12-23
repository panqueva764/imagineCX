const contacts = window.contacts;
// Mostrar el primer contacto por defecto
if (contacts.length > 0) {
    showContactDetails(0); // Mostrar el primer contacto
}
// Obtener los contactos desde la API
fetch('http://imaginecx.lndo.site/contacts')
    .then(response => response.text())
    .then(html => {
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        const scriptTags = doc.querySelectorAll('script');
        let contactsData = null;

        scriptTags.forEach(script => {
            if (script.textContent.includes('window.contacts')) {
                const match = script.textContent.match(/window\.contacts\s*=\s*(\[[\s\S]*?\]);/);
                if (match) {
                    contactsData = JSON.parse(match[1]);
                }
            }
        });

        if (contactsData) {
            console.log('Contactos extraídos:', contactsData);
            localStorage.setItem('contactos', JSON.stringify(contactsData)); // Guardar en localStorage
        } else {
            console.error('No se encontró la variable "window.contacts" en el HTML.');
        }
    })
    .catch(error => console.error('Error al obtener datos de la API:', error));

// Función para descargar los datos almacenados en localStorage
function descargarDatos() {
    const data = localStorage.getItem('contactos');
    if (!data) {
        alert('No hay datos en caché para descargar.');
        return;
    }

    const blob = new Blob([data], { type: 'application/json' });
    const url = URL.createObjectURL(blob);

    const a = document.createElement('a');
    a.href = url;
    a.download = 'contactos.json';
    a.click();

    URL.revokeObjectURL(url);
}

// Añadir un botón en el HTML para descargar
document.body.innerHTML += '<button onclick="descargarDatos()" class="download-button" aria-label="Descargar Contactos">  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>    <polyline points="7 10 12 15 17 10"></polyline>    <line x1="12" y1="15" x2="12" y2="3"></line>  </svg></button><style>.download-button {  position: fixed;  bottom: 20px;  right: 20px;  width: 56px;  height: 56px;  border-radius: 50%;  background-color: #007BFF;  color: #FFFFFF;  border: none;  cursor: pointer;  box-shadow: 0 2px 10px rgba(0, 123, 255, 0.5);  transition: all 0.3s ease;  display: flex;  align-items: center;  justify-content: center;  outline: none;}.download-button:hover {  background-color: #0056b3;  box-shadow: 0 4px 15px rgba(0, 123, 255, 0.7);  transform: translateY(-2px);}.download-button:active {  transform: translateY(0);  box-shadow: 0 2px 5px rgba(0, 123, 255, 0.5);}.download-button svg {  width: 24px;  height: 24px;}</style>';

// Función para verificar si el dispositivo está en modo móvil
function isMobile() {
    return window.innerWidth <= 768; // Puedes ajustar este valor según lo que consideres "móvil"
}

// Función para mostrar los detalles del contacto
function showContactDetails(index) {
    const contact = contacts[index];
    if (!contact) return;

    // Datos del contacto
    document.getElementById('contact-name').textContent = contact.lookupName ?? 'No Name';
    document.getElementById('contact-id').textContent = contact.id ?? 'No Name';
    document.getElementById('contact-subtitle').textContent = `Contacto agregado el: ${contact.createdTime ?? 'N/A'}, Actualizado el : ${contact.updatedTime ?? 'N/A'}`;
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

    // Verificar si estamos en modo móvil
    if (isMobile()) {
        // Si estamos en modo móvil, ocultamos la lista y mostramos los detalles
        document.getElementById('contacts-list').style.display = 'none'; 
        document.getElementById('contact-details').style.display = 'block'; 
    }
}

// Función para ocultar los detalles y volver a mostrar la lista (solo en modo móvil)
function hideContactDetails() {
    if (isMobile()) {
        document.getElementById('contacts-list').style.display = 'block';
        document.getElementById('contact-details').style.display = 'none';
    }
}

document.getElementById('closeContactDetailsBtn').addEventListener('click', hideContactDetails);

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


// Obtener el modal y el botón de abrir
var modal = document.getElementById("contactModal");
var openModalBtn = document.getElementById("openModalBtn");
var closeModalBtn = document.getElementById("closeModalBtn");

// Abrir el modal
openModalBtn.onclick = function() {
    modal.style.display = "block";
    toggleCloseButton();  // Llamar a la función para mostrar/ocultar el botón de cerrar
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

// Función para mostrar/ocultar el botón de cerrar según el tamaño de la ventana
function toggleCloseButton() {
    if (isMobile()) {
        closeModalBtn.style.display = 'block';  // Mostrar el botón en móvil
    } else {
        closeModalBtn.style.display = 'none';  // Ocultar el botón en desktop
    }
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

// Llamar a toggleCloseButton cuando la ventana cambie de tamaño
window.onresize = toggleCloseButton;
