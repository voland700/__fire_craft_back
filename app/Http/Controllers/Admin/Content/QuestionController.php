<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::paginate(40);
        return view('admin.content.question.index', compact('questions'));
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $question = Question::find($id);
        if($question->shown == 0 ) {
            $question->shown++;
            $question->update();
        }
        return view('admin.content.question.show', compact('question'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::find($id);
        $question->delete();
        return redirect()->route('question.index')->with('success', 'Сообщение удалено');
    }

    public function getQuestion(Request $request)
    {
        $messages = [
            'name.required' => 'Поле "Имя" обязательно для заполнения',
            'email.required' => 'Укажите Email адрес',
        ];
        $this->validate($request, [
            'name' => 'required',
            'email' => 'email:rfc,dns|required',
        ], $messages);

        $question = new Question($request->all());
        $question->save();
        return response()->json(['success' => '200']);
    }
}
