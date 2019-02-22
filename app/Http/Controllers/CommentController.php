<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Topic;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use Validator;
use Input;
use Session;
use Redirect;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $comments = comment::paginate(10);

        return View::make('comments.index')->with('comments', $comments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return View::make('comments.create');
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
        $rules = array(
          'content' => 'required',
          'userid' => 'required|numeric|exists:users',
          'topiid' => 'required|numeric|exists:topics',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
          return Redirect::to('admin/comments/create')->withErrors($validator)->withInput(Input::except('password'));
        } else {
          $comment = new comment;
          $comment->content = Input::get('content');
          $comment->created_at = Carbon::now();
          $comment->updated_at = Carbon::now();
          $comment->userid = Input::get('userid');
          $comment->topiid = Input::get('topiid');
          $comment->save();

          Session::flash('message', 'Successfully created comment!');
          return Redirect::to('admin/comments');
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
        $comment = comment::find($id);

        return View::make('comments.show')->with('comment', $comment);
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
        $comment = comment::find($id);

        return View::make('comments.edit')->with('comment', $comment);
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
          'content' => 'required',
          'userid' => 'required|numeric|exists:users',
          'topiid' => 'required|numeric|exists:topics',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
          return Redirect::to('admin/comments/'.$id.'/edit')->withErrors($validator)->withInput(Input::except('password'));
        } else {
          $comment = comment::find($id);
          $comment->content = Input::get('content');
          $comment->userid = Input::get('userid');
          $comment->topiid = Input::get('topiid');
          $comment->updated_at = Carbon::now();
          $comment->save();

          Session::flash('message', 'Successfully updated comment!');
          return Redirect::to('admin/comments');
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
        $comment = comment::find($id);
        $comment->delete();

        Session::flash('message', 'Successfully deleted comment!');
        return Redirect::to('admin/comments');
    }

    public function g_create($id)
    {
      $topic = Topic::find($id);
      $comments = $topic->comments()->paginate(5);
      $data = array('comments' => $comments, 'topic' => $topic);

      return View::make('general.comment_create')->with('data', $data);
    }

    public function g_store()
    {
      $rules = array(
        'content' => 'required',
        'userid' => 'required|numeric|exists:users',
        'topiid' => 'required|numeric|exists:topics',
      );

      $validator = Validator::make(Input::all(), $rules);

      if ($validator->fails()) {
        return Redirect::to(Input::post('topiid').'/comments/create')->withErrors($validator)->withInput(Input::except('password'));
      } else {
        $comment = new comment;
        $comment->content = Input::get('content');
        $comment->created_at = Carbon::now();
        $comment->updated_at = Carbon::now();
        $comment->userid = Input::post('userid');
        $comment->topiid = Input::post('topiid');
        $comment->save();

        Session::flash('message', 'Successfully created comment!');

        $topic = Topic::find(Input::post('topiid'));
        $comments = $topic->comments()->paginate(5);
        $data = array('comments' => $comments, 'topic' => $topic);

        return Redirect::to('topics/'.Input::post('topiid'))->with('data', $data);
      }
    }

    public function g_create_quote($id, $content)
    {
      $topic = Topic::find($id);
      $comments = $topic->comments()->paginate(5);
      $data = array('comments' => $comments, 'topic' => $topic, 'quote' => $content);

      return View::make('general.comment_create_quote')->with('data', $data);
    }

    public function g_store_quote()
    {
      $rules = array(
        'content' => 'required',
        'userid' => 'required|numeric|exists:users',
        'topiid' => 'required|numeric|exists:topics',
      );

      $validator = Validator::make(Input::all(), $rules);

      if ($validator->fails()) {
        return Redirect::to(Input::post('topiid').'/comments/create/quote/'.Input::get('quote'))->withErrors($validator)->withInput(Input::except('password'));
      } else {
        $comment = new comment;
        $comment->content = Input::get('content');
        $comment->created_at = Carbon::now();
        $comment->updated_at = Carbon::now();
        $comment->quote = Input::get('quote');
        $comment->userid = Input::post('userid');
        $comment->topiid = Input::post('topiid');
        $comment->save();

        Session::flash('message', 'Successfully created comment!');

        $topic = Topic::find(Input::post('topiid'));
        $comments = $topic->comments()->paginate(5);
        $data = array('comments' => $comments, 'topic' => $topic);

        return Redirect::to('topics/'.Input::post('topiid'))->with('data', $data);
      }
    }

    public function g_destroy($id, $commid)
    {
      $comment = Comment::find($commid);
      $topic = Topic::find($id);
      $comments = $topic->comments()->paginate(5);
      $data = array('comments' => $comments, 'topic' => $topic);
      if (!\Auth::user()->userid == $comment->user->userid)
      {
        Session::flash('message', 'Action denied!');
        return Redirect::to('topics/'.$id)->with('data', $data);
      }
      $comment->delete();

      Session::flash('message', 'Successfully deleted comment!');
      return Redirect::to('topics/'.$id)->with('data', $data);
    }

    public function g_edit($id, $commid)
    {
      $comment = comment::find($commid);
      $topic = Topic::find($id);
      $data = array('topic' => $topic, 'comment' => $comment);

      return View::make('general.comment_edit')->with('data', $data);
    }

    public function g_update($id, $commid)
    {
      $rules = array(
        'content' => 'required'
      );

      $validator = Validator::make(Input::all(), $rules);

      if ($validator->fails()) {
        return Redirect::to($id.'/comments/edit/'.$commid)->withErrors($validator)->withInput(Input::except('password'));
      } else {
        $comment = Comment::find($commid);
        $comment->content = Input::get('content');
        $comment->updated_at = Carbon::now();
        $comment->save();

        Session::flash('message', 'Successfully updated comment!');

        $topic = Topic::find($id);
        $comments = $topic->comments()->paginate(5);
        $data = array('comments' => $comments, 'topic' => $topic);

        return Redirect::to('topics/'.$id)->with('data', $data);
      }
    }
}
