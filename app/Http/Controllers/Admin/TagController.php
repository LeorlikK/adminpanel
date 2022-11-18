<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Filters\Admin\Posts\PostSearchFilter;
use App\Http\Requests\PostSearchRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class TagController extends Controller
{
    const CLASS_NAME = "tags";

}
