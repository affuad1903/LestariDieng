<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\DayItinerary;
use App\Models\TimeItinerary;
use App\Models\DetailItinerary;
use Illuminate\Http\Request;

class DetailItineraryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DetailItinerary::with(['paket', 'dayItinerary', 'timeItinerary']);

        // Filter by paket
        if ($request->filled('paket_id')) {
            $query->where('paket_id', $request->paket_id);
        }

        // Search by detail/hari/waktu
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('detail', 'like', "%{$search}%")
                ->orWhereHas('dayItinerary', fn($q2) => $q2->where('nama_hari', 'like', "%{$search}%"))
                ->orWhereHas('timeItinerary', fn($q3) => $q3->where('waktu', 'like', "%{$search}%"));
            });
        }

        $detail_itinerary = $query->latest()->paginate(5);
        $pakets = Paket::all();

        return view('admin.page.detail_itinerary.index', compact('detail_itinerary', 'pakets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $paket = Paket::all();
        $day_itinerary = DayItinerary::all();
        $time_itinerary = TimeItinerary::all();

        // Check if this is a synchronized request from paket show page
        $paket_id = $request->get('paket_id');
        $is_synchronized = !is_null($paket_id);
        
        if ($is_synchronized && $paket_id) {
            $selected_paket = Paket::find($paket_id);
            if (!$selected_paket) {
                return redirect()->route('detail-itinerary.create')
                    ->with('error', 'Paket tidak ditemukan!');
            }
            
            // Return synchronized view
            return view('admin.page.detail_itinerary.create-sync', [
                'selected_paket' => $selected_paket,
                'day_itinerary' => $day_itinerary,
                'time_itinerary' => $time_itinerary
            ]);
        }

        // Return normal view
        return view('admin.page.detail_itinerary.create', [
            'paket' => $paket,
            'day_itinerary' => $day_itinerary,
            'time_itinerary' => $time_itinerary
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'paket_id' => 'required|exists:paket,id',
            'day_itinerary_id' => 'nullable|exists:day_itinerary,id',
            'time_itinerary_id' => 'nullable|exists:time_itinerary,id',
            'new_day' => 'nullable|string|max:255',
            'new_time' => 'nullable|date_format:H:i',
            'detail' => 'required|string|max:1000',
        ]);

        // Validasi tidak boleh mengisi dua-duanya: hari & new_day
        if ($request->filled('new_day') && $request->filled('day_itinerary_id')) {
            return back()->withInput()->with('error', 'Pilih hari dari daftar atau masukkan hari baru, bukan keduanya.');
        }

        // Validasi tidak boleh mengisi dua-duanya: jam & new_time
        if ($request->filled('new_time') && $request->filled('time_itinerary_id')) {
            return back()->withInput()->with('error', 'Pilih jam dari daftar atau masukkan jam baru, bukan keduanya.');
        }

        // Validasi jika hari baru sudah ada
        if ($request->filled('new_day') && DayItinerary::where('nama_hari', $request->new_day)->exists()) {
            return back()->withInput()->with('error', 'Hari itinerary sudah ada. Pilih dari daftar.');
        }

        // Validasi jika waktu baru sudah ada
        if ($request->filled('new_time') && TimeItinerary::where('waktu', $request->new_time)->exists()) {
            return back()->withInput()->with('error', 'Waktu itinerary sudah ada. Pilih dari daftar.');
        }

        // Buat atau ambil day_itinerary_id
        if ($request->filled('new_day')) {
            $day = DayItinerary::create([
                'nama_hari' => $request->new_day
            ]);
            $day_id = $day->id;
        } else {
            $day_id = $request->day_itinerary_id;
        }

        // Buat atau ambil time_itinerary_id
        if ($request->filled('new_time')) {
            $time = TimeItinerary::create([
                'waktu' => $request->new_time
            ]);
            $time_id = $time->id;
        } else {
            $time_id = $request->time_itinerary_id;
        }

        // Validasi kombinasi paket + day + time tidak boleh ganda
        $exists = DetailItinerary::where('paket_id', $request->paket_id)
            ->where('day_itinerary_id', $day_id)
            ->where('time_itinerary_id', $time_id)
            ->exists();

        if ($exists) {
            return back()->withInput()->with('error', 'Detail itinerary dengan kombinasi paket, hari, dan waktu tersebut sudah ada.');
        }

        // Simpan detail itinerary
        DetailItinerary::create([
            'paket_id' => $request->paket_id,
            'day_itinerary_id' => $day_id,
            'time_itinerary_id' => $time_id,
            'detail' => $request->detail
        ]);

        // Check if this is a synchronized request and redirect accordingly
        if ($request->has('is_synchronized')) {
            return redirect()->route('paket.show', $request->paket_id)
                ->with('success', 'Detail itinerary berhasil ditambahkan ke paket!');
        }

        return redirect()->route('detail-itinerary.index')->with('success', 'Detail itinerary berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $detailItinerary = DetailItinerary::findOrFail($id);
        $pakets = Paket::all();
        $dayItinerary = DayItinerary::all();
        $timeItinerary = TimeItinerary::all();

        return view('admin.page.detail_itinerary.edit', compact('detailItinerary', 'pakets', 'dayItinerary', 'timeItinerary'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'paket_id' => 'required|exists:paket,id',
            'day_itinerary_id' => 'required|exists:day_itinerary,id',
            'time_itinerary_id' => 'required|exists:time_itinerary,id',
            'detail' => 'required|string|max:1000',
        ]);

        $detailItinerary = DetailItinerary::findOrFail($id);

        // Validasi kombinasi unik kecuali dirinya sendiri
        $exists = DetailItinerary::where('paket_id', $request->paket_id)
            ->where('day_itinerary_id', $request->day_itinerary_id)
            ->where('time_itinerary_id', $request->time_itinerary_id)
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return back()->withInput()->with('error', 'Data itinerary dengan kombinasi ini sudah ada.');
        }

        $detailItinerary->update([
            'paket_id' => $request->paket_id,
            'day_itinerary_id' => $request->day_itinerary_id,
            'time_itinerary_id' => $request->time_itinerary_id,
            'detail' => $request->detail
        ]);

        return redirect()->route('detail-itinerary.index')->with('success', 'Detail itinerary berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $detailItinerary = DetailItinerary::findOrFail($id);
        $detailItinerary->delete();

        return redirect()->route('detail-itinerary.index')->with('success', 'Data berhasil dihapus!');
    }
}
