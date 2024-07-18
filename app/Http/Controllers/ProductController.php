<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function showProducts() {
        $query_show_products = 'SELECT * FROM products WHERE is_active = 1';

        $result_show_products = DB::connection()->select(DB::raw($query_show_products));

        return $result_show_products;
    }

    public function addProduct(Request $request) {

        $fields = $request->validate([
            'codigo' => 'required',
            'nombre_producto' => 'required|string',
            'precio' => 'required',
            'stock_inicial' => 'required',
        ]);

        $query_add_products = 'INSERT INTO products (code, product_name, price, stock) VALUES (?, ?, ?, ?)';

        return DB::connection()->select(DB::raw($query_add_products), [
            $fields['codigo'],
            $fields['nombre_producto'],
            $fields['precio'],
            $fields['stock_inicial']
        ]);
    }

    public function updateProduct(Request $request) {
        
    }
}
