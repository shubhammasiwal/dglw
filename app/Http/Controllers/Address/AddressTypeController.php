<?php

namespace App\Http\Controllers\Address;

use App\Models\AddressType;
use Illuminate\Http\Request;
use App\Models\CodeDirectory;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddressType\StoreAddressTypeRequest;
use App\Http\Requests\AddressType\UpdateAddressTypeRequest;

class AddressTypeController extends Controller
{
    private $table_name;
    private $table_name_label;

    /**
     * Initialize a new AddressTypeController instance.
     *
     * Sets the table name and human-readable table name label
     * for the AddressType using the AddressType model.
     */

    public function __construct()
    {
        $this->table_name = (new AddressType())->getTable();
        $this->table_name_label = ucwords(str_replace('_', ' ', $this->table_name));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $address_types = AddressType::orderByDesc('created_at')->with('codeDirectory')->get();
        $address_types->transform(function ($item) {
            $item->table_name_label = $this->table_name_label;
            return $item;
        });
        return view('pages.AddressType.index', compact('address_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.AddressType.create', ['table_name' => $this->table_name]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAddressTypeRequest $request)
    {
        try {
            $data = [
                'code' => $request->input('code'),
                'name' => $request->input('name'),
                'table_name' => $request->input('table_name'),
            ];
            
            $code_directory = CodeDirectory::create($data);

            AddressType::create([
                'name' => $data['name'],
                'code_directory_id' => $code_directory->id
            ]);

            return redirect()->route('address-type.index')->with('success', 'Address type created successfully.');
        } catch (\Throwable $th) {
            return view('errors.error', ['message' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $address_type = AddressType::with('codeDirectory')->findOrFail($id);
        $address_type->_label = $this->table_name_label;
        return view('pages.AddressType.show', compact('address_type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $address_type = AddressType::with('codeDirectory')->findOrFail($id);
        $address_type->table_name_label = $this->table_name;
        return view('pages.AddressType.edit', [
            'address_type' => $address_type,
            'table_name' => $this->table_name
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAddressTypeRequest $request, string $id)
    {
        try {
            $address_type = AddressType::findOrFail($id);

            $data = [
                'code' => $request->input('code'),
                'name' => $request->input('name'),
                'table_name' => $request->input('table_name'),
            ];

            $code_directory = $address_type->codeDirectory;
            $code_directory->update($data);

            $address_type->update([
                'name' => $data['name'],
            ]);

            return redirect()->route('address-type.index')->with('success', 'Address type updated successfully.');
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
            $address_type = AddressType::findOrFail($id);
            $address_type->codeDirectory()->delete();
            $address_type->delete();
            return redirect()->route('address-type.index')->with('success', 'Address type deleted successfully.');
        } catch (\Throwable $th) {
            return view('errors.error', ['message' => $th->getMessage()]);
        }
    }
}
