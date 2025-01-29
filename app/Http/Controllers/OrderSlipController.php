<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderSlipRequest;
use App\Http\Requests\UpdateOrderSlipRequest;
use App\Models\OrderSlip;
use App\Models\Product;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class OrderSlipController extends Controller
{
    public function index()
    {
        return Inertia::render('OrderSlip/Index', [
            'orderSlips' => OrderSlip::with('products')->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('OrderSlip/Create');
    }

    public function store(StoreOrderSlipRequest $request)
    {
        $validatedData = $request->validated();

        $tableOccupied = OrderSlip::where('table_number', $validatedData['table_number'])
            ->exists();

        if ($tableOccupied) {
            return to_route('order-slips.create')->with('error', 'Existe uma comanda aberta para esta mesa!');
        }

        $yearMonth = date('Ym');

        $lastOrderSlip = OrderSlip::withTrashed()
            ->where('order_number', 'like', $yearMonth . '%')
            ->latest()
            ->first();

        $nextNumber = 1;

        if ($lastOrderSlip) {
            $lastSequence = substr($lastOrderSlip->order_number, -4);
            $nextNumber = $lastSequence + 1;
        }

        $orderNumber = sprintf('%s_%04d', $yearMonth, $nextNumber);

        $validatedData['order_number'] = $orderNumber;

        OrderSlip::create($validatedData);

        return to_route('order-slips.index')->with('success', 'Comanda criada com sucesso!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        return Inertia::render('OrderSlip/Edit', [
            'orderSlip' => OrderSlip::with('products')->findOrFail($id),
            'products' => Product::select('id', 'name', 'quantity', 'price')->get(),
        ]);
    }

    public function update(UpdateOrderSlipRequest $request, string $id)
    {
        $validatedData = $request->validated();

        $orderSlip = OrderSlip::findOrFail($id);

        foreach ($validatedData['products'] as $product) {
            $productModel = Product::findOrFail($product['product_id']);

            if ($productModel->quantity < $product['quantity']) {
                return to_route('order-slips.index')->with('error', "Quantidade do produto {$productModel->name} inserido é inválida.");
            }

            if ($orderSlip->products->contains($product['product_id'])) {
                $orderSlip->products()->updateExistingPivot($product['product_id'], [
                    'quantity' => DB::raw('quantity + ' . $product['quantity']),
                ]);
            } else {
                $orderSlip->products()->attach($product['product_id'], [
                    'quantity' => $product['quantity'],
                ]);
            }

            $productModel->decrement('quantity', $product['quantity']);
        }

        $orderSlip->load('products');

        $totalPrice = $orderSlip->products->sum(function ($product) {
            return $product->price * $product->pivot->quantity;
        });

        OrderSlip::where('id', $id)->update(['total_price' => $totalPrice]);

        return to_route('order-slips.index')->with('success', 'Produto(s) adicionado(s) com sucesso!');
    }

    public function destroy(OrderSlip $orderSlip)
    {
        $orderSlip->delete();
        $orderSlip->save();

        return to_route('order-slips.index')->with('success', 'Comanda encerada com sucesso!');
    }
}
