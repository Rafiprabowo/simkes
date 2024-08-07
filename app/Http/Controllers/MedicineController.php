<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\MedicineCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
    {
        $medicines = Medicine::with('categories')->paginate(5);

        return view('content.apoteker.obat.index', compact('medicines'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = MedicineCategories::all();
        return view('content.apoteker.obat.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'name' => 'required|string|unique:medicines',
        'description' => 'required|string',
        'category_id' => 'required|exists:medicine_categories,id',
        'stock' => 'required|integer|min:1',
        'satuan' => 'required|string'
    ]);

    // Cek apakah obat dengan nama yang sama sudah ada
    $existingMedicine = Medicine::where('name', $request->input('name'))->first();
    if ($existingMedicine) {
        return redirect()->back()->withErrors(['name' => 'Nama obat sudah ada.'])->withInput();
    }

    // Buat data obat baru
    Medicine::create($request->only(['name', 'description', 'category_id', 'stock','satuan']));

    return redirect()->route('obat.index')->with('success', 'Obat berhasil ditambahkan');
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
    public function edit($id)
    {
        $medicine = Medicine::findOrFail($id); // Ambil obat berdasarkan ID atau berikan error 404 jika tidak ditemukan
        $categories = MedicineCategories::all(); // Ambil semua kategori obat untuk dropdown

        return view('content.apoteker.obat.edit', compact('medicine', 'categories'));
    }



    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'name' => [
            'required',
            'string',
            Rule::unique('medicines')->ignore($id), // Memastikan nama obat unik kecuali untuk obat yang sedang diedit
        ],
        'description' => 'required|string',
        'category_id' => 'required|exists:medicine_categories,id',
        'stock' => 'required|integer|min:1',
        'satuan' => 'required',
    ]);

    try {
        // Ambil data obat berdasarkan id
        $medicine = Medicine::findOrFail($id);

        // Update data obat
        $medicine->name = $request->name;
        $medicine->description = $request->description;
        $medicine->category_id = $request->category_id;
        $medicine->stock = $request->stock;
        $medicine->satuan = $request->satuan;
        $medicine->save();

        return redirect()->route('obat.index')->with('success', 'Obat berhasil diubah');
    } catch (\Throwable $th) {
        // Tangani jika terjadi error
        return redirect()->back()->withErrors(['message' => 'Gagal mengupdate data obat.'])->withInput();
    }
}



    /**
     * Remove the specified resource from storage.
     */
  public function destroy($obat)
{
    $obat = Medicine::findOrFail($obat);
    $obat->delete();

    return redirect()->route('obat.index')->with('success', 'Obat berhsil dihapus');
}
public function getMedicineById($id)
{
    $medicine = Medicine::with(['categories'])->find($id);

    if (!$medicine) {
        return response()->json(['message' => 'Data tidak ditemukan'], 404);
    }

    if ($medicine->stock <= 0) {
        return response()->json(['message' => 'Stok tidak tersedia'], 400);
    }

    $formattedMedicine = [
        'id' => $medicine->id,
        'name' => $medicine->name,
        'category' => $medicine->categories->name,
        'description' => $medicine->description,
        'stock' => $medicine->stock,
        'satuan' => $medicine->satuan
    ];

    return response()->json(['status' => 'success', 'data' => $formattedMedicine], 200);
}

}
