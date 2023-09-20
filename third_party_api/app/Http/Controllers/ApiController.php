<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function purchase(Request $request)
    {
        $hash = $request->get('hash');

        $last = intval(substr($hash, -1));

        $message = 'Ödemeniz gerçekleştirilemedi.';

        if ($last % 2 === 0) {
            return response([
                'status' => false,
                'message' => $message,
            ]);
        } else {
            $status = rand(0, 1);

            if ($status) {
                return response([
                    'status' => true,
                    'expire_date' => Carbon::now('-6')->addDays(rand(-7, 2))->format('Y-m-d H:i:s'),
                ]);
            } else {
                return response([
                    'status' => false,
                    'message' => $message,
                ]);
            }
        }
    }

    public function check(Request $request)
    {
        $hash = $request->get('hash'); // Apple veya Google bu hash değerini kendi veritabanında kontrol ediyor varsayalım..
        $expire_date = $request->get('expire_date');

        if (Carbon::parse($expire_date)->lt(now())) {
            return response([
                'status' => false,
                'message' => 'Abonelik bitmiş..',
            ]);
        } else {
            return response([
                'status' => true,
            ]);
        }
    }
}
