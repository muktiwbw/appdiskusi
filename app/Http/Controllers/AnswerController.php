<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Answer;

class AnswerController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Assign parameter ke variabel baru
        $api_token = $request->api_token;
        $question_id = $request->question_id;
        $text = $request->text;

        // Ambil data user yang menjawab berdasarkan api token
        $user = User::where('api_token', $api_token)->first();

        // Buat answer
        $answer = new Answer;
        $answer->text = $text;
        $answer->user_id = $user->id;
        $answer->question_id = $question_id;
        $answer->save();

        // Return response
        return response()->json([
            'message' => 'Jawaban berhasil dibuat',
            'data' => $answer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Assign
        $api_token = $request->api_token;
        $answer_id = $request->answer_id;
        $text = $request->text;

        // Ambil answer
        $answer = Answer::find($answer_id);

        $user = User::where('api_token', $api_token)->first();

        // Cek author/penulis answer
        if($answer->user->id !== $user->id){
            return response()->json([
                'message' => 'Maaf, anda tidak berhak untuk mengupdate jawaban ini'
            ]);
        }

        // Update
        $answer->text = $text;
        $answer->save();

        // Response
        return response()->json([
            'message' => 'Jawaban berhasil diupdate',
            'data' => $answer,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // Assign
        $api_token = $request->api_token;
        $answer_id = $request->answer_id;

        // Ambil answer
        $answer = Answer::find($answer_id);

        $user = User::where('api_token', $api_token)->first();

        // Cek author/penulis answer
        if($answer->user->id !== $user->id){
            return response()->json([
                'message' => 'Maaf, anda tidak berhak untuk mengupdate jawaban ini'
            ]);
        }

        // Update
        $answer->delete();

        // Response
        return response()->json([
            'message' => 'Jawaban berhasil dihapus',
            'data' => $answer,
        ]);
    }
}
