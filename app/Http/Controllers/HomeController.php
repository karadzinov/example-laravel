<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\PingdevsMail;

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

    public function mail()
    {
        $ip = \request()->ip();
       // Mail::to('martin@pingdevs.com')->send(new PingdevsMail('Ова е пораката од меилот '. $ip));
        return view('welcome');
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
        $status->likes()->syncWithoutDetaching(auth()->user()->id);

        $userName = auth()->user()->name;
        $message = 'User '. $userName .' liked your status: '. $status->description;


       Mail::to('martin@pingdevs.com')->send(new TestMail($userName, $message));


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
