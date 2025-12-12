<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
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
        $accion = "crear_PurchaseOrders";
        $form = $request->all();
        $itemLines = [];
        if (isset($form['items']) && is_array($form['items'])) {
            foreach ($form['items'] as $item) {
                $itemLines[] = [
                    "ItemCode" => $item['ItemCode'],//código producto
                    "Quantity" => (int) $item['Quantity'],//cantidad
                    "UnitPrice" => (float) $item['UnitPrice'],//precios de coste
                    "WarehouseCode" => $form['Warehouse'],
                    "VatGroup" => "S00" //tipo de impuesto S00=sin iva
                ];
            }
        } else {
            return redirect()->back()->with('error', 'No hay productos en el pedido.');
        }
        if (empty($form['CardCode']) || empty($form['Warehouse'])) {
            return redirect()->back()->with('error', 'El código de proveedor y el almacén son obligatorios.');
        }
        $data = [
            "CardCode" => $form['CardCode'],//proveedor
            "U_H8_SYNCHRO" => "S",//si = S  no = N
            "DocumentLines" => $itemLines, //productos
            "Comments" => $form['Comments'] ?? '',//comentarios
        ];
        $response = $this->API_call($accion, $data);
        if (isset($response['error'])) {
            Log::channel('purchase_orders')->error('Error al crear el pedido de compra', ['error' => $response['error'], 'data' => $data]);
            return redirect()->back()->with('error', 'Error al crear el pedido de compra: ' . $response['error']);
        }
        Log::channel('purchase_orders')->info('Pedido de compra creado exitosamente', ['response' => $response, 'data' => $data]);
        return redirect()->back()->with('success', 'Pedido de compra creado exitosamente. Con número: ' . $response['DocNum']);
    }

    public function consultaCompra(Request $request)
    {
        // Lógica para buscar un pedido de compra
        $accion = "consulta_PurchaseOrders";
        $cliente = [
            "select" => "",
            "top" => 10,
        ];

        $response = $this->API_call($accion, $cliente);
        $compras = $response['value'];
        return view('index', ['compras' => $compras]); 
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
                    Log::channel('purchase_orders')->info('Producto encontrado', ['ItemCode' => $term, 'response' => $response['value'][0]]);
                    return response()->json(['productos' => $response['value'][0]]);
                }
                Log::channel('purchase_orders')->warning('Producto no encontrado', ['ItemCode' => $term]);
                return response()->json([]);
            } else {
                // Si es una petición normal, guardar en sesión y volver al formulario
                if (isset($response['value']) && is_array($response['value'])) {
                    session(['productos' => $response['value'][0]]);
                }
                return redirect()->route('formPrincipal');
            }
        } catch (\Exception $e) {
            Log::channel('purchase_orders')->error('Error al consultar el producto', ['error' => $e->getMessage(), 'ItemCode' => $term]);
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

        Log::channel('purchase_orders')->info('Producto añadido al carrito', ['producto' => $validated]);

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
            Log::channel('purchase_orders')->info('Producto eliminado del carrito', ['ItemCode' => $itemCode]);
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
            Log::channel('purchase_orders')->info('Cantidad de producto actualizada', ['ItemCode' => $itemCode, 'newQuantity' => $newQuantity]);

            return response()->json([
                'success' => true,
                'carrito' => array_values($carrito)
            ]);
        }
        Log::channel('purchase_orders')->warning('Error al actualizar la cantidad del producto', ['ItemCode' => $itemCode, 'newQuantity' => $newQuantity]);
        return response()->json(['success' => false, 'error_message' => 'Producto no encontrado o cantidad inválida.']);
    }

    public function fetchCarrito(Request $request)
    {
        $carrito = $request->session()->get('carrito.items', []);

        return response()->json([
            'carrito' => array_values($carrito)
        ]);
    }

    public function clearCarrito(Request $request)
    {
        $request->session()->forget('carrito.items');
        Log::channel('purchase_orders')->info('Carrito limpiado');

        return response()->json(['success' => true]);
    }
    public function logFrontendEvent(Request $request)
    {
        $message = $request->input('message');
        $context = $request->input('context', []);
        Log::channel('purchase_orders')->info($message, $context);
        return response()->json(['success' => true]);
    }
}
