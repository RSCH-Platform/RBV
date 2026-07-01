<?php

namespace App\Http\Controllers;

use App\Models\Repositori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RepositoriController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Repositori::query();

            if ($request->search) {
                $query->where('judul', 'like', '%'.$request->search.'%');
            }

            if (Auth::check()) {
                \App\Models\Kunjungan::create([
                    'id_user' => Auth::id(),
                    'halaman' => 'layanan',
                ]);
            }

            $repositoris = $query->latest()->paginate(10);

            $kategoris = [];
            $kategori = null;

            return view('pages.Layanan.repositori.repositori', compact('repositoris', 'kategoris', 'kategori'));
        } catch (\Exception $e) {
            Log::error('Error on RepositoriController@index: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('pages.Layanan.repositori.repositoricreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:500',
            'file' => 'required|file|mimes:pdf|max:20480', 
        ]);

        try {
            $path = $request->file('file')->store('repositori', 'public');

            Repositori::create([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'file' => $path,
            ]);

            return redirect()->route('repositori.index')
                ->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            Log::error('Error on RepositoriController@store: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $repositori = Repositori::findOrFail($id);

        return view('pages.Layanan.repositori.repositoriedit', compact('repositori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:500',
            'file' => 'nullable|file|mimes:pdf|max:20480',
        ]);

        try {
            $repositori = Repositori::findOrFail($id);
            $data = [
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
            ];

            if ($request->hasFile('file')) {
                if ($repositori->file) {
                    Storage::disk('public')->delete($repositori->file);
                }
                $data['file'] = $request->file('file')->store('repositori', 'public');
            }

            $repositori->update($data);

            return redirect()->route('repositori.index')
                ->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            Log::error('Error on RepositoriController@update: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat mengupdate data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $repositori = Repositori::findOrFail($id);

            if ($repositori->file) {
                Storage::disk('public')->delete($repositori->file);
            }
            
            $repositori->delete();

            return redirect()->route('repositori.index')
                ->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            Log::error('Error on RepositoriController@destroy: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }
}