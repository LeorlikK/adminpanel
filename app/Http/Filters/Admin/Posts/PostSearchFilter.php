<?php

namespace App\Http\Filters\Admin\Posts;

use Illuminate\Database\Eloquent\Builder;

class PostSearchFilter
{
    public static function post_filter(Builder $query, $filter): object
    {
        if (isset($filter['post_search'])) {
            $query->where('title', 'like', "%{$filter['post_search']}%");
        }
        if (isset($filter['category_search'])) {
            $query->where('category_id',  $filter['category_search']);
        }
        return $query;
    }
}
