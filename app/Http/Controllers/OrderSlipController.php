<?php

namespace App\Http\Controllers;

use App\Models\OrderSlip;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class OrderSlipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('OrderSlip/Index', [
            'orderSlips' => OrderSlip::with('products')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('OrderSlip/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'table_number' => 'required|integer',
            'notes' => 'nullable|string',
        ]);

        $tableOccupied = OrderSlip::where('table_number', $validatedData['table_number'])
            ->whereNotIn('status', ['paid', 'canceled'])
            ->exists();

        if ($tableOccupied) {
            return to_route('order-slip.create')->with('error', 'Existe uma comanda aberta para esta mesa!');
        }

        $yearMonth = date('Ym');

        $lastOrderSlip = OrderSlip::where('order_number', 'like', $yearMonth . '%')->latest()->first();

        $nextNumber = 1;

        if ($lastOrderSlip) {
            $lastSequence = substr($lastOrderSlip->order_number, -4);
            $nextNumber = $lastSequence + 1;
        }

        $orderNumber = sprintf('%s_%04d', $yearMonth, $nextNumber);

        $validatedData['order_number'] = $orderNumber;

        OrderSlip::create($validatedData);

        return to_route('order-slip.index')->with('success', 'Comanda criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return Inertia::render('OrderSlip/Edit', [
            'orderSlip' => OrderSlip::with('products')->findOrFail($id),
            'products' => Product::select('id', 'name', 'quantity', 'price')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'products' => 'required|array',
            'products.*.order_slip_id' => 'required|integer|exists:order_slips,id',
            'products.*.product_id' => 'required|integer|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);
    
        $orderSlip = OrderSlip::findOrFail($id);
    
        foreach ($validatedData['products'] as $product) {
            if ($orderSlip->products->contains($product['product_id'])) {
                $orderSlip->products()->updateExistingPivot($product['product_id'], [
                    'quantity' => DB::raw('quantity + ' . $product['quantity']),
                ]);
            } else {
                $orderSlip->products()->attach($product['product_id'], [
                    'quantity' => $product['quantity'],
                ]);
            }
        }

        $orderSlip->load('products');

        $totalPrice = $orderSlip->products->sum(function ($product) {
            return $product->price * $product->pivot->quantity;
        });

        OrderSlip::where('id', $id)->update(['total_price' => $totalPrice]);

        return to_route('order-slip.index')->with('success', 'Produto(s) atualizado(s) com sucesso!');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderSlip $orderSlip)
    {
        $orderSlip->delete();

        return to_route('order-slip.index')->with('success', 'Comanda excluida com sucesso!');
    }
}
