<?php namespace Mcrmc\Scrabble\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Illuminate\Http\Request;
use Mcrmc\Scrabble\Models\Member;
use Mcrmc\Scrabble\Models\Match;

/**
 * Scrabble Control Back-end Controller
 */
class ScrabbleControl extends Controller
{
    /**
     * @var array Behaviors that are implemented by this controller.
     */
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    /**
     * @var string Configuration file for the `FormController` behavior.
     */
    public $formConfig = 'config_form.yaml';

    /**
     * @var string Configuration file for the `ListController` behavior.
     */
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Mcrmc.Scrabble', 'scrabble', 'scrabblecontrol');
    }
    
    /**
     * getMembers
     *
     * @return void
     */
    public function getMembers(){
        return Member::orderBy('id','asc')->get();
    }
    
    /**
     * getLeague
     *
     * @return void
     */
    public function getLeague(){
        return Member::where('matches_played','>=',10)->orderBy('average','desc')->get();
    }
    
    /**
     * getSingleMember
     * 
     * Not Used
     *
     * @param  mixed $memberid
     * @return void
     */
    public function getSingleMember($memberid){
        return Member::find($memberid);
    }
    
    /**
     * Simple addMember Function
     *
     * @param  mixed $req
     * @return void
     */
    public function addMember(Request $req){
        $mem = new Member();
        $mem->name = e($req['name']);
        $mem->active = 1;
        $mem->wins = 0;
        $mem->losses = 0;
        $mem->draws = 0;
        $mem->matches_played = 0;
        $mem->average = 0;
        $mem->save();
        return response()->json(['Saved' => $mem], 200);
    }
    
    /**
     * playMatch
     * 
     * Play Match and update Models
     *
     * @param  mixed $req
     * @return void
     */
    public function playMatch(Request $req){
        $player1 = Member::find(e($req['player1']));
        $player2 = Member::find(e($req['player2']));
        $score1 = e($req['player1Score']);
        $score2 = e($req['player2Score']);
        //add match
        $match = new Match();
        $match->player1 = $player1;
        $match->player2 = $player2;
        $match->player1_score = $score1;
        $match->player2_score = $score2;
        $match->save();
        $mid = $match->id;
        //if match is a draw
        if($score1 === $score2){
            ++$player1->matches_played;
            ++$player1->draws;
            ++$player2->matches_played;
            ++$player2->draws;
            $player1->average = floor(($player1->wins * 100)/$player1->matches_played);
            $player2->average = floor(($player2->wins * 100)/$player2->matches_played);
            //update player matches 
            $matchArr1 = json_decode($player1->matches,true);
            if(!$matchArr1){
                $matchArr1 = [];
            }
            array_push($matchArr1,$mid); 
            $player1->matches = json_encode($matchArr1);
            $matchArr2 = json_decode($player2->matches,true);
            if(!$matchArr2){
                $matchArr2 = [];
            }
            array_push($matchArr2,$mid); 
            $player2->matches = json_encode($matchArr2);
            //save players
            $player1->save();
            $player2->save();
            return response()->json('The Match is a Draw!', 200);
        }
        //if player 1 wins
        elseif($score1 > $score2){
            //update players
            ++$player1->matches_played;
            ++$player2->matches_played;
            ++$player1->wins;
            ++$player2->losses;
            $player1->average = floor(($player1->wins * 100)/$player1->matches_played);
            $player2->average = floor(($player2->wins * 100)/$player2->matches_played);
            //update player matches
            $matchArr1 = json_decode($player1->matches,true);
            if(!$matchArr1){
                $matchArr1 = [];
            }
            array_push($matchArr1,$mid); 
            $player1->matches = json_encode($matchArr1);
            $matchArr2 = json_decode($player2->matches,true);
            if(!$matchArr2){
                $matchArr2 = [];
            }
            array_push($matchArr2,$mid); 
            $player2->matches = json_encode($matchArr2);
            //save players
            $player1->save();
            $player2->save();
            return response()->json('Player 1 Wins!', 200);
        }
        //player 2 wins
        else{
            //update players
            ++$player1->matches_played;
            ++$player2->matches_played;
            ++$player2->wins;
            ++$player1->losses;
            $player1->average = floor(($player1->wins * 100)/$player1->matches_played);
            $player2->average = floor(($player2->wins * 100)/$player2->matches_played);
            //update player matches
            $matchArr1 = json_decode($player1->matches,false);
            if(!$matchArr1){
                $matchArr1 = [];
            }
            array_push($matchArr1,$mid); 
            $player1->matches = json_encode($matchArr1);
            $matchArr2 = json_decode($player2->matches,false);
            if(!$matchArr2){
                $matchArr2 = [];
            }
            array_push($matchArr2,$mid); 
            $player2->matches = json_encode($matchArr2);
            //save players
            $player1->save();
            $player2->save();
            return response()->json('Player 2 Wins!', 200);
        }
    }

}
