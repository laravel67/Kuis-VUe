<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuizRequest;
use App\Models\Quiz;
use App\Models\Tier;
use Inertia\Inertia;
use App\Models\Answer;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{

    public function index()
    {
        $data = [
        'namepage' => 'Soal',
        'tiers' => Tier::orderBy('id', 'desc')->with('quizzes')->get()
    ];
    return Inertia::render('Quiz/Index', $data);
}


    public function create()
    {
        return Inertia::render('Quiz/Create',[
            'tiers'=>Tier::all(),
            'points'=>range(5, 100, 5)
        ]);
    }

    public function store(StoreQuizRequest $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            foreach ($validated['questions'] as $question) {
                $quiz = Quiz::create([
                    'tier_id' => $validated['tierId'],
                    'quiz_text' => $question['quiz_text'],
                    'point' => $question['points'] ?? 0,
                    'correct_answer' => $question['correctAnswer'] ?? 0,
                ]);
                foreach ($question['options'] as $option) {
                    Answer::create([
                        'quiz_id' => $quiz->id,
                        'answer' => $option,
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('quizs.index')->with('success', 'Data saved successfully!');
    
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('quizs.index')->with('success', 'Data saved successfully!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Quiz $quiz)
    {
        //
    }

    public function edit(Quiz $quiz)
    {
        $quiz->load('answers');
        return Inertia::render('Quiz/Edit', [
            'quiz' => $quiz,
            'tiers' => Tier::all(), 
            'points' => range(5, 100, 5),
        ]);
    }


    public function update(StoreQuizRequest $request, Quiz $quiz)
    {
        $validatedData = $request->validated();

    // Update quiz details
        $quiz->tier_id = $validatedData['tierId'];
        $quiz->quiz_text = $validatedData['questions'][0]['quiz_text'];
        $quiz->point = $validatedData['questions'][0]['points'];
        $quiz->correct_answer = $validatedData['questions'][0]['correctAnswer'];
        $quiz->save();
        $quiz->answers()->delete();
        $options = $validatedData['questions'][0]['options'];
        foreach ($options as $option) {
            $quiz->answers()->create([
                'answer' => $option,
            ]);
        }
        return redirect()->route('quizs.index')->with('success', 'Quiz updated successfully.');
    }


    public function destroy(Quiz $quiz)
    {
        //
    }

    public function showQuizs($slug)
    {
        $tier = Tier::with('quizzes.answers')->where('slug', $slug)->firstOrFail();
    
        return Inertia::render('Quiz/Show', [
            'tier' => $tier,
            'quizzes' => $tier->quizzes,
            'tierName' => $tier->name,
            'answers' => $tier->quizzes->mapWithKeys(function ($quiz) {
                return [$quiz->id => $quiz->answers];
            }),
        ]);
    }      
}
