<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subscriber\StoreSubscriber;
use App\Mail\SubscribeEmail;
use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubscribeController extends Controller
{
    public function subscribe(StoreSubscriber $request)
    {
        $subs = Subscription::add($request->get('email'));
        $subs->generateToken();
        Mail::to($subs)->send(new SubscribeEmail($subs));

        return redirect()->back()->with('status', 'Check your mailbox!');
    }

    public function verify($token)
    {
        $subs = Subscription::where('token', $token)->firstOrFail();
        $subs->token = null;
        $subs->save();

        return redirect('/')->with('status', 'Ваша почта подтверждена. Спасибо!');
    }
}
