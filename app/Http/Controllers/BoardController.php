<?php

namespace App\Http\Controllers;

use App\Board;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->middleware('auth');
    }
    public function show( $boardId)
    {
        $board=Board::findOrFail($boardId);
        return $board;
    }
    public function index()
    {
        return Board::all();
    }

    public function store(Request $request)
    {
         Board::create([
             'name'=>$request->name,
             'user_id'=>$request->user_id,
         ]);
         return response()->json(['message'=>'success'],200);
    }
    public function update(Request $request,$boardId)
    {
        $board=Board::find($boardId);
        $board->update($request->all());
        return response()->json(['message'=>'success','board'=>$board],200);
    }
    public function destroy($id)
    {
        if(Board::destroy($id))
        {
            return response()->json(['status'=>'success','message'=>'board deleted successfully']);
        }
        return response()->json(['status'=>'error','message'=>'something went wrong']);
    }











    //
}
