<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Filters\Admin\Posts\PostSearchFilter;
use App\Http\Requests\PostRequest;
use App\Http\Requests\PostSearchRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    const CLASS_NAME = "users";

    public function index():object
    {
        try {
            $data = [
                'class_name' => self::CLASS_NAME,
                self::CLASS_NAME => User::paginate(10),
                'role' => User::RoleUser()
            ];
        } catch (\Exception $exception) {
            return abort('404');
        }

        return response()->view('admin.users.index', compact('data'));
    }

    public function create():object
    {
        try {
            $data = [
                'class_name' => self::CLASS_NAME,
                'role' => User::RoleUser()
            ];
        } catch (\Exception $exception) {
            return abort('404');
        }
        return response()->view('admin.users.create', compact('data'));
    }

    public function store(UserRequest $userRequest):object
    {
        try {
            $userRequest = $userRequest->validated();
//            $userRequest['password'] = Str::random(10);
//            Mail::to($userRequest['email'])->send(new PasswordMail($userRequest['password']));
            $userRequest['password'] = Hash::make($userRequest['password']);
//            if ($userRequest['role'] == 500) unset($userRequest['role']);
            $userRequest['name'] = $userRequest['login'];
            unset($userRequest['login']);
            if (isset($userRequest['avatar'])) $userRequest['avatar'] = Storage::disk('public')->put('/avatar', $userRequest['avatar']);
            $user = User::firstOrCreate(['email' => $userRequest['email']], $userRequest);
//            event(new Registered($user));
        } catch (\Exception $exception) {
            return abort('404');
        }

        return redirect()->route('admin.users.index');
    }

    public function show(User $user, Request $request):object
    {
        try {
            $page = $request->page;
            $data = [
                'class_name' => self::CLASS_NAME,
                'users' => User::find($user->id)
            ];
        } catch (\Exception $exception) {
            return abort('404');
        }

//        event(new CommentCreated($data['users']));
        return view('admin.users.show', compact('data', 'page'));
    }

    public function edit(User $user, Request $request):object
    {
        try {
            $page = $request->page;
            $data = [
                'class_name' => self::CLASS_NAME,
                'users' => User::find($user->id),
                'role' => User::RoleUser()
            ];
        } catch (\Exception $exception) {
            return abort('404');
        }

        return view('admin.users.edit', compact('data', 'page'));
    }

    public function update(User $user, UserUpdateRequest $userUpdateRequest):object
    {
        try {
            $page = $userUpdateRequest->page;
            $userUpdateRequest = $userUpdateRequest->validated();
            $userUpdateRequest['name'] = $userUpdateRequest['login'];
            unset($userUpdateRequest['login']);
            if ($userUpdateRequest['password'] == null) unset($userUpdateRequest['password']);
            if (isset($userUpdateRequest['avatar'])){
                if ($user->avatar != null) {
                    Storage::disk('public')->delete('avatar', $user['avatar']);
                }
                $userUpdateRequest['avatar'] = Storage::disk('public')->put('avatar', $userUpdateRequest['avatar']);
            }
            else {
                if (!Hash::check($userUpdateRequest['password'], $user->password)) {
                    $userUpdateRequest['password'] = Hash::make($userUpdateRequest['password']);
                } else {
                    unset($userUpdateRequest['password']);
                }
            }

            $user->update($userUpdateRequest);
        } catch (\Exception $exception) {
            return abort('404');
        }

        return redirect()->route('admin.users.show', [$user->id, "page={$page}"]);
    }

    public function destroy(User $user):object
    {
        try {
            $user->delete();
        } catch (\Exception $exception) {
            return abort('404');
        }

        return redirect()->route('admin.users.index');
    }
}
