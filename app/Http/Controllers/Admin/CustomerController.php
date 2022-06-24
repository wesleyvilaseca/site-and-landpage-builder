<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index()
    {
        $data['title']      = 'Clientes';
        $data['toptitle']   = 'Clientes';
        $data['list']       = Customer::where('user_id', auth()->user()->id)->get();
        $data['cli']        = true;
        $data['clien']      = true;
        return view('admin.customers.index', $data);
    }

    public function create()
    {
        $data['title']              = 'Novo cliente';
        $data['toptitle']           = 'Novo cliente';
        $data['action']             = route('customers.save');
        $data['customers_types']    = CustomerType::where('user_id', auth()->user()->id)->get();
        $data['cli']                = true;
        $data['clien']              = true;

        return view('admin.customers.create', $data);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name'              => ['required'],
            'lastname'          => ['required'],
            'customer_type_id'  => ['required'],
            'email'             => ['required'],
            'phone'             => ['required'],
            'password'          => ['required'],
        ]);

        if ($validate->fails()) return redirect()->back()->with('errors', $validate->errors());


        $result = Customer::create([
            'user_id'           => auth()->user()->id,
            'customer_type_id'  => $request->customer_type_id,
            'name'              => $request->name,
            'lastname'          => $request->lastname,
            'email'             => $request->email,
            'phone'             => $request->phone,
            'password'          => Hash::make($request->password),
            'status'            => $request->status,
        ]);

        if (!$result) return redirect()->back()->with('warning', 'error on execution operation');

        return redirect()->route('customers')->with('success', 'success on create customer type');
    }
}
