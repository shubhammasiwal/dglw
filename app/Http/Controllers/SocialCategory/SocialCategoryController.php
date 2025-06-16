<?php

namespace App\Http\Controllers\SocialCategory;

use Illuminate\Http\Request;
use App\Models\CodeDirectory;
use App\Models\SocialCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\SocialCategory\StoreSocialCategoryRequest;
use App\Http\Requests\SocialCategory\UpdateSocialCategoryRequest;

class SocialCategoryController extends Controller
{
    private $table_name;
    private $table_name_label;

    /**
     * Initialize a new SocialCategoryController instance.
     * 
     * Sets the table name and human-readable table name label
     * for the social category using the SocialCategory model.
     */

    public function __construct()
    {
        $this->table_name = (new SocialCategory())->getTable();
        $this->table_name_label = ucwords(str_replace('_', ' ', $this->table_name));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $social_categories = SocialCategory::orderByDesc('created_at')->with('codeDirectory')->get();
        $social_categories->transform(function ($item) {
            $item->table_name_label = $this->table_name_label;
            return $item;
        });
        return view('pages.SocialCategory.index', compact('social_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.SocialCategory.create', ['table_name' => $this->table_name]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSocialCategoryRequest $request)
    {
        try {
            $data = [
                'code' => $request->input('code'),
                'name' => $request->input('name'),
                'table_name' => $request->input('table_name'),
            ];
            
            $code_directory = CodeDirectory::create($data);

            SocialCategory::create([
                'name' => $data['name'],
                'code_directory_id' => $code_directory->id
            ]);

            return redirect()->route('social-category.index')->with('success', 'Social category created successfully.');
        } catch (\Throwable $th) {
            return view('errors.error', ['message' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $social_category = SocialCategory::with('codeDirectory')->findOrFail($id);
        $social_category->_label = $this->table_name_label;
        return view('pages.SocialCategory.show', compact('social_category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $social_category = SocialCategory::with('codeDirectory')->findOrFail($id);
        $social_category->table_name_label = $this->table_name;
        return view('pages.SocialCategory.edit', [
            'social_category' => $social_category,
            'table_name' => $this->table_name
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSocialCategoryRequest $request, string $id)
    {
        try {
            $social_category = SocialCategory::findOrFail($id);

            $data = [
                'code' => $request->input('code'),
                'name' => $request->input('name'),
                'table_name' => $request->input('table_name'),
            ];

            $code_directory = $social_category->codeDirectory;
            $code_directory->update($data);

            $social_category->update([
                'name' => $data['name'],
            ]);

            return redirect()->route('social-category.index')->with('success', 'Social category updated successfully.');
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
            $social_category = SocialCategory::findOrFail($id);
            $social_category->codeDirectory()->delete();
            $social_category->delete();
            return redirect()->route('social-category.index')->with('success', 'Social category deleted successfully.');
        } catch (\Throwable $th) {
            return view('errors.error', ['message' => $th->getMessage()]);
        }
    }
}
