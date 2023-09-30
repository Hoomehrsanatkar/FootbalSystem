<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Game;
use App\Models\UserGame;

class GameController extends Controller
{
    public function vote(Request $request) {

        // FIND DATAS ON DATABASE
        $game = Game::findOrFail($request->game_id);
        $user = User::findOrFail($request->cookie('user_id'));
        $games = $user->votes()->where('game_id', $request->game_id)->get();

        // CREATE RELATION IN DATABASE FOR USER AND GAMES
        UserGame::create([
            'user_id'=>$user->id,
            'game_id'=>$request->game_id,
        ]);

        // CALCULATOR SCORES AND PUT IN DATABASE
        if($request->team_1 == $game->team_1_score && $request->team_2 == $game->team_2_score){
            User::where('id', $user->id)->update(['score'=>$user->score+10, 'playing_count'=> count(UserGame::get())]);
        }else if($request->team_1 == $request->team_2 && (($request->team_1 - $game->team_1_score) == 1 || ($request->team_2 - $game->team_2_score) == 1 || ($game->team_1_score - $request->team_1) == 1 || ($game->team_2_score - $request->team_2) == 1) && $game->team_1_score == $game->team_2_score) {
            User::where('id', $user->id)->update(['score'=>$user->score+5, 'playing_count'=> count(UserGame::get())]);
        } else if(($request->team_1 - $game->team_1_score) == 1 || ($request->team_2 - $game->team_2_score) == 1 || ($game->team_1_score - $request->team_1) == 1 || ($game->team_2_score - $request->team_2) == 1) {
            User::where('id', $user->id)->update(['score'=>$user->score+3, 'playing_count'=> count(UserGame::get())]);
        } else {
            User::where('id', $user->id)->update(['score'=>$user->score+2, 'playing_count'=> count(UserGame::get())]);
        }

        return response()->json([
            'data'=>'success'
        ]);
    }
}
