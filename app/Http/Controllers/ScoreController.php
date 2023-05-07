<?php

namespace App\Http\Controllers;
use App\Models\Scores;
use Illuminate\Http\Request;


class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scores = Scores::orderBy('id','desc')->paginate(5);
        return view('scores.index', compact('scores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required',
            'scores'=>'required',
        ]);
        Scores::create($request->post());
        return redirect()->route('scores.index')->with('success','Player scores saved successfully');
    }

    /**
      * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
     */
   
    public function showById($id){
        $scores = Scores::findOrFail($id);
        return response()->json(["data"=>$scores]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Scores $scores)
    {
        return view('scores.show', compact('scores'));
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
        $scores = Scores::findOrFail($id);
        $scores->update($request->only("name", "score"));
        return response()->json(["data" => [
            "success" => true
        ]]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Scores::findOrFail($id)->delete();
        return response()->json(["data" => [
            "success" => true
        ]]);
    }
}
