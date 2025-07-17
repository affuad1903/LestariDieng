<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * ADMIN: Generate link berdasarkan paket yang dipilih
     */
    public function generateLink(Request $request)
    {
        $pakets = Paket::all();
        $generatedLink = null;

        if ($request->filled('paket_id')) {
            $paketId = $request->paket_id;
            $generatedLink = route('review.create', ['paket_id' => $paketId]);
        }

        return view('admin.page.review.generate_link', compact('pakets', 'generatedLink'));
    }

    /**
     * PENGUNJUNG: Tampilkan form review berdasarkan paket
     */
    public function create(Request $request)
    {
        $pakets = Paket::all();
        $paket_id = $request->query('paket_id');

        // Validasi ID paket
        if (!$pakets->contains('id', $paket_id)) {
            return redirect()->route('home')->with('error', 'Paket tidak ditemukan.');
        }

        return view('page.review.create', compact('pakets', 'paket_id'));
    }

    /**
     * PENGUNJUNG: Simpan data review
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'       => 'required|string|max:255',
            'paket_id'   => 'required|exists:paket,id',
            'isi_review' => 'required|string|max:1000',
            'bintang'    => 'required|integer|min:1|max:5',
            'no_hp'      => 'required|string|max:20',
        ]);

        Review::create([
            'nama'       => $request->nama,
            'paket_id'   => $request->paket_id,
            'isi_review' => $request->isi_review,
            'bintang'    => $request->bintang,
            'no_hp'      => $request->no_hp,
        ]);

        return redirect()->back()->with('success', 'Terima kasih atas review Anda!');
    }

    /**
     * ADMIN: Tampilkan semua review
     */
    public function index()
    {
        $reviews = Review::with('paket')->latest()->paginate(10);
        return view('admin.page.review.index', compact('reviews'));
    }
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('review.index')->with('success', 'Review berhasil dihapus.');
    }
    public function kontakKirim(Request $request)
    {
        $validated = $request->validate([
            'contactus_name' => 'required|string|max:255',
            'contactus_phone' => 'required|string|max:20',
            'contactus_email' => 'required|email',
            'contactus_subject' => 'required|string|max:255',
            'contactus_message' => 'required|string',
        ]);

        // Simpan ke database atau kirim email
        // Contoh kirim email (butuh konfigurasi mail di .env):
        /*
        Mail::to('admin@lestariwisata.com')->send(new ContactUsMail($validated));
        */

        return back()->with('success', 'Pesan kamu telah dikirim! Kami akan segera menghubungi kamu.');
    }}
