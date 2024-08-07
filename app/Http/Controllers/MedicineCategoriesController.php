<?php

namespace App\Http\Controllers;

use App\Models\MedicineCategories;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MedicineCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

       $categories = MedicineCategories::paginate(5);
     return view('content.apoteker.kategori-obat.index', compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('content.apoteker.kategori-obat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
      $validator = Validator::make($request->all(), [
        'name' => 'required|unique:medicine_categories,name',
        'description' => 'required',
    ], [
        'name.required' => 'Name is required.',
        'name.unique' => 'Name is already taken.',
        'description.required' => 'Description is required.',
    ]);
        if ($validator->fails()) {
    return redirect()->back()->withErrors($validator)->withInput();
}

        MedicineCategories::create([
           'name'=> $request->get('name'),
           'description'=> $request->get('description'),
        ]);

        return redirect(route('kategori-obat.index'))->with('success', 'Kategori obat berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $category = MedicineCategories::find($id);
        return view('content.apoteker.kategori-obat.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // Validasi input
    $request->validate([
        'name' => 'required|unique:medicine_categories,name,' . $id, // Unik kecuali untuk kategori yang saat ini diupdate
        'description' => 'required',
    ], [
         'name.required' => 'Name is required.',
        'name.unique' => 'Name is already taken.',
        'description.required' => 'Description is required.',
    ]);

    // Temukan kategori berdasarkan ID
    $category = MedicineCategories::findOrFail($id);

    // Perbarui data kategori
    $category->update([
        'name' => $request->input('name'),
        'description' => $request->input('description'),
    ]);

    // Redirect ke index dengan pesan sukses
    return redirect()->route('kategori-obat.index')->with('success', 'Kategori obat berhasil diubah');
}

    /**
     * Remove the specified resource from storage.
     */
   public function destroy($id)
{
    $category = MedicineCategories::findOrFail($id);

    $category->delete();

    return redirect()->route('kategori-obat.index')->with('success', 'Kategori obat berhasil dihapus');
}
}
