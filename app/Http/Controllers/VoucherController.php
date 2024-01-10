<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Voucher;
use App\Models\TenantPurchase;
use App\Models\VoucherRedeem;

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

        $data = [
            'resource' => self::resource,
            'title' => 'Upload Invoice',
            'primary' => $item,
        ];

        return view('vouchers.upload-invoice', $data);
    }

    public function buy(Voucher $voucher, Request $request) {
        $item = $voucher;

        $uuid = $request->file('invoice')->get();

        $purchase = TenantPurchase::where('uuid', $uuid)->first();

        if(!$purchase) return redirect()->back()->with(
            'message', (object) [
                'type' => 'danger',
                'content' => 'No such transaction.',
            ]
        );

        if($purchase->is_used) return redirect()->back()->with(
            'message', (object) [
                'type' => 'danger',
                'content' => 'The uploaded invoice has expired.',
            ]
        );

        $voucherNumber = (int) ($purchase->price / $item->price);

        TenantPurchase::where('id', $purchase->id)
            ->update(['is_used' => true]);

        for ($i=0; $i < $voucherNumber; $i++) {
            VoucherRedeem::create([
                'user_id' => Auth::id(),
                'voucher_id' => $item->id,
                'uuid' => Str::uuid(),
            ]);
        }

        return redirect()->route(self::resource . '.index')->with(
            'message', (object) [
                'type' => 'success',
                'content' => 'Voucher redeemed successfully! See your vouchers on My Vouchers.'
            ]
        );
    }
}
