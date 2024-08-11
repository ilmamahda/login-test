<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        //get all products
        $orders = Order::select('tb_order.no_table', 'kategori.nama_kategori', 'menu.nama', 'variant.nama_variant', 'tb_order.jumlah', 'menu.harga')
            ->join('menu', 'menu.id', '=', 'tb_order.id_menu')
            ->join('kategori', 'kategori.id', '=', 'menu.id_kategori')
            ->join('variant', 'variant.id', '=', 'menu.id_variant')
            ->get();

        $printA = array();
        $printB = array();
        $printC = array();
        foreach ($orders as $k => $v) {
            $kategori = $v->nama_kategori;
            $total    = $v->jumlah * $v->harga;

            if ($kategori !== 'Promo') {
                $kasir = [
                    'Table' => $v->no_table,
                    'Menu'  => $v->nama . ' ' . $v->nama_variant . ' | ' . $v->jumlah . ' X ' . $v->harga . ' | ' . $total
                ];
            } else {
                $kasir = [
                    'Table' => $v->no_table,
                    'Menu'  => $v->nama . ' | ' . $v->jumlah . ' X ' . $v->harga . ' | ' . $total
                ];
            }

            $printA[$k] = $kasir;

            if ($kategori == 'Makanan') {
                $data = [
                    'Table' => $v->no_table,
                    'Menu'  => $v->jumlah . ' X ' . $v->nama . ' ' . $v->nama_variant
                ];

                $printB[$k] = $data;
            }

            if ($kategori == 'Minuman') {
                $data = [
                    'Table' => $v->no_table,
                    'Menu'  => $v->jumlah . ' X ' . $v->nama . ' ' . $v->nama_variant
                ];

                $printC[$k] = $data;
            }

            if ($kategori == 'Promo') {
                $explode = explode(' + ', $v->nama);
                $makanan = [
                    'Table' => $v->no_table,
                    'Menu'  => $v->jumlah . ' X ' . $explode[0]
                ];
                $minuman = [
                    'Table' => $v->no_table,
                    'Menu'  => $v->jumlah . ' X ' . $explode[1]
                ];

                $printB[$k] = $makanan;
                $printC[$k] = $minuman;
            }
            // $printB[$k] = array_push($data, $makanan);
        }

        $print = [
            'Printer A' => $printA,
            'Printer B' => $printB,
            'Printer C' => $printC
        ];

        return response()->json($print);
    }

    public function getBill($id)
    {
        //get all products
        $orders = Order::select('tb_order.no_table', 'kategori.nama_kategori', 'menu.nama', 'variant.nama_variant', 'tb_order.jumlah', 'menu.harga')
            ->join('menu', 'menu.id', '=', 'tb_order.id_menu')
            ->join('kategori', 'kategori.id', '=', 'menu.id_kategori')
            ->join('variant', 'variant.id', '=', 'menu.id_variant')
            ->where('tb_order.no_table', '=', $id)
            ->get();
        // Get Grand Total
        $total = array();
        foreach ($orders as $k => $v) {
            $jumlah = $v->jumlah * $v->harga;
            $total[$k] = $jumlah;
        }

        $grandtotal = array_sum($total);

        //Get Menu
        $order = array();
        foreach ($orders as $a => $b) {
            $kategori = $b->nama_kategori;
            $total    = $b->jumlah * $b->harga;
            if ($kategori !== 'Promo') {
                $data = $b->nama . ' ' . $b->nama_variant . ' | ' . $b->jumlah . ' X ' . $b->harga . ' | ' . $total;
            } else {
                $data =  $b->nama . ' | ' . $b->jumlah . ' X ' . $b->harga . ' | ' . $total;
            }

            $order[$a] = $data;
        }

        $bill = [
            'Table' => $id,
            'Total Pemesanan' => $grandtotal,
            'Menu'  => $order
        ];

        return response()->json($bill);
    }
}
