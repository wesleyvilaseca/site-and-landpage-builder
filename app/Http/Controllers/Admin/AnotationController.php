<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Supports\support_cripto\Cripto;

class AnotationController extends Controller
{
    public function index()
    {
        $data['title']      = 'Anotacoes';
        $data['toptitle']   = 'Anotacoes';
        $data['list']       = Anotation::where('user_id', auth()->user()->id)->get();
        $data['anot']       = true;

        return view('admin.anotation.index', $data);
    }

    public function create()
    {
        $data['title']      = 'Nova Anotação';
        $data['toptitle']   = 'Nova Anotação';
        $data['anot']         = true;
        $data['action']     = route('anotation.save');

        return view('admin.anotation.create', $data);
    }

    public function edit($id)
    {
        $anotation = Anotation::where([
            ['id', '=', $id],
            ['user_id', '=', auth()->user()->id]
        ])->first();


        if (!$anotation) redirect()->route('anoation');

        $anotation->anotation = is_base64($anotation->anotation) ? Cripto::decrypt($anotation->anotation) : $anotation->anotation;

        $data['title']      = 'Editar Anotação ' . $anotation->title;
        $data['toptitle']   = 'Editar Anotação ' . $anotation->title;
        $data['anotation']  = $anotation;
        $data['anot']       = true;
        $data['action']     = route('anotation.update', $anotation->id);

        return view('admin.anotation.create', $data);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'title'         => ['required'],
            'anotation'     => ['required'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('errors', $validate->errors());
        }

        $result = Anotation::create([
            'title' => $request->title,
            'user_id' => auth()->user()->id,
            'anotation' => Cripto::encrypt($request->anotation)
        ]);

        if (!$result) {
            return redirect()->back()->with('warning', 'error on execution operation');
        }

        return redirect()->route('anotation')->with('success', 'success on create qrcode');
    }

    public function update(Request $request, $id)
    {
        $anotation = Anotation::find($id);
        if (!$anotation) {
            return redirect()->back();
        }

        $validate = Validator::make($request->all(), [
            'title'         => ['required'],
            'anotation'   => ['required'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('errors', $validate->errors());
        }

        $result = Anotation::where([
            ['id', '=', $id],
            ['user_id', '=', auth()->user()->id]
        ])->update([
            'title'         => $request->title,
            'anotation'     => Cripto::encrypt($request->anotation)
        ]);

        if (!$result) {
            return redirect()->route('anotation')->with('warning', 'error on execution operation');
        }

        return redirect()->route('anotation')->with('success', 'success on edit role');
    }

    public function delete(Request $request, $id)
    {
        $anotation = Anotation::find($id);
        if (!$anotation) {
            return redirect()->back();
        }

        $result = Anotation::where([
            ['id', '=', $id],
            ['user_id', '=', auth()->user()->id]
        ])->delete();

        if (!$result) {
            return redirect()->route('anotation')->with('warning', 'error on execution operation');
        }

        return redirect()->route('anotation')->with('success', 'success on delete role');
    }
}
