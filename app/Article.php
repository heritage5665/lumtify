<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * The draft status
     */
    const STATUS_DRAFT = 1;

    /**
     * The published status
     */
    const STATUS_PUBLISHED = 2;

    /**
     * The archieve status
     */
    const STATUS_ARCHIEVE = 3;

    /**
     * The primary key
     * 
     * @var string
     */
    public $primary = "id";
    
    /**
     * The table
     * 
     * @var string
     */
    protected $table = "articles";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "title", "short_description", "content", "status", "thumbnail", "user_id", "link"
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        "id", "user_id"
    ];

    /**
     * The author relation
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo("App\User", "user_id", "id");
    }

    /**
     * The categories relation.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories()
    {
        return $this->hasMany("App\CategoryRelationship", "article_id", "id");
    }
}
