<?php

class Blog extends Eloquent
{

    public function getBlogPost($blog_id = NULL, $take = NULL, $skip = NULL)
    {
        $query = DB::table('blog_post');
        $query->where('status', 1);
        $query->orderBy('updated_at', 'desc');
        
        if ($take != NULL)
            $query->take($take);
        
        if ($skip != NULL)
            $query->skip($skip);
        
        return $query;
    }
}