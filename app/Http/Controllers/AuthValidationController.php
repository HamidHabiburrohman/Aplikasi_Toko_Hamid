<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthValidationController extends Controller
{
    /**
     * Menjalankan validasi real-time untuk field yang dikirimkan.
     * Dipanggil oleh Alpine.js dari form Sign-in via AJAX ke route /validate-field-realtime.
     */
    public function validateField(Request $request)
    {
        // 1. Ambil nama field ('email') dan nilainya dari request AJAX
        $field = $request->input('field');
        $value = $request->input('value');
        
        // 2. Tentukan Aturan Validasi untuk Real-Time Check
        // Untuk Sign-In, kita hanya ingin memastikan format email benar.
        $rules = [
            'email' => ['required', 'email'], 
        ];

        // 3. Pastikan field yang dikirim ada di daftar rules
        if (!isset($rules[$field])) {
            // Jika field tidak perlu divalidasi real-time, kembalikan true
            return response()->json(['valid' => true]);
        }

        // 4. Lakukan validasi menggunakan Validator Facade
        $validator = Validator::make([$field => $value], [$field => $rules[$field]]);
        
        if ($validator->fails()) {
            // 5. Jika validasi gagal, kirim status 'false' dan pesan error pertama
            return response()->json([
                'valid' => false,
                'message' => $validator->errors()->first($field) 
            ]);
        }

        // 6. Jika validasi sukses (email terisi dan format benar)
        return response()->json(['valid' => true]);
    }
}
