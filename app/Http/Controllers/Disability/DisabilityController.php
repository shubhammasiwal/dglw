<?php

namespace App\Http\Controllers\Disability;

use App\Models\Disability;
use Illuminate\Http\Request;
use App\Models\CodeDirectory;
use App\Http\Controllers\Controller;

class DisabilityController extends Controller
{
    private $table_name;
    private $table_name_label;

    /**
     * Initialize a new DisabilityController instance.
     * 
     * Sets the table name and human-readable table name label
     * for the social category using the Disability model.
     */

    public function __construct()
    {
        $this->table_name = (new Disability())->getTable();
        $this->table_name_label = ucwords(str_replace('_', ' ', $this->table_name));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $disabilities = Disability::orderByDesc('created_at')->with('codeDirectory')->get();
        $disabilities->transform(function ($item) {
            $item->table_name_label = $this->table_name_label;
            return $item;
        });
        return view('pages.Disability.index', compact('disabilities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.Disability.create', ['table_name' => $this->table_name]);
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

            Disability::create([
                'name' => $data['name'],
                'code_directory_id' => $code_directory->id
            ]);

            return redirect()->route('disability.index')->with('success', 'Disability created successfully.');
        } catch (\Throwable $th) {
            return view('errors.error', ['message' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $disability = Disability::with('codeDirectory')->findOrFail($id);
        $disability->_label = $this->table_name_label;
        return view('pages.Disability.show', compact('disability'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $disability = Disability::with('codeDirectory')->findOrFail($id);
        $disability->table_name_label = $this->table_name;
        return view('pages.Disability.edit', [
            'disability' => $disability,
            'table_name' => $this->table_name
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $disability = Disability::findOrFail($id);

            $data = [
                'code' => $request->input('code'),
                'name' => $request->input('name'),
                'table_name' => $request->input('table_name'),
            ];

            $code_directory = $disability->codeDirectory;
            $code_directory->update($data);

            $disability->update([
                'name' => $data['name'],
            ]);

            return redirect()->route('disability.index')->with('success', 'Disability updated successfully.');
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
            $disability = Disability::findOrFail($id);
            $disability->codeDirectory()->delete();
            $disability->delete();
            return redirect()->route('disability.index')->with('success', 'Disability deleted successfully.');
        } catch (\Throwable $th) {
            return view('errors.error', ['message' => $th->getMessage()]);
        }
    }
}
