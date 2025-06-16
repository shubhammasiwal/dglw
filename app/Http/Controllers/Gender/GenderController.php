<?php

namespace App\Http\Controllers\Gender;

use App\Models\Gender;
use Illuminate\Http\Request;
use App\Models\CodeDirectory;
use App\Http\Controllers\Controller;

class GenderController extends Controller
{
    private $table_name;
    private $table_name_label;

    /**
     * Initialize a new GenderController instance.
     * 
     * Sets the table name and human-readable table name label
     * for the gender using the Gender model.
     */

    public function __construct()
    {
        $this->table_name = (new Gender())->getTable();
        $this->table_name_label = ucwords(str_replace('_', ' ', $this->table_name));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genders = Gender::orderByDesc('created_at')->with('codeDirectory')->get();
        $genders->transform(function ($item) {
            $item->table_name_label = $this->table_name_label;
            return $item;
        });
        return view('pages.Gender.index', compact('genders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.Gender.create', ['table_name' => $this->table_name]);
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

            Gender::create([
                'name' => $data['name'],
                'code_directory_id' => $code_directory->id
            ]);

            return redirect()->route('gender.index')->with('success', 'Gender created successfully.');
        } catch (\Throwable $th) {
            return view('errors.error', ['message' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $gender = Gender::with('codeDirectory')->findOrFail($id);
        $gender->_label = $this->table_name_label;
        return view('pages.Gender.show', compact('gender'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $gender = Gender::with('codeDirectory')->findOrFail($id);
        $gender->table_name_label = $this->table_name;
        return view('pages.Gender.edit', [
            'gender' => $gender,
            'table_name' => $this->table_name
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $gender = Gender::findOrFail($id);

            $data = [
                'code' => $request->input('code'),
                'name' => $request->input('name'),
                'table_name' => $request->input('table_name'),
            ];

            $code_directory = $gender->codeDirectory;
            $code_directory->update($data);

            $gender->update([
                'name' => $data['name'],
            ]);

            return redirect()->route('gender.index')->with('success', 'Gender updated successfully.');
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
            $gender = Gender::findOrFail($id);
            $gender->codeDirectory()->delete();
            $gender->delete();
            return redirect()->route('gender.index')->with('success', 'Gender deleted successfully.');
        } catch (\Throwable $th) {
            return view('errors.error', ['message' => $th->getMessage()]);
        }
    }
}
