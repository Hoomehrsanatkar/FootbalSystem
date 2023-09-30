<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Game;

class DashboardController extends Controller
{
    public function index() {

        // GET USER ON DATABASE
        $user_id = request()->query('id');
        if(!$token) {
            $user_id = request()->cookie('user_id');
        }
        $user = User::find($user_id);
        if(!$user) {
            return redirect('login');
        }
        $user_ip = request()->server('REMOTE_ADDR');

        // GET GAMES ON DATABASE
        $playedGames = $user->votes()->get();
        $currentGames = Game::get();

        return view('dashboard', [
            'user'=> $user,
            'user_ip'=> $user_ip,
            'currentGames'=>$currentGames,
            'playedGames'=> $playedGames
        ]);
    }

    public function search() {
        $users = User::get();

        return response()->json([
            'users'=>$users,
        ]);
    }
}
