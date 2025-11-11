<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use illumunate\Support\Facades\Log;
class PedidodeCompraController extends Controller
{
    public function index()
    {

        $productos = session('productos', []);
        $cliente = session('cliente', []);
        return view('formPrincipal', compact('productos', 'cliente'));
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
        $form = $request->all();
        $itemLines = [];
        if (isset($form['items']) && is_array($form['items'])) {
            foreach ($form['items'] as $item) {
                array_push($itemLines, [
                    "ItemCode" => $item['ItemCode'],//código producto
                    "Quantity" => $item['Quantity'],//cantidad
                    "UnitPrice" => $item['UnitPrice'],//precios de coste
                    "WarehouseCode" => $form['Warehouse']
                ]);
            }
        }else{
            return redirect()->back()->with('error', 'No hay productos en el pedido.');
        }
        $data = [
            "CardCode" => $form['CardCode'],//proveedor
            "U_H8_SYNCHRO" => "S",//si=S  no=N
            "DocumentLines" => $itemLines
        ];
        
        $response = $this->API_call($accion, $data);

        if (isset($response['error'])) {
            return redirect()->back()->with('error', 'Error al crear el pedido de compra: ' . $response['error']);
        }
        return redirect()->back()->with('success', 'Pedido de compra creado exitosamente.');
    }

    public function consultaCompra(Request $request)
    {
        // Lógica para buscar un pedido de compra
        $accion = "consulta_PurchaseOrders";
        $cliente = [
            "select" => "",
            "top" => 10,
        ];
        // Utilizar los criterios de búsqueda proporcionados en el formulario

        $response = $this->API_call($accion, $cliente);
        $compras = $response['value'];
        // dd($compras);
        return view('index', ['compras' => $compras]); // Reemplazar con resultados reales
    }

    public function consultaProducto(Request $request)
    {
        $term = strtoupper(trim($request->get('ItemCode')));
        $term = str_replace("'", "''", $term);

        $accion = "consultar_Items";
        $data = [
            // "select" => "ItemCode,ItemName",
            "where" => "ItemCode eq '$term'",
        ];

        try {
            $response = $this->API_call($accion, $data);
            if ($request->ajax()) {
                // Si es una petición AJAX, devolver JSON
                if (isset($response['value']) && is_array($response['value'])) {
                    return response()->json(['productos' => $response['value'][0]]);
                }
                return response()->json([]);
            } else {
                // Si es una petición normal, guardar en sesión y volver al formulario
                if (isset($response['value']) && is_array($response['value'])) {
                    session(['productos' => $response['value'][0]]);
                }
                return redirect()->route('formPrincipal');
            }
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function addProducto(Request $request)
    {
        // Valida y obtiene los datos
        $validated = $request->validate([
            'ItemCode' => 'required|string',
            'ItemName' => 'required|string',
            'Quantity' => 'required|integer|min:1',
            'UnitPrice' => 'required|numeric|min:0',
        ]);

        $carrito = $request->session()->get('carrito.items', []);

        // Añade o actualiza el producto usando ItemCode como clave
        $carrito[$validated['ItemCode']] = [
            'ItemCode' => $validated['ItemCode'],
            'ItemName' => $validated['ItemName'],
            'Quantity' => (int) $validated['Quantity'],
            'UnitPrice' => (float) $validated['UnitPrice'],
        ];

        $request->session()->put('carrito.items', $carrito);

        return response()->json([
            'success' => true,
            'carrito' => array_values($carrito) // Devuelve como array para JS
        ]);
    }

    public function removeProducto(Request $request)
    {
        $itemCode = $request->input('ItemCode');
        $carrito = $request->session()->get('carrito.items', []);

        if (isset($carrito[$itemCode])) {
            unset($carrito[$itemCode]);
            $request->session()->put('carrito.items', $carrito);
        }

        return response()->json([
            'success' => true,
            'carrito' => array_values($carrito)
        ]);
    }

    public function updateQuantity(Request $request)
    {
        $itemCode = $request->input('ItemCode');
        $newQuantity = (int) $request->input('Quantity');
        $carrito = $request->session()->get('carrito.items', []);

        if (isset($carrito[$itemCode]) && $newQuantity > 0) {
            $carrito[$itemCode]['Quantity'] = $newQuantity;
            $request->session()->put('carrito.items', $carrito);

            return response()->json([
                'success' => true,
                'carrito' => array_values($carrito)
            ]);
        }

        return response()->json(['success' => false, 'error_message' => 'Producto no encontrado o cantidad inválida.']);
    }

    public function fetchCarrito(Request $request)
    {
        $carrito = $request->session()->get('carrito.items', []);

        return response()->json([
            'carrito' => array_values($carrito)
        ]);
    }
}
