<?php

namespace App\Http\Controllers\CodeDirectory;

use Illuminate\Http\Request;
use App\Models\CodeDirectory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

class CodeDirectoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $code_directories = CodeDirectory::all();
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
            // Send all the table name related to code directory
            $table_names = ['marital_statuses'];
            $placeholders = implode(',', array_fill(0, count($table_names), '?'));

            $query = "SELECT table_name FROM information_schema.tables WHERE table_schema = 'public' AND table_type = 'BASE TABLE' AND table_name IN ($placeholders)";
            $tables = DB::select($query, $table_names);
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
    public function store(Request $request)
    {
        try {
            $request->validate([
                'code' => ['required', 'string', 'max:255', 'unique:code_directories,code'],
                'name' => ['required', 'string', 'max:255'],
                'table_name' => ['required', 'string'],
            ], [
                'code.required' => 'Code is required.',
                'code.string' => 'Code must be a string.',
                'code.max' => 'Code must not be greater than 255 characters.',
                'code.unique' => 'Code has already been taken.',
                'name.required' => 'Name is required.',
                'name.string' => 'Name must be a string.',
                'name.max' => 'Name must not be greater than 255 characters.',
                'table_name.required' => 'Table name is required.',
                'table_name.string' => 'Table name must be a string.',
            ]);

            $table_name = $request->table_name;

            // Use Schema facade to check for table existence
            if (!Schema::hasTable($table_name)) {
                throw new \Exception("The category $table_name does not exist.");
            }

            $data = [
                'code' => $request->code,
                'name' => $request->name,
                'table_name' => $request->table_name,
            ];

            CodeDirectory::create($data);
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
        $code_directory->table_name = ucwords(str_replace('_', ' ', $code_directory->table_name));
        return view('pages.CodeDirectory.edit', compact('code_directory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'code' => ['required', 'string', 'max:255', "unique:code_directories,code,{$id}"],
                'name' => ['required', 'string', 'max:255'],
                'table_name' => ['required', 'string', "unique:code_directories,table_name,{$id}"],
            ], [
                'code.required' => 'Code is required.',
                'code.string' => 'Code must be a string.',
                'code.max' => 'Code must not be greater than 255 characters.',
                'code.unique' => 'Code has already been taken.',
                'name.required' => 'Name is required.',
                'name.string' => 'Name must be a string.',
                'name.max' => 'Name must not be greater than 255 characters.',
                'table_name.required' => 'Table name is required.',
                'table_name.string' => 'Table name must be a string.',
                'table_name.unique' => 'Table name has already been taken.',
            ]);

            $code_directory = CodeDirectory::findOrFail($id);

            $table_name = strtolower(str_replace(' ', '_', $request->table_name));
            if ($code_directory->table_name != $table_name) {
                throw new \Exception("The category $table_name does not exist.");
            }

            $data = [
                'code' => $request->code,
                'name' => $request->name,
                'table_name' => $request->table_name,
            ];

            $code_directory->update($data);
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
            $code_directory->deletse();
            return redirect()->route('code-directory.index')->with('success', 'Code directory deleted successfully.');
        } catch (\Throwable $th) {
            return view('errors.error', ['message' => $th->getMessage()]);
        }
    }
}
