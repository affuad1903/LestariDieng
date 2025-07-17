<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\Paket;
use App\Models\Galery;
use App\Models\Review;
use App\Models\Destination;
use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ContactUsMail;
use App\Http\Requests\ContactRequest;


class PageController extends Controller
{
    public function homeIndex(){
        $home = Home::with(['socialMedias', 'legalities', 'contacts'])->first();
        $destination = Destination::where('is_main_page', true)->get();
        $pakets = Paket::where('is_main_page', true)->get();
        $reviews = Review::latest()->take(6)->get(); 

        return view('page.home', [
            'home' => $home,
            'pakets' => $pakets,
            'destinations' => $destination,
            'reviews' => $reviews,
        ]);
    }
    public function destinasiIndex(){
        $home = Home::with(['socialMedias', 'legalities', 'contacts'])->first();
        $destination = Destination::all();
        return view('page.destinasi.index', compact('destination', 'home'));
    }
    public function destinasiShow($id)
    {
        $home = Home::with(['socialMedias', 'legalities', 'contacts'])->first();
        $destination = Destination::with(['destination_section', 'destination_uniq'])->findOrFail($id);
        $destinationAll = Destination::where('id', '!=', $id)->get();
        if ($destinationAll->count() < 4) {
            $randomDestination = Destination::all()->shuffle()->take(4);
        } else {
            $randomDestination = $destinationAll->shuffle()->take(4);
        }

        return view('page.destinasi.show', [

            'destination' => $destination,
            'home' => $home,
            'destinationAll' => $destinationAll,
            'randomDestination' => $randomDestination,
        ]);
    }
    public function paketIndex(){
        $home = Home::with(['socialMedias', 'legalities', 'contacts'])->first();
        $pakets = Paket::all();
        return view('page.paket.index', compact('pakets','home'));
    }
    public function paketShow($id)
    {
        $home = Home::with(['socialMedias', 'legalities', 'contacts'])->first();
        $paket = Paket::with(['daftar_destinasi', 'daftar_fasilitas', 'detailItinerary'])->findOrFail($id);

        // group by day, lalu sort by time di masing-masing group
        $groupedItinerary = $paket->detailItinerary
            ->sortBy('time')
            ->groupBy('day');

        return view('page.paket.show', [
            'paket' => $paket,
            'home' => $home,
            'groupedItinerary' => $groupedItinerary,
        ]);
    }
    public function galeriIndex(){
        $home = Home::with(['socialMedias', 'legalities', 'contacts'])->first();
        $galeries = Galery::with('galery_img')->get();
        return view('page.galery.index', compact('home', 'galeries'));
    }
    public function galeriShow($id)
    {
        $home = Home::with(['socialMedias', 'legalities', 'contacts'])->first();
        $galery = Galery::with('galery_img')->findOrFail($id);
        return view('page.galery.show', compact('galery','home'));
    }
    public function kontakIndex()
    {
        $home = Home::with(['socialMedias', 'legalities', 'contacts'])->first();
        return view('page.kontak.index', compact('home'));
    }

    public function kontakKirim(ContactRequest $request)
    {
        try {
            // Rate limiting sederhana - max 3 pesan per nomor telepon per 30 menit
            $phoneLastFour = substr($request->contactus_phone, -4);
            $recentMessages = ContactMessage::where('created_at', '>=', now()->subMinutes(30))
                ->where('phone', 'LIKE', '%' . $phoneLastFour)
                ->count();
            
            if ($recentMessages >= 3) {
                return back()->with('error', 'Anda telah mengirim terlalu banyak pesan. Silakan tunggu beberapa saat sebelum mengirim pesan lagi.')
                            ->withInput();
            }

            // Dapatkan data yang sudah disanitasi dari request
            $sanitizedData = $request->getSanitizedData();

            // Simpan ke database terlebih dahulu
            $contactMessage = ContactMessage::create($sanitizedData);

            // Log untuk debugging
            Log::info('Contact message created', ['id' => $contactMessage->id, 'name' => $sanitizedData['name']]);

            // Dapatkan data untuk email
            $emailData = $request->getEmailData();

            // Kirim email ke admin dengan error handling
            try {
                $adminEmail = env('MAIL_ADMIN_ADDRESS', 'affandi.p4@gmail.com');
                
                // Debug log
                Log::info('Attempting to send contact email', [
                    'admin_email' => $adminEmail,
                    'from_email' => config('mail.from.address'),
                    'subject' => $emailData['contactus_subject'],
                    'mail_driver' => config('mail.default'),
                    'smtp_host' => config('mail.mailers.smtp.host')
                ]);
                
                // Kirim email
                $mail = Mail::to($adminEmail);
                
                // Juga kirim copy ke email backup untuk testing
                if (config('app.env') === 'local') {
                    $mail->cc('affandi.p4@gmail.com'); // Backup email
                }
                
                $mail->send(new ContactUsMail($emailData));
                
                Log::info('Contact email sent successfully', [
                    'to' => $adminEmail,
                    'contact_id' => $contactMessage->id,
                    'message_id' => 'sent_at_' . now()->timestamp
                ]);
                
                return back()->with('success', 'Pesan Anda telah berhasil dikirim ke ' . $adminEmail . '! Terima kasih telah menghubungi kami. Tim kami akan segera merespon pesan Anda. (Cek juga folder Spam jika tidak ada di Inbox)');
                
            } catch (\Exception $mailException) {
                // Jika email gagal terkirim, tetapi data sudah tersimpan
                Log::error('Gagal mengirim email kontak', [
                    'error' => $mailException->getMessage(),
                    'contact_id' => $contactMessage->id,
                    'trace' => $mailException->getTraceAsString()
                ]);
                
                return back()->with('warning', 'Pesan Anda telah tersimpan, namun notifikasi email mengalami gangguan. Tim kami akan tetap menerima pesan Anda.');
            }

        } catch (\Illuminate\Database\QueryException $dbException) {
            // Error database spesifik
            Log::error('Database error saat menyimpan pesan kontak', [
                'error' => $dbException->getMessage(),
                'code' => $dbException->getCode()
            ]);
            
            return back()->with('error', 'Terjadi kesalahan pada sistem database. Silakan coba lagi atau hubungi kami melalui WhatsApp.')
                        ->withInput();
                        
        } catch (\Exception $e) {
            // Error umum
            Log::error('Error umum saat mengirim pesan kontak', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->with('error', 'Terjadi kesalahan tidak terduga. Silakan coba lagi atau hubungi kami melalui WhatsApp.')
                        ->withInput();
        }
    }
}
