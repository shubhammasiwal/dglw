<?php

namespace App\Http\Controllers\WorkerType;

use App\Models\WorkerType;
use Illuminate\Http\Request;
use App\Models\CodeDirectory;
use App\Http\Controllers\Controller;

class WorkerTypeController extends Controller
{
    private $table_name;
    private $table_name_label;

    /**
     * Initialize a new WorkerTypeController instance.
     * 
     * Sets the table name and human-readable table name label
     * for the worker type using the WorkerType model.
     */

    public function __construct()
    {
        $this->table_name = (new WorkerType())->getTable();
        $this->table_name_label = ucwords(str_replace('_', ' ', $this->table_name));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $worker_types = WorkerType::orderByDesc('created_at')->with('codeDirectory')->get();
        $worker_types->transform(function ($item) {
            $item->table_name_label = $this->table_name_label;
            return $item;
        });
        return view('pages.WorkerType.index', compact('worker_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.WorkerType.create', ['table_name' => $this->table_name]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = [
                'code' => $request->input('code'),
                'name' => $request->input('name'),
                'table_name' => $request->input('table_name'),
            ];
            
            $code_directory = CodeDirectory::create($data);

            WorkerType::create([
                'name' => $data['name'],
                'code_directory_id' => $code_directory->id
            ]);

            return redirect()->route('worker-type.index')->with('success', 'Worker type created successfully.');
        } catch (\Throwable $th) {
            return view('errors.error', ['message' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $worker_type = WorkerType::with('codeDirectory')->findOrFail($id);
        $worker_type->_label = $this->table_name_label;
        return view('pages.WorkerType.show', compact('worker_type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $worker_type = WorkerType::with('codeDirectory')->findOrFail($id);
        $worker_type->table_name_label = $this->table_name;
        return view('pages.WorkerType.edit', [
            'worker_type' => $worker_type,
            'table_name' => $this->table_name
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $worker_type = WorkerType::findOrFail($id);

            $data = [
                'code' => $request->input('code'),
                'name' => $request->input('name'),
                'table_name' => $request->input('table_name'),
            ];

            $code_directory = $worker_type->codeDirectory;
            $code_directory->update($data);

            $worker_type->update([
                'name' => $data['name'],
            ]);

            return redirect()->route('worker-type.index')->with('success', 'Worker type updated successfully.');
        } catch (\Throwable $th) {
            return view('errors.error', ['message' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $worker_type = WorkerType::findOrFail($id);
            $worker_type->codeDirectory()->delete();
            $worker_type->delete();
            return redirect()->route('worker-type.index')->with('success', 'Worker type deleted successfully.');
        } catch (\Throwable $th) {
            return view('errors.error', ['message' => $th->getMessage()]);
        }
    }
}
