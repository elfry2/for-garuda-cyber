<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    protected const resource = 'vouchers';

    public function index()
    {
        $primary = '\App\Models\\' . str(self::resource)->singular()->title();

        $data = (object) [
            'resource' => self::resource,
            'title' => str(self::resource)->title(),
            'primary' => (new $primary),
        ];

        if (!empty(request('q'))) {
            $data->primary
            = $data->primary->where('name', 'like', '%' . request('q') . '%');
        }

        $data->primary = $data->primary
        ->paginate(config('app.rowsPerPage'))->withQueryString();


        return view(self::resource . '/index', (array) $data);
    }

    public function uploadInvoice(Voucher $voucher, Request $request) {
        $item = $voucher;


    }

    public function buy(Tenant $tenant, Request $request) {
        $purchase = VoucherRedeem::create([
            'user_id' => Auth::id(),
            'tenant_id' => $tenant->id,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route(self::resource . '.purchaseSuccess', [
            'uuid' => $purchase->uuid,
        ]);
    }
}
