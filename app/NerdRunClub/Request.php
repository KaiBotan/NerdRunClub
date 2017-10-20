<?php
/**
 * Created by PhpStorm.
 * User: kjell
 * Date: 20.10.17
 * Time: 17:22
 */

namespace NerdRunClub;


use App\Activity;
use App\User;
use NerdRunClub\Facades\Strava;

class Request
{
    public static function retrieveActivities(){
        $url = 'https://www.strava.com/api/v3/activities/';
        $users = User::all();

        foreach ($users as $u) {
            if(ctype_digit( $u->strava_id )) {
                $config = [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $u->token
                    ]
                ];

                $result = Strava::get($url, $config);
                foreach ($result as $run) {
                    $date = strtotime($run->start_date);
                    $check_activities = Activity::all()->where('strava_id', $run->id)->first();
                    if ($check_activities || $run->max_speed > 4.5) {
                        // Don't Save
                    } else {
                        Activity::create([
                            'name' => $run->name,
                            'user_id' => $u->id,
                            'strava_id' => $run->id,
                            'map_id' => $run->map->id,
                            //'date' => date('d/m/Y H:i:s', $date),
                            'date' => new DateTime($date),
                            'average_speed' => $run->average_speed,
                            'max_speed' => $run->max_speed,
                            'km' => number_format($run->distance / 1000, 2),
                            'minutes' => floor($run->elapsed_time / 60),
                        ]);
                    }
                }
            }
        }
    }
}