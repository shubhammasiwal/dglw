<?php

namespace App\Http\Controllers\WorkerRelationship;

use Illuminate\Http\Request;
use App\Models\CodeDirectory;
use App\Models\WorkerRelationship;
use App\Http\Controllers\Controller;

class WorkerRelationshipController extends Controller
{
    private $table_name;
    private $table_name_label;

    /**
     * Initialize a new WorkerRelationshipController instance.
     * 
     * Sets the table name and human-readable table name label
     * for the social category using the WorkerRelationship model.
     */

    public function __construct()
    {
        $this->table_name = (new WorkerRelationship())->getTable();
        $this->table_name_label = ucwords(str_replace('_', ' ', $this->table_name));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $worker_relationships = WorkerRelationship::orderByDesc('created_at')->with('codeDirectory')->get();
        $worker_relationships->transform(function ($item) {
            $item->table_name_label = $this->table_name_label;
            return $item;
        });
        return view('pages.WorkerRelationship.index', compact('worker_relationships'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.WorkerRelationship.create', ['table_name' => $this->table_name]);
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

            WorkerRelationship::create([
                'name' => $data['name'],
                'code_directory_id' => $code_directory->id
            ]);

            return redirect()->route('worker-relationship.index')->with('success', 'Worker Relationship created successfully.');
        } catch (\Throwable $th) {
            return view('errors.error', ['message' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $worker_relationship = WorkerRelationship::with('codeDirectory')->findOrFail($id);
        $worker_relationship->_label = $this->table_name_label;
        return view('pages.WorkerRelationship.show', compact('worker_relationship'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $worker_relationship = WorkerRelationship::with('codeDirectory')->findOrFail($id);
        $worker_relationship->table_name_label = $this->table_name;
        return view('pages.WorkerRelationship.edit', [
            'worker_relationship' => $worker_relationship,
            'table_name' => $this->table_name
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $worker_relationship = WorkerRelationship::findOrFail($id);

            $data = [
                'code' => $request->input('code'),
                'name' => $request->input('name'),
                'table_name' => $request->input('table_name'),
            ];

            $code_directory = $worker_relationship->codeDirectory;
            $code_directory->update($data);

            $worker_relationship->update([
                'name' => $data['name'],
            ]);

            return redirect()->route('worker-relationship.index')->with('success', 'Worker Relationship updated successfully.');
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
            $worker_relationship = WorkerRelationship::findOrFail($id);
            $worker_relationship->codeDirectory()->delete();
            $worker_relationship->delete();
            return redirect()->route('worker-relationship.index')->with('success', 'Worker Relationship deleted successfully.');
        } catch (\Throwable $th) {
            return view('errors.error', ['message' => $th->getMessage()]);
        }
    }
}
