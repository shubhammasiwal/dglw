<?php

namespace App\Http\Controllers\MigrationReason;

use Illuminate\Http\Request;
use App\Models\CodeDirectory;
use App\Models\MigrationReason;
use App\Http\Controllers\Controller;

class MigrationReasonController extends Controller
{
    private $table_name;
    private $table_name_label;

    /**
     * Initialize a new MigrationReasonController instance.
     * 
     * Sets the table name and human-readable table name label
     * for the MigrationReasonController using the MigrationReason model.
     */

    public function __construct()
    {
        $this->table_name = (new MigrationReason())->getTable();
        $this->table_name_label = ucwords(str_replace('_', ' ', $this->table_name));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $migration_reasons = MigrationReason::orderByDesc('created_at')->with('codeDirectory')->get();
        $migration_reasons->transform(function ($item) {
            $item->table_name_label = $this->table_name_label;
            return $item;
        });
        return view('pages.MigrationReason.index', compact('migration_reasons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.MigrationReason.create', ['table_name' => $this->table_name]);
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

            MigrationReason::create([
                'name' => $data['name'],
                'code_directory_id' => $code_directory->id
            ]);

            return redirect()->route('migration-reason.index')->with('success', 'Migration reason created successfully.');
        } catch (\Throwable $th) {
            return view('errors.error', ['message' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $migration_reason = MigrationReason::with('codeDirectory')->findOrFail($id);
        $migration_reason->_label = $this->table_name_label;
        return view('pages.MigrationReason.show', compact('migration_reason'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $migration_reason = MigrationReason::with('codeDirectory')->findOrFail($id);
        $migration_reason->table_name_label = $this->table_name;
        return view('pages.MigrationReason.edit', [
            'migration_reason' => $migration_reason,
            'table_name' => $this->table_name
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $migration_reason = MigrationReason::findOrFail($id);

            $data = [
                'code' => $request->input('code'),
                'name' => $request->input('name'),
                'table_name' => $request->input('table_name'),
            ];

            $code_directory = $migration_reason->codeDirectory;
            $code_directory->update($data);

            $migration_reason->update([
                'name' => $data['name'],
            ]);

            return redirect()->route('migration-reason.index')->with('success', 'Migration reason updated successfully.');
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
            $migration_reason = MigrationReason::findOrFail($id);
            $migration_reason->codeDirectory()->delete();
            $migration_reason->delete();
            return redirect()->route('migration-reason.index')->with('success', 'Migration reason deleted successfully.');
        } catch (\Throwable $th) {
            return view('errors.error', ['message' => $th->getMessage()]);
        }
    }
}
