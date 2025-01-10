<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use App\Models\Apiqu;

class ApiquController extends Controller
{
    public function apiqu() {
        
        $response = Http::get('https://equran.id/api/v2/surat');
        
    
        if ($response->successful()) {
            $data = $response->json()['data'];
            
            
            foreach ($data as $item) {
                
                Apiqu::updateOrCreate(
                    ['nomorSurat' => $item['nomor']],
                    [
                        'namaSurat' => $item['nama'],
                        'namaLatin' => $item['namaLatin'],
                        'jumlahAyat' => $item['jumlahAyat'],
                        'tempatTurun' => $item['tempatTurun'],
                        'arti' => $item['arti'],
                        'deskripsi' => $item['deskripsi'],
                    ]
                );
            }
            
            
            $apiqu = Apiqu::all();
            
            
            return response()->json([
                'code' => 200,
                'message' => 'data successfully',
                'data' => $apiqu,
            ]);
        } else {
            
            return response()->json([
                'code' => 500,
                'message' => 'Failed to fetch data surah from external API'
            ], 500);
        }
    }
}
