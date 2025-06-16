<?php

namespace App\Http\Controllers\Education;

use App\Models\Education;
use Illuminate\Http\Request;
use App\Models\CodeDirectory;
use App\Http\Controllers\Controller;

class EducationController extends Controller
{
    private $table_name;
    private $table_name_label;

    /**
     * Initialize a new EducationController instance.
     * 
     * Sets the table name and human-readable table name label
     * for the education using the Education model.
     */

    public function __construct()
    {
        $this->table_name = (new Education())->getTable();
        $this->table_name_label = ucwords(str_replace('_', ' ', $this->table_name));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $education = Education::orderByDesc('created_at')->with('codeDirectory')->get();
        $education->transform(function ($item) {
            $item->table_name_label = $this->table_name_label;
            return $item;
        });
        return view('pages.Education.index', compact('education'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.Education.create', ['table_name' => $this->table_name]);
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

            Education::create([
                'name' => $data['name'],
                'code_directory_id' => $code_directory->id
            ]);

            return redirect()->route('education.index')->with('success', 'Education created successfully.');
        } catch (\Throwable $th) {
            return view('errors.error', ['message' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $education = Education::with('codeDirectory')->findOrFail($id);
        $education->_label = $this->table_name_label;
        return view('pages.Education.show', compact('education'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $education = Education::with('codeDirectory')->findOrFail($id);
        $education->table_name_label = $this->table_name;
        return view('pages.Education.edit', [
            'education' => $education,
            'table_name' => $this->table_name
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $education = Education::findOrFail($id);

            $data = [
                'code' => $request->input('code'),
                'name' => $request->input('name'),
                'table_name' => $request->input('table_name'),
            ];

            $code_directory = $education->codeDirectory;
            $code_directory->update($data);

            $education->update([
                'name' => $data['name'],
            ]);

            return redirect()->route('education.index')->with('success', 'Education updated successfully.');
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
            $education = Education::findOrFail($id);
            $education->codeDirectory()->delete();
            $education->delete();
            return redirect()->route('education.index')->with('success', 'Education deleted successfully.');
        } catch (\Throwable $th) {
            return view('errors.error', ['message' => $th->getMessage()]);
        }
    }
}
