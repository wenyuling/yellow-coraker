<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAddressRequest;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class UserAddressesController extends Controller
{
    public function index(Request $request)
    {
        return view('user_addresses.index', [
            'addresses' => $request->user()->addresses,
        ]);
    }

    public function create()
    {
        return view('user_addresses.create_and_edit', ['address' => new UserAddress()]);
    }

    /**
     * 新增收货地址
     *
     * @param UserAddressRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserAddressRequest $request)
    {
        $request->user()->addresses()->create($request->only([
            'province',
            'city',
            'district',
            'address',
            'zip',
            'contact_name',
            'contact_phone',
        ]));

        return redirect()->route('user_addresses.index');
    }

    /**
     * 修改收货地址
     *
     * @param UserAddress $user_address
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(UserAddress $user_address)
    {
        $this->authorize('own', $user_address);

        return view('user_addresses.create_and_edit', ['address' => $user_address]);
    }

    /**
     * 更新
     *
     * @param UserAddress $user_address
     * @param UserAddressRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserAddress $user_address, UserAddressRequest $request)
    {
        $this->authorize('own', $user_address);

        $user_address->update($request->only([
            'province',
            'city',
            'district',
            'address',
            'zip',
            'contact_name',
            'contact_phone',
        ]));

        return redirect()->route('user_addresses.index');
    }

    public function destroy(UserAddress $user_address)
    {
        $this->authorize('own', $user_address);

        $user_address->delete();
        return [];
    }
}
