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
}
