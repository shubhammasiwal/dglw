<?php

namespace App\Http\Controllers\MaritalStatus;

use Illuminate\Http\Request;
use App\Models\CodeDirectory;
use App\Models\MaritalStatus;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\UpdateMaritalStatusRequest;
use App\Http\Requests\MaritalStatus\StoreMaritalStatusRequest;

class MaritalStatusController extends Controller
{
    private $table_name;
    private $table_name_label;

    public function __construct()
    {
        $this->table_name = (new MaritalStatus())->getTable();
        $this->table_name_label = ucwords(str_replace('_', ' ', $this->table_name));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marital_statuses = MaritalStatus::orderByDesc('created_at')->with('codeDirectory')->get();
        $marital_statuses->transform(function ($item) {
            $item->table_name_label = $this->table_name_label;
            return $item;
        });

        return view('pages.MaritalStatus.index', compact('marital_statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.MaritalStatus.create', ['table_name' => $this->table_name]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMaritalStatusRequest $request)
    {
         try {
            $data = [
                'code' => $request->input('code'),
                'name' => $request->input('name'),
                'table_name' => $request->input('table_name'),
            ];
            
            $code_directory = CodeDirectory::create($data);

            $marital_status = MaritalStatus::create([
                'name' => $data['name'],
                'code_directory_id' => $code_directory->id
            ]);

            return redirect()->route('marital-status.index')->with('success', 'Marital status created successfully.');
        } catch (\Throwable $th) {
            return view('errors.error', ['message' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $marital_status = MaritalStatus::with('codeDirectory')->findOrFail($id);
        $marital_status->_label = $this->table_name_label;
        return view('pages.MaritalStatus.show', compact('marital_status'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $marital_status = MaritalStatus::with('codeDirectory')->findOrFail($id);
        $marital_status->table_name_label = $this->table_name;
        return view('pages.MaritalStatus.edit', [
            'marital_status' => $marital_status,
            'table_name' => $this->table_name
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMaritalStatusRequest $request, string $id)
    {
        try {
            $marital_status = MaritalStatus::findOrFail($id);

            $data = [
                'code' => $request->input('code'),
                'name' => $request->input('name'),
                'table_name' => $request->input('table_name'),
            ];

            $code_directory = $marital_status->codeDirectory;
            $code_directory->update($data);

            $marital_status->update([
                'name' => $data['name'],
            ]);

            return redirect()->route('marital-status.index')->with('success', 'Marital status updated successfully.');
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
            $marital_status = MaritalStatus::findOrFail($id);
            $marital_status->codeDirectory()->delete();
            $marital_status->delete();
            return redirect()->route('marital-status.index')->with('success', 'Marital status deleted successfully.');
        } catch (\Throwable $th) {
            return view('errors.error', ['message' => $th->getMessage()]);
        }
    }
}
