<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Question;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::all();

        return response()->json($questions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Assign input ke variable baru
        $api_token = $request->api_token;
        $title = $request->title;
        $text = $request->text;

        // Ambil data user berdasarkan dengan api token yang masuk
        $user = User::where('api_token', $api_token)->first();

        // Buat question
        $question = new Question;
        $question->title = $title;
        $question->text = $text;
        $question->user_id = $user->id;
        $question->save();

        // Return response
        return response()->json([
            'message' => 'Pertanyaan berhasil dibuat',
            'data' => $question
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // Assign parameter ke variabel baru
        $question_id = $request->question_id;

        // Ambil question sesuai parameter
        $question = Question::find($question_id);
        
        // Return response
        return response()->json([
            'id' => $question->id,
            'title' => $question->title,
            'text' => $question->text,
            'user' => [
                'id' => $question->user->id,
                'email' => $question->user->email,
                'username' => $question->user->username,
            ],
            'answers' => $question->answers,
            'created_at' => $question->created_at,
            'updated_at' => $question->updated_at,
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
        // Assign parameter ke variabel baru
        $question_id = $request->question_id;
        $title = $request->title;
        $text = $request->text;

        // Ambil data question sesuai dengan parameter
        $question = Question::find($question_id);

        // Assign nilai baru ke database
        $question->title = $request->title;
        $question->text = $request->text;
        $question->save();

        // Return response
        return response()->json([
            'message' => 'Data berhasil diupdate',
            'data' => $question
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
        // Assign parameter ke variabel baru
        $question_id = $request->question_id;

        // Ambil data question sesuai dengan parameter
        $question = Question::find($question_id);

        // Delete data
        $question->delete();

        // Return response
        return response()->json([
            'message' => 'Data berhasil dihapus',
            'data' => $question
        ]);
    }
}
