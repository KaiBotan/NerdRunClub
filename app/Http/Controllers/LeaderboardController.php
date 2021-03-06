<?php

namespace App\Http\Controllers;

use App\Event;
use App\User;
use NerdRunClub\Calculation;

class LeaderboardController extends Controller
{
    //
    public function index(Calculation $calculation){
        // Get the leaderboard stats
        $leaderboards = $calculation->getLeaderboardStats();
        return view('leaderboards/index', ['leaderboard' => $leaderboards]);
    }

    public function hallOfFame(Calculation $calculation){

        $eventisset = Event::find(1);
        if($eventisset == null || !isset($eventisset) || $eventisset == "" || \App\User::count()<3){
            return view("leaderboards/halloffame", ["eventisset"=> $eventisset]);
        }

        $topfive = [
          "first" => [
              "place" => 1,
              "completed" => 0,
              "user" => ""
          ],
          "second" => [
              "place" => 2,
              "completed" => 0,
              "user" => ""
          ],
          "third" => [
              "place" => 3,
              "completed" => 0,
              "user" => ""
          ]
        ];

        $completedgoals = 0;
        $allusers = User::all();
        $currentWeek = $calculation->currentWeek();
        foreach($allusers as $u){
            $goals = $calculation->weeklyGoalsTree($u, $currentWeek);
            foreach($goals as $goal){
                if($goal === "completed"){
                    $completedgoals += 1;
                }
            }
            if($topfive["first"]["completed"] < $completedgoals || $topfive["first"]["completed"] == 0 && $topfive["first"]["user"] == ""){
                $topfive["first"]["completed"] = $completedgoals;
                $topfive["first"]["user"] = $u;
            }elseif($topfive["second"]["completed"] < $completedgoals || $topfive["second"]["completed"] == 0 && $topfive["second"]["user"] == ""){
                $topfive["second"]["completed"] = $completedgoals;
                $topfive["second"]["user"] = $u;
            }elseif($topfive["third"]["completed"] < $completedgoals || $topfive["third"]["completed"] == 0 && $topfive["third"]["user"] == ""){
                $topfive["third"]["completed"] = $completedgoals;
                $topfive["third"]["user"] = $u;
            }else{

            }
            $completedgoals = 0;
        }



        return view("leaderboards/halloffame", ["topthree" => $topfive, "eventisset"=> $eventisset]);
    }
}
