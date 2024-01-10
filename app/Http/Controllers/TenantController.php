<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Tenant;
use App\Models\TenantPurchase;

class TenantController extends Controller
{
    protected const resource = 'tenants';

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

    public function buy(Tenant $tenant, Request $request) {
        $purchase = TenantPurchase::create([
            'uuid' => Str::uuid(),
            'user_id' => Auth::id(),
            'tenant_id' => $tenant->id,
            'quantity' => $request->quantity,
        ]);

        Storage::disk('public')->put(
            'tenant-purchase-invoices/' . $purchase->uuid . '.invoice',
            $purchase->uuid,
        );

        return redirect()->route(self::resource . '.purchaseSuccess', [
            'uuid' => $purchase->uuid,
        ]);
    }

    public function purchaseSuccess($uuid) {
        return view('tenants/purchase-success', [
            'uuid' => $uuid,
            'resource' => self::resource,
        ]);
    }
    public function downloadInvoice($uuid) {
        return Storage::disk('public')
            ->download("tenant-purchase-invoices/$uuid.invoice");
    }
}
