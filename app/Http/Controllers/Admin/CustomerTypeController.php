<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CustomerTypeController extends Controller
{
    public function index()
    {
        $data['title']      = 'Tipos de clientes';
        $data['toptitle']   = 'Tipos de clientes';
        $data['list']       = CustomerType::where('user_id', auth()->user()->id)->get();
        $data['cli']        = true;
        $data['types_cli']  = true;

        return view('admin.customers_type.index', $data);
    }

    public function create()
    {
        $data['title']      = 'Novo tipo de cliente';
        $data['toptitle']   = 'Novo tipo de cliente';
        $data['action']     = route('customers_type.save');
        $data['cli']        = true;
        $data['types_cli']  = true;

        return view('admin.customers_type.create', $data);
    }

    public function edit($id)
    {
        $customer_type = CustomerType::where([
            ['id', '=', $id],
            ['user_id', '=', auth()->user()->id]
        ])->first();


        if (!$customer_type) redirect()->route('anoation');

        $data['title']      = 'Editar tipo cliente ' . $customer_type->title;
        $data['title']      = 'Editar tipo cliente ' . $customer_type->title;
        $data['customer_type']  = $customer_type;
        $data['cli']        = true;
        $data['types_cli']  = true;
        $data['action']     = route('customers_type.update', $customer_type->id);

        return view('admin.customers_type.create', $data);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'title'         => ['required'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('errors', $validate->errors());
        }

        $result = CustomerType::create([
            'title' => $request->title,
            'user_id' => auth()->user()->id,
        ]);

        if (!$result) {
            return redirect()->back()->with('warning', 'error on execution operation');
        }

        return redirect()->route('customers_types')->with('success', 'success on create customer type');
    }

    public function update(Request $request, $id)
    {
        $customer_type = CustomerType::find($id);
        if (!$customer_type) {
            return redirect()->back();
        }

        $validate = Validator::make($request->all(), [
            'title'         => ['required'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('errors', $validate->errors());
        }

        $result = CustomerType::where([
            ['id', '=', $id],
            ['user_id', '=', auth()->user()->id]
        ])->update([
            'title'         => $request->title,
        ]);

        if (!$result) {
            return redirect()->route('customers_types')->with('warning', 'error on execution operation');
        }

        return redirect()->route('customers_types')->with('success', 'success on edit customer type');
    }

    public function delete(Request $request, $id)
    {
        $customer_type = CustomerType::find($id);
        if (!$customer_type) {
            return redirect()->back();
        }

        $result = CustomerType::where([
            ['id', '=', $id],
            ['user_id', '=', auth()->user()->id]
        ])->delete();

        if (!$result) {
            return redirect()->route('customers_types')->with('warning', 'error on execution operation');
        }

        return redirect()->route('customers_types')->with('success', 'success on delete customer type');
    }
}
