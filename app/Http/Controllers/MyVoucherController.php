<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\VoucherRedeem;

class MyVoucherController extends Controller
{
    protected const resource = 'my-vouchers';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = (object) [
            'resource' => self::resource,
            'title' => str(self::resource)->title(),
            'primary' => Auth::user()->vouchers(),
        ];

        if (!empty(request('q'))) {
            $data->primary
            = $data->primary->where('name', 'like', '%' . request('q') . '%');
        }

        $data->primary = $data->primary
        ->paginate(config('app.rowsPerPage'))->withQueryString();


        return view(self::resource . '/index', (array) $data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
