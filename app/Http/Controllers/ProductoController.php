<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    //Listar Productos
    public function index()
    {
        $productos = Producto :: all();

        return response ()->json($productos, 200);
    }

    //Registrar producto
    public function store(Request $request)
    {
        $request->validate ([
            'nombre' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0'
        ]);
    
        $producto = Producto::create($request ->all());

        return response()->json([
            'message' => 'Produto registrado con exito',
            'producto' => $producto
        ],201);
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $request -> validate ([
            'nombre' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0'
        ]);

        $producto ->update($request->all());

        return response()->json([
            'message' => 'Produto actualizado con exito',
            'producto' => $producto
        ],200);
    }


    //Eliminar

    public function destroy($id)
    {
        $producto = Producto::findOrFaild($id);

        $producto -> delete();

        return response()->json([
            'message' => 'Prodicto eliminado correctamente'
        ],200);

    }
}
