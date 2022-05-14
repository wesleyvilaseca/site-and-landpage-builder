<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Qrcode;
use chillerlan\QRCode\QRCode as QRCodeQRCode;
use chillerlan\QRCode\QROptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class QrcodeController extends Controller
{
    public function index()
    {
        $data['title']      = 'Posts';
        $data['toptitle']   = 'Posts';
        $data['list']       = Qrcode::all();
        $data['qr']         = true;

        return view('admin.qrcode.index', $data);
    }

    public function create()
    {
        $data['title']      = 'New QrCode';
        $data['toptitle']   = 'New QrCode';
        $data['qr']         = true;
        $data['action']     = route('qrcode.save');

        return view('admin.qrcode.create', $data);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'title'         => ['required'],
            'url'           => ['required'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('errors', $validate->errors());
        }

        $options = new QROptions([
            'version' => 5,
            'outputType' => QRCodeQRCode::OUTPUT_IMAGE_PNG,
            'eccLevel' => QRCodeQRCode::ECC_L,
            'imageBase64' => false 
        ]);

        $qrcode = (new QRCodeQRCode($options))->render($request->url);
        $path = 'user-' . auth()->user()->id . '/' . Str::slug($request->title) . time() . '.png';
        Storage::disk('local')->put('public/' . $path, $qrcode);

        $result = Qrcode::create([
            'title' => $request->title,
            'user_id' => auth()->user()->id,
            'url' => $request->url,
            'qrcode' => $path
        ]);

        if (!$result) {
            return redirect()->back()->with('warning', 'error on execution operation');
        }

        return redirect()->route('qrcode')->with('success', 'success on create qrcode');
    }

}
