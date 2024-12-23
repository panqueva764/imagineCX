<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

/**
 * Class ContactsService
 * Este servicio contiene la lógica de negocio para manejar contactos a través de una API externa.
 */
class ContactsService
{
    protected $baseUrl;
    protected $username;
    protected $password;

    /**
     * Constructor del servicio.
     * Configura las credenciales y la URL base desde la configuración.
     */
    public function __construct()
    {
        $this->baseUrl = config('services.oracle.url');
        $this->username = config('services.oracle.user');
        $this->password = config('services.oracle.password');
    }

    /**
     * Obtiene todos los contactos desde la API.
     *
     * @return array Lista de contactos.
     * @throws \Exception Si ocurre un error en la petición.
     */
    public function getAllContacts()
    {
        $response = $this->makeRequest('GET', 'contacts');

        if ($response['status'] === 200) {
            return json_decode($response['data'], true);
        }

        throw new \Exception("Error al obtener contactos: " . $response['data'], $response['status']);
    }

    /**
     * Obtiene un contacto específico por su ID.
     *
     * @param int $id ID del contacto.
     * @return array Detalles del contacto.
     * @throws \Exception Si ocurre un error en la petición.
     */
    public function getContactById($id)
    {
        $response = $this->makeRequest('GET', "contacts/$id");

        if ($response['status'] === 200) {
            return json_decode($response['data'], true);
        }

        throw new \Exception("Error al obtener contacto: " . $response['data'], $response['status']);
    }

    /**
     * Elimina un contacto por su ID.
     *
     * @param int $id ID del contacto a eliminar.
     * @return array Mensaje de éxito.
     * @throws \Exception Si ocurre un error en la petición.
     */
    public function deleteContact($id)
    {
        $response = $this->makeRequest('DELETE', "contacts/$id");

        if ($response['status'] === 200) {
            return ['message' => 'Contacto eliminado correctamente'];
        }

        throw new \Exception("Error al eliminar contacto: " . $response['data'], $response['status']);
    }

    /**
     * Crea un nuevo contacto en la API.
     *
     * @param array $data Datos del nuevo contacto.
     * @return array Detalles del contacto creado.
     * @throws \Exception Si ocurre un error en la petición.
     */
    public function createContact($data)
    {

        $response = $this->createBody($data);

        if ($response->exception == null) { // Si el contacto fue creado correctamente
            return response()->json($response, 201);
        }

        throw new \Exception("Error al crear contacto: " . $response['data'], $response['status']);
    }

    /**
     * Realiza una petición HTTP a la API.
     *
     * @param string $method Método HTTP (GET, POST, DELETE).
     * @param string $endpoint Endpoint de la API.
     * @param array|null $data Datos a enviar (solo para POST).
     * @return array Respuesta de la API.
     * @throws \Exception Si ocurre un error en cURL.
     */
    private function makeRequest($method, $endpoint, $data = null)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->baseUrl . $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, "$this->username:$this->password");
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept-Language: en-US',
            'Content-Type: application/json',
        ]);

        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        } elseif ($method === 'DELETE') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        }

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if (curl_errno($ch)) {
            throw new \Exception('Error cURL: ' . curl_error($ch));
        }

        return [
            'status' => $httpCode,
            'data' => $response,
        ];
    }

    public function createBody($data)
    {
    
        // Leer las configuraciones desde config/services.php
        $url = config('services.oracle.url') . 'contacts';
        $username = config('services.oracle.user');
        $password = config('services.oracle.password');
    
        // Datos para enviar a la API
        $data = [
            'name' => [
                'first' => $data[0],
                'last' => $data[1],
            ],
            'emails' => [
                [
                    'address' => 'prueba@imaginecx.com',
                    'addressType' => [
                        'id' => 1, // Este valor puede variar según tu API
                    ],
                ]
            ],
            'address' => [
                'city' => $data[2],
                'country' => [
                    'lookupName' => 2, // Aquí debes usar el LookupName en lugar del ID
                ],
                'postalCode' => $data[3],
                'stateOrProvince' => [
                    'id' => 10, // Este valor puede variar según tu API
                ],
                'street' => $data[5],
            ]
        ];
    
        // Inicializar cURL
        $ch = curl_init();
    
        // Configurar opciones de cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true); // Usamos POST para crear el recurso
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Accept-Language: en-US',
        ]);
        curl_setopt($ch, CURLOPT_USERPWD, "$username:$password"); // Autenticación básica
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // Enviar datos en formato JSON
    
        // Ejecutar cURL y obtener la respuesta
        $response = curl_exec($ch);
    
        // Manejar errores de cURL
        if (curl_errno($ch)) {
            return response()->json(['error' => curl_error($ch)], 500);
        }
    
        // Obtener código de respuesta HTTP
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    
        // Verificar si la operación fue exitosa
        if ($httpCode == 201) { // Si el contacto fue creado correctamente
            return response()->json($response, 201);
        }
    
        // Devolver error en caso de fallo
        return response()->json(['error' => "Error HTTP: $httpCode", 'response' => $response], $httpCode);
    }
    
}
