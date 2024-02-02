<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Competition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompetitionController extends Controller
{
    public function get_all(Request $request)
    {
        $data = [];
        $q = Competition::with(['quizzes.books', 'quizzes.questions', 'answers'])->get();
        foreach ($q as $i) {
            $data[$i->id] = $i->toArray();
            $allQuestions = $i->quizzes->flatMap(function ($values) {
                return $values->questions;
            });
            $allBooks = $i->quizzes->map(function ($values) {
                return $values->books;
            })->unique('id');

            $data[$i->id]['allQuestions'] = $allQuestions;
            $data[$i->id]['allBooks'] = $allBooks;
        }


        return $data;
    }

    public function get_competition(Request $request)
    {
        if ($request->ifExist) {
            return Competition::all('id')->firstOrFail($request->subject, $request->value);
        } else {
            $q = Competition::with(['quizzes.books', 'quizzes.questions'])
                ->where($request->subject, $request->value)->first();
            $allQuestions = $q->quizzes->flatMap(function ($values) {
                return $values->questions;
            });
            $allBooks = $q->quizzes->map(function ($values) {
                return $values->books;
            })->unique('id');
            $q = $q->toArray();
            $q['allQuestions'] = $allQuestions;
            $q['allBooks'] = $allBooks;
            return $q;
        }
    }
    // public function to delete competition that has no answer
    public function delete_competition(Request $request){
        $q = Competition::doesntHave( 'answers')->where($request->subject, $request->value)->first();
        if (!$q) {
            return response()->json([
                'message' => 'Vous ne pouvez pas supprimer cette competition',
                '_t' => 'Attention',
                '_i'=>'danger'
            ],403);
        }
        DB::beginTransaction();
        try {
            $q->delete();

            DB::commit();
            return response()->json([
                'message' => 'Votre Compétition a été supprimer', '_t' => true,
            ]);

        }catch(\Exception $exception){
            DB::rollBack();
            return $exception;
        }

    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'quizzes' => 'required|array|min:1',
            'period.from' => 'required|date',
            'period.to' => 'required|date',
        ]);
        DB::beginTransaction();
        try {
            $comp = new Competition();
            $comp->name = $request->name;
            $comp->description = $request->description;
            $comp->period = $request->period;
            $comp->user_id = $request->user()->id;
            $comp->avatar = $request->avatar;

            $quizzes = collect($request->quizzes)->map(function ($item) {
                return [
                    'quiz_id' => $item
                ];
            });
            $comp->save();
            $comp->quizzes()->attach($quizzes);
            DB::commit();
            return response()->json([
                'message' => 'Votre Compétition a été réalisé avec succés', '_t' => true,
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            dump($exception->getMessage());
        }

    }

    public function storeAnswer(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:answers,email'
        ]);
        DB::beginTransaction();
        try {
            $answer = new Answer();
            $answer->email = $request->email;
            $answer->content = [
                'correct' => $request->correct,
                'incorrect' => $request->incorrect,
                'percent_corr' => $request->percent_corr,
                'percent_inc' => $request->percent_inc,
            ];
            $answer->competition_id = $request->competition_id;
            $answer->save();
            DB::commit();
            return response()->json([
                'message' => ' Votre réponse ont enregistré', '_t' => true,
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
        }
    }

    public function if_student_exist(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:answers,email'
        ]);
    }
}
