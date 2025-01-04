<?php

namespace App\Http\Controllers;

use App\Models\OrderSlip;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Exception;
use PhpParser\Error;

class OrderSlipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderSlips = OrderSlip::with('products')->get();
        return Inertia::render('OrderSlip/Index', ['orderSlips' => $orderSlips]);
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
        
        if($tableOccupied){
            return to_route('order-slip.create')->with('error', 'Existe uma comanda aberta para esta mesa!');
        }

        $yearMonth = date('Ym');

        $lastOrderSlip = OrderSlip::where('order_number', 'like', $yearMonth . '%')->latest()->first();

        $nextNumber = 1;

        if($lastOrderSlip) {
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderSlip $orderSlip)
    {
        $orderSlip->delete();

        return to_route('order-slip.index')->with('success','Comanda excluida com sucesso!');
    }
}
