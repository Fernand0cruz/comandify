<?php

namespace App\Http\Controllers;

use App\Models\OrderSlip;

class DeleteAllOrderSlips extends Controller
{
    public function __invoke()
    {
        OrderSlip::query()->delete();
        return to_route('order-slips.index')->with('success', 'Todas as comandas foram excluidas com sucesso!');
    }
}
