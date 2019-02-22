<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;
use App\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use Validator;
use Input;
use Session;
use Redirect;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $topics = topic::paginate(10);

        return View::make('topics.index')->with('topics', $topics);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return View::make('topics.create');
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
          'name' => 'required',
          'content' => 'required',
          'userid' => 'required|numeric|exists:users',
          'foruid' => 'required|numeric|exists:forums'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
          return Redirect::to('admin/topics/create')->withErrors($validator)->withInput(Input::except('password'));
        } else {
          $topic = new topic;
          $topic->name = Input::get('name');
          $topic->content = Input::get('content');
          $topic->userid = Input::get('userid');
          $topic->foruid = Input::get('foruid');
          $topic->created_at = Carbon::now();
          $topic->updated_at = Carbon::now();
          $topic->save();

          Session::flash('message', 'Successfully created topic!');
          return Redirect::to('admin/topics');
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
        $topic = topic::find($id);

        return View::make('topics.show')->with('topic', $topic);

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
        $topic = topic::find($id);

        return View::make('topics.edit')->with('topic', $topic);

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
          'name' => 'required',
          'content' => 'required',
          'userid' => 'required|numeric|exists:users',
          'foruid' => 'required|numeric|exists:forums'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
          return Redirect::to('admin/topics/'.$id.'/edit')->withErrors($validator)->withInput(Input::except('password'));
        } else {
          $topic = topic::find($id);
          $topic->name = Input::get('name');
          $topic->content = Input::get('content');
          $topic->userid = Input::get('userid');
          $topic->foruid = Input::get('foruid');
          $topic->updated_at = Carbon::now();
          $topic->save();

          Session::flash('message', 'Successfully updated topic!');
          return Redirect::to('admin/topics');
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
        $topic = topic::find($id);
        $topic->delete();

        Session::flash('message', 'Successfully deleted topic!');
        return Redirect::to('admin/topics');
    }

    public function g_comments($id)
    {
      $topic = Topic::find($id);
      $comments = $topic->comments()->paginate(5);
      $data = array('comments' => $comments, 'topic' => $topic);

      return View::make('general.comments')->with('data', $data);
    }

    public function topic_create($id)
    {
      return View::make('topics.topic_create')->with('foruid', $id);
    }

    public function topic_store()
    {
      $rules = array(
        'name' => 'required',
        'content' => 'required',
        'userid' => 'required|numeric|exists:users',
        'foruid' => 'required|numeric|exists:forums'
      );

      $validator = Validator::make(Input::all(), $rules);

      if ($validator->fails()) {
        return Redirect::to(Input::post('foruid').'/topic_create')->withErrors($validator)->withInput(Input::except('password'));
      } else {
        $topic = new topic;
        $topic->name = Input::get('name');
        $topic->content = Input::get('content');
        $topic->userid = Input::post('userid');
        $topic->foruid = Input::post('foruid');
        $topic->created_at = Carbon::now();
        $topic->updated_at = Carbon::now();
        $topic->save();

        Session::flash('message', 'Successfully created topic!');
        return Redirect::to('forums/'.Input::post('foruid'));
      }
    }
}
