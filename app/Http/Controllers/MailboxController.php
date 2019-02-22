<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mailbox;
use App\Message;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use Validator;
use Input;
use Session;
use Redirect;

class MailboxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $messages = \Auth::user()->mailbox->messages()->paginate(5);

        return View::make('mailboxes.index')->with('messages', $messages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $email = '';
        return View::make('mailboxes.create')->with('email', $email);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //
        $rules = array(
          'email' => 'required|string|email|max:255|exists:users',
          'title' => 'required',
          'content' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
          return Redirect::to('mailboxes/create')->withErrors($validator)->withInput(Input::except('password'));
        } else {
          $message = new Message;
          $user = User::where('email',Input::get('email'))-> first();
          $message->mailid = $user->mailbox->mailid;
          $message->userid = \Auth::user()->userid;
          $message->title = Input::get('title');
          $message->content = Input::get('content');
          $message->created_at = Carbon::now();
          $message->updated_at = Carbon::now();
          $message->save();

          Session::flash('message', 'Successfully the sent message!');
          return Redirect::to('mailboxes');
        }
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
        $message = Message::find($id);

        return View::make('mailboxes.show')->with('message', $message);
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ////
        $message = Message::find($id);
        $message->delete();

        Session::flash('message', 'Successfully deleted category!');
        return Redirect::to('mailboxes');
    }

    public function reply($id)
    {
      $email = User::find($id)->email;
      return View::make('mailboxes.create')->with('email', $email);
    }
}
