<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Notifications\AnswerVotes;
use App\Notifications\QuestionVotes;
use Illuminate\Http\Request;

class VotesController extends Controller
{
    public function votesQuestion(Question $question, int $vote)
    {
        if(auth()->user()->hasVoteForQuestion($question)) {
            if(($vote == 1 && ! auth()->user()->hasQuestionUpVote($question)) ||
              ($vote == -1 && ! auth()->user()->hasQuestionDownVote($question))) {
                $question->updateVote($vote);
                $question->owner->notify(new QuestionVotes($question));
              }
        } else {
            $question->vote($vote);
            $question->owner->notify(new QuestionVotes($question));
        }
        return redirect()->back();
    }

    public function votesAnswer(Answer $answer, int $vote, Question $question)
    {
        if(auth()->user()->hasVoteForAnswer($answer)) {
            if(($vote == 1 && ! auth()->user()->hasAnswerUpVote($answer)) ||
              ($vote == -1 && ! auth()->user()->hasAnswerDownVote($answer))) {
                $answer->updateVote($vote);
                $answer->author->notify(new AnswerVotes($answer, $question));
              }
        } else {
            $answer->vote($vote);
            $answer->author->notify(new AnswerVotes($answer, $question));
        }
        return redirect()->back();
    }
}
