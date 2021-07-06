<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getUrlAttribute()
    {
        return "questions/{$this->id}";
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getAnswerStyleAttribute()
    {
        if($this->answers_count > 0){
            if($this->best_answer_id){
                return "has-best-answer";
            }
            return "answered";
        }
        return "unanswered";
    }
    /*
    *   MUTATORS
    */
    public function setTitleAttribute(string $title)
    {
        $this->attributes['title'] = $title;
        $this->attributes['slug'] = Str::slug($title);
    }
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
