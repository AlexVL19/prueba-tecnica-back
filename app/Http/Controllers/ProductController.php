<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /* Función que permite mostrar los productos que están activos en la base de datos.
    TODO: añadir a la query una condición que permite no mostrar los registros que no tengan stock */
    public function showProducts() {
        $query_show_products = 'SELECT * FROM product WHERE is_active = 1';

        $result_show_products = DB::connection()->select(DB::raw($query_show_products));

        return $result_show_products;
    }

    /* Función que permite añadir un producto; primero valida los datos de la petición, luego ejecuta la query con los datos
    ya validados. */
    public function addProduct(Request $request) {

        $fields = $request->validate([
            'codigo' => 'required',
            'nombre_producto' => 'required|string',
            'precio' => 'required',
            'stock_inicial' => 'required',
        ]);

        $query_add_products = 'INSERT INTO product (code, product_name, price, stock) VALUES (?, ?, ?, ?)';

        return DB::connection()->select(DB::raw($query_add_products), [
            $fields['codigo'],
            $fields['nombre_producto'],
            $fields['precio'],
            $fields['stock_inicial']
        ]);
    }

    /* Función que permite desactivar un producto con base a su ID. Dentro del objeto request se encuentra la ID del producto */
    public function deleteProduct(Request $request) {
        $query_delete_products = "UPDATE product SET is_active = 0 WHERE id_product = ?";
        
        return DB::connection()->select(DB::raw($query_delete_products), [$request->id]);
    }

    /* Función que permite capturar un producto específico con base a su ID. Se devuelve el registro que se busca. */
    public function getProduct(Request $request) {
        $query_get_product = "SELECT * FROM product WHERE id_product = ? LIMIT 1";

        return DB::connection()->select(DB::raw($query_get_product), [$request->id]);
    }

    /* Función que permite actualizar los datos de un producto específico con base a su ID. Primero se validan los datos y luego
    se ejecuta la query con los campos ya validados, añadiendo su ID. */
    public function updateProduct(Request $request) {
        $fields = $request->validate([
            'id' => 'required',
            'codigo' => 'required',
            'nombre_producto' => 'required|string',
            'precio' => 'required',
            'stock_inicial' => 'required',
        ]);

        $query_update_product = "UPDATE product SET code = ?, product_name = ?, price = ?, stock = ? WHERE id_product = ?";

        return DB::connection()->select(DB::raw($query_update_product), [
            $fields['codigo'],
            $fields['nombre_producto'],
            $fields['precio'],
            $fields['stock_inicial'],
            $fields['id'],
        ]);


    }
}
