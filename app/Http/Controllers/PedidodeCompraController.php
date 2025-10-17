<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use illumunate\Support\Facades\Log;
class PedidodeCompraController extends Controller
{
    public function index()
    {
        return view('formPrincipal');
    }

    public function API_call($action, $data)
    {
        $response = Http::asForm()->post(env('API_SAP_URL'), [
            'json' => json_encode([
                'accion' => $action,
                'usuario' => env('API_SAP_USER', 'dani'),
                'datos' => $data
            ])
        ]);

        return $response->json();
    }

    public function crearPedido(Request $request)
    {
        // Lógica para crear un pedido de compra         
        $accion = "consulta_PurchaseOrders";
        // $data = $request->all();
        $data = [
            "select" => "",
        ];
        $response = $this->API_call($accion, $data);

        if (isset($response['error'])) {
            return redirect()->back()->with('error', 'Error al crear el pedido de compra: ' . $response['error']);
        }
        dd($response);
        return redirect()->back()->with('success', 'Pedido de compra creado exitosamente.');
    }

    public function consultaCompra(Request $request)
    {
        // Lógica para buscar un pedido de compra
        $accion = "consulta_PurchaseOrders";
        $proveedor= [
            "select" => "",
            "top" => 10,
        ];
        // Utilizar los criterios de búsqueda proporcionados en el formulario

        $response = $this->API_call($accion, $proveedor);
        $compras = $response['value'];
        // dd($compras);
        return view('formPrincipal', ['compras' => $compras]); // Reemplazar con resultados reales
    }

    public function consultaProducto(Request $request)
    {
        $term = strtoupper(trim($request->get('ItemCode')));
        // Sanitizamos la entrada para evitar problemas en el filtro OData
        $term = str_replace("'", "''", $term);

        $accion = "consultar_Items";
        // dd($request->all());
        $data = [
            "select" => "ItemCode,ItemName",
            "where" => "ItemCode eq '$term'",
        ];

        try {
            // Log::info('Enviando datos a SAP', ['accion' => $accion, 'datos' => $data]);
            $response = Http::asForm()->post(env('API_SAP_URL'), [
                'json' => json_encode([
                    'accion' => $accion,
                    'usuario' => 'dani',
                    'datos' => $data
                ])
            ]);

            $result = $response->json();
            // dd($data, ' ', $result);
            // Verificamos si la respuesta contiene la clave 'value' y es un array
            if (isset($result['value']) && is_array($result['value'])) {
                // Log::info('Resultados de la busqueda: ', ['datos' => $result['value']]);

                // CORRECCIÓN CLAVE: Devolvemos una respuesta JSON con la lista de productos.
                return view('formPrincipal', ['productos' => $result['value'][0]]);
            }

            // Si no hay resultados o hay un error, devolvemos un array JSON vacío.
            // Log::warning('La respuesta de SAP no contenía una lista de valores válida.', ['respuesta' => $result]);
            return response()->json([]);

        } catch (\Exception $e) {
            // Log::error('Excepción al consultar productos en SAP', ['exception' => $e->getMessage()]);
            // En caso de error, devolvemos un JSON vacío con un código de error de servidor.
            return response()->json([], 500);
        }
    }

    public function consultaCliente(Request $request)
    {
        //llamada a la API para obtener los clientes
        if (empty($busqueda))
            return [];

        $busquedaConES = $busqueda;
        if (!str_starts_with($busqueda, 'ES')) {
            $busquedaConES = 'ES' . $busqueda;
        }
        $busqueda = str_replace("'", "''", $busqueda);

        $accion = "consultar_BusinessPartners";
        $data = [
            "select" => "CardCode,CardName,Phone1,FederalTaxID",
            "where" => "substringof('$busqueda', CardCode) or substringof('$busqueda', CardName) or substringof('$busqueda', Phone1) or FederalTaxID eq '$busqueda' or FederalTaxID eq '$busquedaConES'"
        ];

        $response = Http::asForm()->post(env('API_SAP_URL'), [
            'json' => json_encode([
                'accion' => $accion,
                'usuario' => env('API_SAP_USER', 'dani'),
                'datos' => $data
            ])
        ]);

        $body = $response->json();
        return ($body['value'] ?? []);    }
}
