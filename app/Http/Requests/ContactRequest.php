<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'contactus_name' => 'required|string|max:255|min:2|regex:/^[a-zA-Z\s]+$/',
            'contactus_phone' => [
                'required',
                'string',
                'max:20',
                'min:10',
                'regex:/^(\+62|62|0)[0-9]{8,13}$/'
            ],
            'contactus_email' => 'required|email|max:255',
            'contactus_subject' => 'required|string|max:255|min:3',
            'contactus_message' => 'required|string|max:1000|min:10',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'contactus_name.required' => 'Nama harus diisi.',
            'contactus_name.min' => 'Nama minimal 2 karakter.',
            'contactus_name.max' => 'Nama maksimal 255 karakter.',
            'contactus_name.regex' => 'Nama hanya boleh berisi huruf dan spasi.',
            'contactus_phone.required' => 'Nomor telepon harus diisi.',
            'contactus_phone.min' => 'Nomor telepon minimal 10 karakter.',
            'contactus_phone.max' => 'Nomor telepon maksimal 20 karakter.',
            'contactus_phone.regex' => 'Format nomor telepon tidak valid. Contoh: 081234567890 atau +62812345678901.',
            'contactus_email.required' => 'Email harus diisi.',
            'contactus_email.email' => 'Format email tidak valid.',
            'contactus_email.max' => 'Email maksimal 255 karakter.',
            'contactus_subject.required' => 'Subjek harus diisi.',
            'contactus_subject.min' => 'Subjek minimal 3 karakter.',
            'contactus_subject.max' => 'Subjek maksimal 255 karakter.',
            'contactus_message.required' => 'Pesan harus diisi.',
            'contactus_message.min' => 'Pesan minimal 10 karakter.',
            'contactus_message.max' => 'Pesan maksimal 1000 karakter.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        // Honeypot check untuk mencegah bot spam
        if ($this->filled('website')) {
            abort(422, 'Spam terdeteksi!');
        }
    }

    /**
     * Get sanitized data after validation
     *
     * @return array
     */
    public function getSanitizedData(): array
    {
        $validated = $this->validated();
        
        return [
            'name' => strip_tags(trim($validated['contactus_name'])),
            'phone' => strip_tags(trim($validated['contactus_phone'])),
            'email' => filter_var($validated['contactus_email'], FILTER_SANITIZE_EMAIL),
            'subject' => strip_tags(trim($validated['contactus_subject'])),
            'message' => strip_tags(trim($validated['contactus_message'])),
        ];
    }

    /**
     * Get data formatted for email
     *
     * @return array
     */
    public function getEmailData(): array
    {
        $sanitizedData = $this->getSanitizedData();
        
        return [
            'contactus_name' => $sanitizedData['name'],
            'contactus_phone' => $sanitizedData['phone'],
            'contactus_email' => $sanitizedData['email'],
            'contactus_subject' => $sanitizedData['subject'],
            'contactus_message' => $sanitizedData['message'],
        ];
    }
}
