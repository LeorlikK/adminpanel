<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Filters\Admin\Posts\PostSearchFilter;
use App\Http\Requests\PostRequest;
use App\Http\Requests\PostSearchRequest;
use App\Http\Resources\Admin\PostResource;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Service\RandomService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    const CLASS_NAME = "posts";

    public function index(PostSearchRequest $request):object
    {
        $request = array_filter($request->validated());
//        dd($request);
        try {
            $data = [
                'class_name' => self::CLASS_NAME,
                'request' => $request,
                'categories' => Category::all(),
                self::CLASS_NAME => PostSearchFilter::post_filter(Post::query(), $request)->paginate(10)
            ];
        } catch (\Exception $exception){
            return abort('500');
        }

        return view('admin.posts.index', compact('data'));
    }

    public function create():object
    {
        try {
            $data = [
                'class_name' => self::CLASS_NAME,
                CategoryController::CLASS_NAME => Category::all(),
                TagController::CLASS_NAME => Tag::all(),
            ];
        } catch (\Exception $exception) {
            return abort('500');
        }
        return view('admin.posts.create', compact('data'));
    }

    public function store(PostRequest $postRequest):object
    {
        $postRequest = $postRequest->validated();
        if (isset($postRequest['tags_id'])){
            $tags_id = $postRequest['tags_id'];
            unset($postRequest['tags_id']);
        }

        try {
            if (isset($postRequest['image'])) $postRequest['image'] = Storage::disk('public')->put('/images', $postRequest['image']);
            $post = Post::firstOrCreate($postRequest);
            if (isset($tags_id)){
                $post->tag()->attach($tags_id);
            }
        } catch (\Exception $exception){
            abort('404');
        }
        return redirect()->route('admin.posts.show', [$post->id]);
    }

    public function show(Post $post):object
    {
        try {
            $data = [
                'class_name' => self::CLASS_NAME,
                self::CLASS_NAME => $post
            ];
            $data['posts']->load('tag');
        } catch (\Exception $exception){
            return abort('404');
        }

        return view('admin.posts.show', compact('data', ));
    }

    public function edit(Post $post):object
    {
        try {
            $data = [
                'class_name' => self::CLASS_NAME,
                self::CLASS_NAME => Post::find($post->id),
                CategoryController::CLASS_NAME => Category::all(),
                TagController::CLASS_NAME => Tag::all()
            ];
        } catch (\Exception $exception){
            return abort('404');
        }
        return view('admin.posts.edit', compact('data'));
    }

    public function update(PostRequest $request, Post $post):object
    {
        $request = $request->validated();

        if (isset($request['image'])) {
            if ($post->image != null){
                Storage::disk('public')->delete('/images', $post->image);
            }
            $request['image'] = Storage::disk('public')->put('/images', $request['image']);
        }

        if (isset($request['tags_id'])) {
            $tags_id = $request['tags_id'];
            unset($request['tags_id']);
        }

        try {
            $post->update($request);
            if (isset($tags_id)){
                $post->tag()->sync($tags_id);
            } else {
                $array = [];
                $post->tag()->sync($array);
            }
        } catch (\Exception $exception){
            return abort('404');
        }
        return redirect()->route('admin.posts.show', [$post->id]);
    }

    public function destroy(Post $post):object
    {
        try {
            if (isset($post->tag[0])) $post->tag()->sync([]);
            if ($post->image != null) Storage::disk('public')->delete('/images', $post->image);
            $post->delete();
        } catch (\Exception $exception){
            return abort('404');
        }
        return redirect()->route('admin.posts.index');
    }
}
