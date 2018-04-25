<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Schedule;
use App\Model\Player;
use App\Model\Type;
use Illuminate\Support\Facades\DB;
use App\Model\History;

class RegisterController extends Controller
{
    public function index()
    {
        $OneDetail =Schedule::where('time','>',date('Y-m-d H:i:s'))->orderBy('time','ASC')->first();
        if($OneDetail){
            $Lists=History::where('schedule_id','=',$OneDetail->id)->where('option','=',1)->get();
            $ListFail=History::where('schedule_id','=',$OneDetail->id)->where('option','=',2)->get();
        }else {
            $Lists= [];
            $ListFail = [];
        }
        return view('register.index', compact('Lists', 'ListFail', 'OneDetail'));
    }

    public function go(Request $request)
    {
        $name = $request->name;
        $option= (int)$request->option;
        $player=Player::where('name',$name)->first();
        if(empty($player)) {
            // add new player
            $player = new Player();
            $player->ip = $request->ip;
            $player->created_at  = time();
            $player->updated_at  = time();
            $player->name = $request->name;
            $player->Save();
            if($player) {
                // add new history of player
                $history = new History();
                $history->schedule_id = $request->id;
                $history->player_id =  $player->id;
                $history->option = $option;
                $history->reliability = $request->reliability;
                $history->updated_at  = time();
                $history->created_at  = time();
                $history->Save();
            } else {
                echo "player chua ton tai";
            }
        }else {
            $history = History::where('player_id', $player->id)->where('schedule_id', $request->id);
            $historyCompare = $history->first();
            if(empty($historyCompare) && !isset($historyCompare)){
                //add new history of player
                $history = new History();
                $history->player_id =  $player->id;
                $history->schedule_id = $request->id;
                $history->option = $option;
                $history->reliability = $request->reliability;
                $history->Save();
            }else{
                if($option === 2){
                    $history->update([
                        'reliability' => $request->reliability,
                        'option' => 2
                    ]);
                    $KQ = "Cập nhật: Bạn đã hủy";

                }elseif ($option === 1){
                    $history->update([
                        'reliability' => $request->reliability,
                        'option' => 1
                    ]);
                }
            }
        }
        $datas = self::getListData($request->id);
        return json_encode($datas);
    }

    public function check(Request $request)
    {
        $name=$request->name;
        $player = Player::where('name', '=', $name)->first();
        $checkName=History::where('player_id',$player->id)->where('schedule_id',$request->id_she)->first();
        return json_encode($checkName);

    }

    private function getListData($sId = 0)
    {
        $Lists=History::join('players', 'historys.player_id', 'players.id')
            ->select('players.name')
            ->where('schedule_id','=',$sId)
            ->where('option','=',1)->get();

        $ListFail=History::join('players', 'historys.player_id', 'players.id')
            ->select('players.name')
            ->where('schedule_id','=',$sId)
            ->where('option','=',2)->get();

        return ['lists' => $Lists, 'listFail' => $ListFail];
    }

}
