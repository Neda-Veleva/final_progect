<?php
use Illuminate\Database\Eloquent\Relations\Pivot;
class Tag extends \Eloquent {
	protected $fillable = ['tag_name'];
        
        protected $table = 'tags';
        protected $posts;
        
        
        public function posts() {
            return $this->belongsToMany('Post');
        }
        
}