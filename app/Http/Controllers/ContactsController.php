<?php

namespace App\Http\Controllers;

use App\Services\ContactsService;
use Illuminate\Http\Request;

/**
 * Class ContactsController
 * Este controlador gestiona las operaciones relacionadas con contactos, incluyendo listar, mostrar, crear y eliminar contactos,
 * delegando la lógica principal a ContactsService.
 */
class ContactsController extends Controller
{
    protected $contactsService;

    /**
     * Constructor del controlador.
     *
     * @param ContactsService $contactsService Servicio que contiene la lógica de negocio para contactos.
     */
    public function __construct(ContactsService $contactsService)
    {
        $this->contactsService = $contactsService;
    }

    /**
     * Muestra la lista de contactos.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse La vista de contactos o un error en formato JSON.
     */
    public function index()
    {
        try {
            $contacts = $this->contactsService->getAllContacts();
            return view('contacts.contacts', compact('contacts'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode() ?: 500);
        }
    }

    /**
     * Muestra un contacto específico por su ID.
     *
     * @param int $id ID del contacto a mostrar.
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse La vista del contacto o un error en formato JSON.
     */
    public function show($id)
    {
        try {
            $contact = $this->contactsService->getContactById($id);
            return view('contacts.contact', compact('contact'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode() ?: 500);
        }
    }

    /**
     * Elimina un contacto por su ID.
     *
     * @param Request $request Solicitud HTTP que contiene el ID del contacto a eliminar.
     * @return \Illuminate\Http\JsonResponse Mensaje de éxito o error en formato JSON.
     */
    public function deleteContact(Request $request)
    {
        try {
            $id = $request->input('id');
            if (!$id) {
                return response()->json(['error' => 'ID de contacto no proporcionado.'], 400);
            }

            $this->contactsService->deleteContact($id);
            return response()->json(['message' => 'Contacto eliminado correctamente.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode() ?: 500);
        }
    }

    /**
     * Crea un nuevo contacto.
     *
     * @param Request $request Solicitud HTTP que contiene los datos del nuevo contacto.
     * @return \Illuminate\Http\JsonResponse Detalles del contacto creado o un error en formato JSON.
     */
    public function createContact(Request $request)
    {
        try {
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
            
            $data = [$firstName,
            $lastName,
            $city,
            $country,
            $zipCode,
            $address];

            $newContact = $this->contactsService->createContact($data);
            return response()->json($newContact, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode() ?: 500);
        }
    }
}
