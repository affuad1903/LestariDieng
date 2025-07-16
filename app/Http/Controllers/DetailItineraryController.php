<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\DetailItinerary;
use Illuminate\Http\Request;

class DetailItineraryController extends Controller
{
    public function index(Request $request)
    {
        $query = DetailItinerary::with('paket');

        if ($request->filled('paket_id')) {
            $query->where('paket_id', $request->paket_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('detail', 'like', "%{$search}%")
                  ->orWhere('day', 'like', "%{$search}%")
                  ->orWhere('time', 'like', "%{$search}%");
            });
        }

        $detail_itinerary = $query->latest()->paginate(5);
        $pakets = Paket::all();

        return view('admin.page.detail_itinerary.index', compact('detail_itinerary', 'pakets'));
    }

    public function create(Request $request)
    {
        $paket = Paket::all();
        $paket_id = $request->get('paket_id');
        $is_synchronized = !is_null($paket_id);

        if ($is_synchronized && $paket_id) {
            $selected_paket = Paket::find($paket_id);
            if (!$selected_paket) {
                return redirect()->route('detail-itinerary.create')
                    ->with('error', 'Paket tidak ditemukan!');
            }

            return view('admin.page.detail_itinerary.create-sync', [
                'selected_paket' => $selected_paket
            ]);
        }

        return view('admin.page.detail_itinerary.create', compact('paket'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'paket_id' => 'required|exists:paket,id',
            'day' => 'required|integer|min:1|max:31',
            'time' => 'required|date_format:H:i',
            'detail' => 'required|string|max:1000',
        ]);

        // Cek duplikasi
        $exists = DetailItinerary::where('paket_id', $request->paket_id)
            ->where('day', $request->day)
            ->where('time', $request->time)
            ->exists();

        if ($exists) {
            return back()->withInput()->with('error', 'Itinerary dengan kombinasi hari dan jam tersebut sudah ada pada paket ini.');
        }

        DetailItinerary::create([
            'paket_id' => $request->paket_id,
            'day' => $request->day,
            'time' => $request->time,
            'detail' => $request->detail
        ]);

        if ($request->has('is_synchronized')) {
            return redirect()->route('paket.show', $request->paket_id)
                ->with('success', 'Detail itinerary berhasil ditambahkan ke paket!');
        }

        return redirect()->route('detail-itinerary.index')->with('success', 'Detail itinerary berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $detailItinerary = DetailItinerary::findOrFail($id);
        $pakets = Paket::all();

        return view('admin.page.detail_itinerary.edit', compact('detailItinerary', 'pakets'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'paket_id' => 'required|exists:paket,id',
            'day' => 'required|integer|min:1|max:31',
            'time' => 'required|date_format:H:i',
            'detail' => 'required|string|max:1000',
        ]);

        $detailItinerary = DetailItinerary::findOrFail($id);

        $exists = DetailItinerary::where('paket_id', $request->paket_id)
            ->where('day', $request->day)
            ->where('time', $request->time)
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return back()->withInput()->with('error', 'Kombinasi hari dan waktu sudah digunakan pada itinerary lain untuk paket ini.');
        }

        $detailItinerary->update([
            'paket_id' => $request->paket_id,
            'day' => $request->day,
            'time' => $request->time,
            'detail' => $request->detail
        ]);

        return redirect()->route('detail-itinerary.index')->with('success', 'Detail itinerary berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $detailItinerary = DetailItinerary::findOrFail($id);
        $detailItinerary->delete();

        return redirect()->route('detail-itinerary.index')->with('success', 'Data berhasil dihapus!');
    }
}
