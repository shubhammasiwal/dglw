<?php

namespace App\Http\Controllers\CodeDirectory;

use Illuminate\Http\Request;
use App\Models\CodeDirectory;
use App\Models\MaritalStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\CodeDirectory\StoreCodeDirectoryRequest;
use App\Http\Requests\CodeDirectory\UpdateCodeDirectoryRequest;

class CodeDirectoryController extends Controller
{
    private $table_names =[];

    public function __construct() {
        $this->table_names = config('constants.CODE_DIRECTORY_TABLE_NAMES');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $code_directories = CodeDirectory::orderByDesc('created_at')->get();
        $code_directories->transform(function ($item) {
            $item->table_name = ucwords(str_replace('_', ' ', $item->table_name));
            return $item;
        });

        return view('pages.CodeDirectory.index', compact('code_directories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $placeholders = implode(',', array_fill(0, count($this->table_names), '?'));

            $query = "SELECT table_name FROM information_schema.tables WHERE table_schema = 'public' AND table_type = 'BASE TABLE' AND table_name IN ($placeholders)";
            $tables = DB::select($query, $this->table_names);
            $tables = array_column($tables, 'table_name');
            $tables = array_combine(
                array_map(function ($table) {
                    return str_replace('-', '_', $table);
                }, $tables),
                array_map(function ($table) {
                    // Replace underscores with spaces, lowercase everything, then ucwords to capitalize each word
                    return ucwords(str_replace('_', ' ', str_replace('-', '_', $table)));
                }, $tables)
            );
            return view('pages.CodeDirectory.create', compact('tables'));
        } catch (\Throwable $th) {
            return view('errors.error', ['message' => $th->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCodeDirectoryRequest $request)
    {
        try {
            // $table_name is coming in the lower case with underscore
            // For ex: marital_statuses
            $table_name = $request->input('table_name');

            // Use Schema facade to check for table existence
            if (!Schema::hasTable($table_name)) {
                throw new \Exception("The category $table_name does not exist.");
            }

            $data = [
                'code' => $request->input('code'),
                'name' => $request->input('name'),
                'table_name' => $request->input('table_name'),
            ];

            $code_directory = CodeDirectory::create($data);
            // dd($code_directory);

            $this->storeOrUpdateOtherTables($code_directory, $request->input('name'), $table_name);
            
            return redirect()->route('code-directory.index')->with('success', 'Code directory created successfully.');
        } catch (\Throwable $th) {
            return view('errors.error', ['message' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $code_directory = CodeDirectory::findOrFail($id);
        $code_directory->table_name = ucwords(str_replace('_', ' ', $code_directory->table_name));
        return view('pages.CodeDirectory.show', compact('code_directory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $code_directory = CodeDirectory::findOrFail($id);
        $code_directory->table_name_label = ucwords(str_replace('_', ' ', $code_directory->table_name));
        return view('pages.CodeDirectory.edit', compact('code_directory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCodeDirectoryRequest $request, string $id)
    {
        try {
            $code_directory = CodeDirectory::findOrFail($id);

            // Sanitization for table_name
            // $request->input('table_name') is modifying in the lower case with underscore
            // For ex: marital_statuses
            $table_name = strtolower(str_replace(' ', '_', $request->input('table_name')));

            if ($code_directory->table_name != $table_name) {
                throw new \Exception("The category $table_name does not exist.");
            }

            $data = [
                'code' => $request->input('code'),
                'name' => $request->input('name'),
                'table_name' => $request->input('table_name'),
            ];

            $code_directory->update($data);

            $this->storeOrUpdateOtherTables($code_directory, $request->input('name'), $table_name);

            return redirect()->route('code-directory.index')->with('success', 'Code directory updated successfully.');
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
            $code_directory = CodeDirectory::findOrFail($id);
            $code_directory->delete();
            return redirect()->route('code-directory.index')->with('success', 'Code directory deleted successfully.');
        } catch (\Throwable $th) {
            return view('errors.error', ['message' => $th->getMessage()]);
        }
    }

    protected function storeOrUpdateOtherTables(CodeDirectory $code_directory, string $name, string $table_name) {
        // dd($code_directory, $name, $table_name);
        // dd('storeOrUpdateOtherTables');
        try {
            $constants = config('constants');
            if(in_array($table_name, $constants['CODE_DIRECTORY_TABLE_NAMES'])) {
                $model_name = 'App\Models\\' . $constants['CODE_DIRECTORY_MODEL_NAMES'][$table_name];
                $entry = $model_name::updateOrCreate(
                    ['code_directory_id' => $code_directory->id],
                    ['name' => $name]
                );
            }
        } catch (\Throwable $th) {
            return view('errors.error', ['message' => $th->getMessage()]);
        }
    }
}
