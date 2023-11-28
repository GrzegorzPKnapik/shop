<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;

class MailController extends Controller
{

    public function index()
    {
        $data = [
            'subject' => 'Your cart have unavailable product',
            //'body' => 'Jutro kończy się czas edycji twojego koszyka pamiętaj'
            'body' => 'W twojej liście zakupów znajduje się produkt który jest obecnie niedostęny, wymień go na inny, w przeciwnym razie zostanie on pominięty.'
        ];

        try {
           Mail::to('grzegorz.p.knapik@gmail.com')->send(new MailNotify($data));
            return Response()->json(['Great']);
        }catch (\Exception $exception)
        {
            return Response()->json(['Błąd']);
        }

    }
}
