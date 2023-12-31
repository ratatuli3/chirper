<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
// Use the Post Model
use App\Models\User;
// We will use Form Request to validate incoming requests from our store and update method
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Department;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index(Request $request): Response
    // {
    //     $departments = Department::orderBy('updated_at', 'desc')->get();
    //     $order = User::when($request->department_id != null, function ($q) use ($request) {
    //         return $q->where('department_id', (Department::find($request->department_id)->name ?? ''));
    //     });

    //     return response()->view('posts.index', [
    //         'posts' => User::get(),
    //         'posts' => DB::table('users')->paginate(10),
    //         'departments' => $departments,
    //     ]);
    // }

    public function index(Request $request): Response
    {
        $departments = Department::orderBy('updated_at', 'desc')->get();

        $order = User::when($request->department_id != null, function ($q) use ($request) {
            return $q->where('department_id', ($request->department_id));
        });

        $sortBy = $request->sort ?? 'updated_at';
        $orderBy = $request->direction === 'asc' ? 'asc' : 'desc';

        $posts = $order->orderBy($sortBy, $orderBy)->paginate(10);

        return response()->view('posts.index', [
            'posts' => $posts,
            'departments' => $departments,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        $departments = Department::orderBy('updated_at', 'desc')->get();
        return response()->view('posts.form', [
            'departments' => $departments,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // insert only requests that already validated in the StoreRequest
        $create = User::create($validated);

        if ($create) {
            // add flash for the success notification
            session()->flash('notif.success', 'User created successfully!');
            return redirect()->route('posts.index');
        }

        return abort(500);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        return response()->view('posts.show', [
            'post' => User::findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        $departments = Department::orderBy('updated_at', 'desc')->get();
        return response()->view('posts.form', [
            'post' => User::findOrFail($id),
            'departments' => $departments,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id): RedirectResponse
    {
        $post = User::findOrFail($id);
        $validated = $request->validated();

        $update = $post->update($validated);

        if ($update) {
            session()->flash('notif.success', 'Post updated successfully!');
            return redirect()->route('posts.index');
        }

        return abort(500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $post = User::findOrFail($id);

        $delete = $post->delete($id);

        if ($delete) {
            session()->flash('notif.success', 'Post deleted successfully!');
            return redirect()->route('posts.index');
        }

        return abort(500);
    }
}
