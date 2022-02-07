<?php

namespace App\Http\Controllers;

use Faker\Provider\Image;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Helper\ImageStore;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $data = ['users' => $users];
        return view('dashboard.users.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'password' => 'required',
            'email' => 'required|unique:users',
        ]);

        if ($validator->fails()) {
            return redirect('admin/users/create')
                ->withErrors($validator)
                ->withInput();
        }

        $name = $request->get('name');
        $email = $request->get('email');
        $password = $request->get('password');



        $imageObj = new ImageStore($request, 'users');

        $image = $imageObj->imageStore();


        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
            'image' => $image
        ]);

        return redirect()->route('users.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $user = User::where('id', '=', $id)->first();

        $data = ['user' => $user];

        return view('dashboard.users.show')->with($data);



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', '=', $id)->first();

        $data = ['user' => $user];

        return view('dashboard.users.edit')->with($data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|unique:users',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::Find($id);

        $input = $request->all();

        if($request->has('password')) {
            $input['password'] = bcrypt($request->get('password'));
        }

        $user->fill($input)->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::Find($id);
        $user->delete();

        return redirect()->route('users.index');
    }

    public function getProducts($id)
    {
        $user = User::FindOrFail($id);
        $data = ['user' => $user];

        return view('dashboard.users.products')->with($data);
    }
}
