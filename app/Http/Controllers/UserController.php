<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $users = User::all();
        return view('user.index', compact('users'));
    }
    private function uploadUserAvatar(User $user) {
        if($user) {
            if (request()->has('image')) {
                $avatar = request()->file('image');
                $avatarName = 'profile-avatar-'.$user->id . '.' . $avatar->getClientOriginalExtension();
                $avatarPath = public_path('/uploads/');
                if(file_exists(public_path('/uploads/'.$avatarName))) {
                    unlink(public_path('/uploads/'.$avatarName));
                }
                $avatar->move($avatarPath, $avatarName);
                $user->update(['image' => "/uploads/" . $avatarName]);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = $request->input();
        $user = User::create([
            'name' => $input['name'],
            'comment' => $input['comment'],
            'password' => Hash::make($input['password'])
        ]);
        $this->uploadUserAvatar($user);

        return redirect(route('users.index'))->with('message', 'User saved successfully.');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = user::where('id', $id)->first();
        return view('user.view', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = user::where('id', $id)->first();
        return view('user.edit', compact('user'));
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
        //
        $user = user::where('id', $id)->first();
        $user->update(['name' => $request->name, 'comment' => $request->comment ]);
        $this->uploadUserAvatar($user);
        return redirect(route('users.index'))->with('message', 'User updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if($id){

       $user =  User::where('id', $id)->first();
       if( $user ){
        $user->delete();
       }
    }
    return redirect(route('users.index'))->with('message', 'User deleted successfully.');
    }
}
