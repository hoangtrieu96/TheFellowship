<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Forum;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use Validator;
use Input;
use Session;
use Redirect;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $forums = forum::paginate(10);

        return View::make('forums.index')->with('forums', $forums);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return View::make('forums.create');
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
          'cateid' => 'required|numeric|exists:categories'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
          return Redirect::to('admin/forums/create')->withErrors($validator)->withInput(Input::except('password'));
        } else {
          $forum = new forum;
          $forum->name = Input::get('name');
          $forum->cateid = Input::get('cateid');
          $forum->created_at = Carbon::now();
          $forum->updated_at = Carbon::now();
          $forum->save();

          Session::flash('message', 'Successfully created forum!');
          return Redirect::to('admin/forums');
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
        $forum = forum::find($id);

        return View::make('forums.show')->with('forum', $forum);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $forum = forum::find($id);

      return View::make('forums.edit')->with('forum', $forum);
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
          'cateid' => 'required|numeric|exists:categories'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
          return Redirect::to('admin/forums/'.$id.'/edit')->withErrors($validator)->withInput(Input::except('password'));
        } else {
          $forum = forum::find($id);
          $forum->name = Input::get('name');
          $forum->cateid = Input::get('cateid');
          $forum->updated_at = Carbon::now();
          $forum->save();

          Session::flash('message', 'Successfully updated forum!');
          return Redirect::to('admin/forums');
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
        $forum = forum::find($id);
        $forum->delete();

        Session::flash('message', 'Successfully deleted forum!');
        return Redirect::to('admin/forums');
    }

    public function g_topics($id)
    {
      $forum = Forum::find($id);
      $topics = $forum->topics()->paginate(5);
      $data = array('topics' => $topics, 'forum' => $forum);

      return View::make('general.topics')->with('data', $data);
    }
}
