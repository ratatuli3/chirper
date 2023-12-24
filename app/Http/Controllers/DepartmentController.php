<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Departments\StoreRequest;
use App\Http\Requests\Departments\UpdateRequest;

class DepartmentController
{
    public function index(): Response
    {
        return response()->view('departments.index', [
            'departments' => Department::orderBy('updated_at', 'desc')->get(),
            'departments' => DB::table('departments')->paginate(10),
        ]);
    }

    public function create(): Response
    {
        return response()->view('departments.create', [
            'departments' => Department::orderBy('updated_at', 'desc')->get(),
        ]);

    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // insert only requests that already validated in the StoreRequest
            $create = Department::create($validated);

        if($create) {
            // add flash for the success notification
            session()->flash('notif.success', 'Department created successfully!');
            return redirect()->route('departments.index');
        }

        return abort(500);
    }

    public function show(string $id): Response
    {
        return response()->view('departments.show', [
            'department' => Department::findOrFail($id),
        ]);
    }

    public function edit(int $id)
    {
        return response()->view('departments.create', [
            'departments' => Department::orderBy('updated_at', 'desc')->get(),
            'department' => Department::findOrFail($id),
        ]);
    }

    public function update(Request $request, int $id)
    {
    }

    public function destroy(string $id): RedirectResponse
    {
        $department = Department::findOrFail($id);
        
        $delete = $department->delete($id);

        if($delete) {
            session()->flash('notif.success', 'Post deleted successfully!');
            return redirect()->route('departments.index');
        }

        return abort(500);
    }
}
