<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Vote;

class VoteController extends Controller
{
    
    public function vote(Request $request){
        // Assign
        $api_token = $request->api_token;
        $question_id = $request->question_id;
        $type = $request->type;

        // Ambil user yang menambahkan vote berdasarkan api token
        $user = User::where('api_token', $api_token)->first();

        // Cek apakah user sudah pernah memberi vote ke question ini
        $vote = Vote::where('question_id', $question_id)->where('user_id', $user->id)->first();

        if(isset($vote)){
            if($vote->type === $type){
                return response()->json([
                    'message' => 'Vote berhasil ditambahkan',
                    'data' => $vote,
                ]);
            }
            $vote->delete();
        }

        // Buat vote
        $vote = new Vote;
        $vote->type = $type;
        $vote->user_id = $user->id;
        $vote->question_id = $question_id;
        $vote->save();

        // Response
        return response()->json([
            'message' => 'Vote berhasil ditambahkan',
            'data' => $vote,
        ]);
    }
    
    public function unvote(Request $request){
        // Assign
        $api_token = $request->api_token;
        $question_id = $request->question_id;

        // Ambil user yang menambahkan vote berdasarkan api token
        $user = User::where('api_token', $api_token)->first();

        $vote = Vote::where('question_id', $question_id)->where('user_id', $user->id)->first();

        // Delete vote
        $vote->delete();

        // Response
        return response()->json([
            'message' => 'Vote berhasil dihapus',
            'data' => $vote,
        ]);
    }

}
