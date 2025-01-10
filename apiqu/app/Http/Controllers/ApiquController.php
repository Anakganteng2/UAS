<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use App\Models\Apiqu;
use App\Models\DetailAyat;
use App\Models\DetailTafsir;
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

    public function detailIm() {
        
        $client = new Client([
            'timeout' => 3600,
            'connect_timeout' => 3600,
            'retry' => 10,
        ]);
        
        
        for ($nomor = 1; $nomor <= 114; $nomor++) {
            $url = "https://equran.id/api/v2/surat/{$nomor}";
            $response = Http::get($url);
            
            
            if ($response->successful()) {
                $data = $response->json()['data']['ayat'];
                
                
                foreach ($data as $ayat) {
                    
                    DetailAyat::updateOrCreate([
                        'nomorSurat' => $nomor,
                        'nomorAyat' => $ayat['nomorAyat'],
                    ],
                    [
                        'teksArab' => $ayat['teksArab'],
                        'teksLatin' => $ayat['teksLatin'],
                        'teksIndonesia' => $ayat['teksIndonesia'],
                    ]);
                }
            } else {
                
                return response()->json([
                    'code' => 500,
                    'message' => "Failed"
                ], 500);
            }
        }

        
        return response()->json([
            'code' => 200,
            'message' => 'successfully'
        ]);
    }

    
    public function ayatDe($nomor) {
        $ayatDe = DetailAyat::where('nomorSurat', $nomor)->get();
        return response()->json([
            'code' => 200,
            'message' => 'successfully',
            'data' => $ayatDe,
        ]);
    }

    public function tafsirIm() {
        
        $client = new Client([
            'timeout' => 3600,
            'connect_timeout' => 3600,
            'retry' => 10,
        ]);

        
        for ($nomor = 1; $nomor <= 114; $nomor++) {
            $url = "https://equran.id/api/v2/tafsir/{$nomor}";
            $response = Http::get($url);

            
            if ($response->successful()) {
                $data = $response->json()['data']['tafsir'];

                
                foreach ($data as $ayat) {
                    
                    DetailTafsir::updateOrCreate([
                        'nomorSurat' => $nomor,
                        'nomorAyat' => $ayat['ayat'],
                    ],
                    [
                        'teksTafsir' => $ayat['teks'],
                    ]);
                }
            } else {
                
                return response()->json([
                    'code' => 500,
                    'message' => 'Failed'
                ], 500);
            }
        }

        
        return response()->json([
            'code' => 200,
            'message' => 'successfully'
        ]);
    }

    
    public function tafsirDe($nomor) {
        $tafsirDe = DetailTafsir::where('nomorSurat', $nomor)->get();
        return response()->json([
            'code' => 200,
            'message' => 'Data tafsir retrieved successfully',
            'data' => $tafsirDe,
        ]);
    }
}
