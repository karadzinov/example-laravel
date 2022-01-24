<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $statuses = Status::all();
        $data = ['statuses' => $statuses];

        return view('home')->with($data);
    }

    public function createStatus(Request $request)
    {
        $status = Status::create([
            'user_id' => auth()->user()->id,
            'description' => $request->get('description')
        ]);

        return redirect()->route('home');
    }

    public function likeStatus(Status $status)
    {
        $status->likes()->syncWithoutDetaching(\Auth::user()->id);
        return redirect()->route('home');
    }


    public function unlike(Status $status)
    {
        $status->likes()->detach(\Auth::user()->id);
        return redirect()->back();
    }

    public function checkRole()
    {
        dd('Ova e rutata');
    }
}
