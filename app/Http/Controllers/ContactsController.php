<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function index()
    {
        // Leer las configuraciones desde config/services.php
        $url = config('services.oracle.url') . 'contacts';
        $username = config('services.oracle.user');
        $password = config('services.oracle.password');

        // Inicializar cURL
        $ch = curl_init();

        // Configurar opciones de cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Devolver la respuesta como string
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept-Language: en-US',
        ]);
        
        // Configuración de autenticación básica
        curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");

        // Ejecutar cURL y obtener la respuesta
        $response = curl_exec($ch);

        // Comprobar si ocurrió algún error
        if (curl_errno($ch)) {
            // Manejar errores de cURL
            return response()->json(['error' => curl_error($ch)], 500);
        }

        // Verificar si la respuesta es exitosa (código de estado 200)
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Si la respuesta es 200 (OK), continuar con el procesamiento
        if ($httpCode == 200) {
            // Convertir la respuesta JSON a un array
            $contacts = json_decode($response, true);
            return view('contacts.contacts', compact('contacts'));
        }

        // Si no se recibe una respuesta válida, mostrar un error
        return response()->json(['error' => "Error HTTP: $httpCode", 'response' => $response], $httpCode);
    }

    public function show($id)
    {
        // URL de la API para obtener el contacto por ID
        $url = config('services.oracle.url') . 'contacts/' . $id;
        $username = config('services.oracle.user');
        $password = config('services.oracle.password');

        // Inicializar cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept-Language: en-US',
        ]);
        curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");

        // Ejecutar cURL
        $response = curl_exec($ch);

        // Verificar errores de cURL
        if (curl_errno($ch)) {
            return response()->json(['error' => curl_error($ch)], 500);
        }

        // Verificar código de respuesta HTTP
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode == 200) {
            $contact = json_decode($response, true);
            return view('contacts.contact', compact('contact'));
        }

        return response()->json(['error' => "Error HTTP: $httpCode", 'response' => $response], $httpCode);
    }

    public function deleteContact(Request $request)
    {
        // Validar que se recibió el ID
        $id = $request->input('id');
        if (!$id) {
            return response()->json(['error' => 'ID de contacto no proporcionado.'], 400);
        }

        // Leer las configuraciones desde config/services.php
        $url = config('services.oracle.url') . "contacts/$id";
        $username = config('services.oracle.user');
        $password = config('services.oracle.password');

        // Inicializar cURL
        $ch = curl_init();

        // Configurar opciones de cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept-Language: en-US',
        ]);
        curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");

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
        if ($httpCode == 200) {
            return response()->json(['message' => 'Contacto eliminado correctamente.'], 200);
        }

        // Devolver error en caso de fallo
        return response()->json(['error' => "Error HTTP: $httpCode", 'response' => $response], $httpCode);
    }

    public function createContact(Request $request)
    {
        // Validar que se recibieron los datos necesarios
        $firstName = $request->input('firstName');
        $lastName = $request->input('lastName');
        //$email = $request->input('email');
        $city = $request->input('city');
        $country = $request->input('country');
        $zipCode = $request->input('zipCode');
        $address = $request->input('address');
    
        if (!$firstName || !$lastName || !$city || !$country || !$zipCode || !$address) {
            return response()->json(['error' => 'Todos los campos son obligatorios.'], 400);
        }
    
        // Leer las configuraciones desde config/services.php
        $url = config('services.oracle.url') . 'contacts';
        $username = config('services.oracle.user');
        $password = config('services.oracle.password');
    
        // Datos para enviar a la API
        $data = [
            'name' => [
                'first' => $firstName,
                'last' => $lastName,
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
                'city' => $city,
                'country' => [
                    'lookupName' => 2, // Aquí debes usar el LookupName en lugar del ID
                ],
                'postalCode' => $zipCode,
                'stateOrProvince' => [
                    'id' => 10, // Este valor puede variar según tu API
                ],
                'street' => $address,
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
