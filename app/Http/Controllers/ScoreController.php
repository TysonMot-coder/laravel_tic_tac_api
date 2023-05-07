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
        return response()-> json($scores);
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
        return response()->statusTexts('created') ;
    }

    /**
      * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
     */
   
    public function showById($id){
        $scores = Scores::findOrFail($id);
        if($scores){
            return response()->json(["data"=>$scores]);
        }
        return response()->json([
            'message' => 'No such users on our records'
        ], 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Scores $scores)
    {
       $scores = Scores:: all()->sortBy("name");
       return response()->json(["data"=>$scores]);
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
        Scores::findOrFail($id)->destroy();
        return response()->json(["data" => [
            "success" => true
        ]]);
    }
}
