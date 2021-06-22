<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $addresses = Address::where('user_id', Auth::user()->id)->orderBy('default', 'desc')->get();
        return view('front.address.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('front.address.update');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Address $address)
    {
        $request->validate([
            'name' => 'required|max:100',
            'line1' => 'required|max:500',
            'line1' => 'max:500',
            'country' => 'required|max:100',
            'city' => 'required|max:100',
            'zip_code' => 'required|max:10',
            'phone' => 'required|max:15'
        ]);

        if(is_null($address)) {
            $address = new Address();
        }

        $address = $address->fill($request->all());
        $address->user_id = Auth::user()->id;
        $address->default = $request->has('default');
        $address->save();
        Address::where('user_id', Auth::user()->id)->where('id', '!=', $address->id)->update([
            'default' => false
        ]);
        return redirect()->route('front.user.address', compact('address'))->with('success', 'Data saved.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        return view('front.address.update', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        $address->delete();
        return redirect()->route('front.user.address')->with('success', 'Data deleted.');
    }
}
