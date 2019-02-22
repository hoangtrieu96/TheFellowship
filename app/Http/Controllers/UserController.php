<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Validator;
use Input;
use Session;
use Redirect;

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
        $users = user::paginate(10);

        return View::make('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        $user = user::find($id);

        return View::make('users.show')->with('user', $user);
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
        $user = user::find($id);

        return View::make('users.edit')->with('user', $user);
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
        $rules = array(
          'name' => 'required|string|max:255'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
          return Redirect::to('admin/users/'.$id.'/edit')->withErrors($validator)->withInput(Input::except('password'));
        } else {
          $user = user::find($id);
          $user->name = Input::get('name');
          $user->updated_at = Carbon::now();
          $user->role = Input::get('role');
          $user->save();

          Session::flash('message', 'Successfully updated user!');
          return Redirect::to('admin/users');
        }
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
        $user = user::find($id);
        $user->delete();

        Session::flash('message', 'Successfully deleted user!');
        return Redirect::to('admin/users');
    }

    public function profile($id)
    {
      $user = User::find($id);

      return View::make('general.profile')->with('user', $user);
    }
}
