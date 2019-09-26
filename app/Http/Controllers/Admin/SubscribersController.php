<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Subscriber\StoreSubscriber;
use App\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscribersController extends Controller
{
    public function index()
    {
        $subs = Subscription::all();

        return view('admin.subs.index', compact('subs'));
    }

    public function create()
    {
        return view('admin.subs.create');
    }

    public function store(StoreSubscriber $request)
    {
        Subscription::add($request->get('email'));

        return redirect()->route('subscribers.index');
    }

    public function destroy($id)
    {
        Subscription::find($id)->remove();

        return redirect()->route('subscribers.index');
    }
}
