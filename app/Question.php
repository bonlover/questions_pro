<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title','body',];
    
    /**
     * The relationship between User model is here.
     *
     * @var array
     */
    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function answers() 
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * The slug attribute's value manupulation will be written here.
     *
     * @var array
     */

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

    public function getUrlAttribute() {
        return route("questions.show", $this->slug);
    }

    public function acceptBestAnswer(Answer $answer)
    {
        $this->best_answer_id = $answer->id;
        $this->save();
    }

    public function getCreatedDateAttribute() {
        return $this->created_at->diffForHumans();
        // return $this->created_at->format("d/m/y");

    }
    public function getStatusAttribute() {
        if ($this->answers_count > 0){
            if ($this->best_answer_id){
                return "answered-accepted";
            }
            return "answered";
        }
        return "unanswered";
    }
    public function getBodyHtmlAttribute() 
    {
        return \Parsedown::instance()->text($this->body);
    }
}
