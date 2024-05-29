<?php

namespace App\Http\Controllers;

use App\Models\data_alat;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DataBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */ 
    public function index()
    {
        $client = new Client();
        $url1 = "http://127.0.0.1:8000/api/data_alat";
        $url2 = "http://127.0.0.1:8000/api/pinjam";
    
        // Request data from first API
        $response1 = $client->request('GET', $url1);
        $content1 = $response1->getBody()->getContents();
        $contentArray1 = json_decode($content1, true);
        $dataAlat = $contentArray1['data'];
    
        // Request data from second API
        $response2 = $client->request('GET', $url2);
        $content2 = $response2->getBody()->getContents();
        $contentArray2 = json_decode($content2, true);
        $dataPinjam = $contentArray2['data'];
    
        // Send both datasets to the view
        return view('all.alat', [
            'dataAlat' => $dataAlat,
            'dataPinjam' => $dataPinjam
        ]);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/data_alat/delete/{$id}";

        try {
            $response = $client->request('DELETE', $url);
            $statusCode = $response->getStatusCode();

            if ($statusCode == 204) {
                return redirect()->route('data-alat')->with('success', 'Data berhasil dihapus.');
            } else {
                return redirect()->route('data-alat')->with('error', 'Gagal menghapus data.');
            }
        } catch (\Exception $e) {
            // Penanganan kesalahan saat menghubungi API
            Log::error('Error deleting data: ' . $e->getMessage()); // Logging pesan kesalahan
            return redirect()->route('data-alat')->with('error', 'Terjadi kesalahan saat menghubungi API.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateKonfirmasi(Request $request, $id)
    {
        $data_alat = data_alat::find($id);
        
        if ($data_alat) {
            $data_alat->keterangan = $request->keterangan;
            
            $data_alat->save();
            
            // Redirect ke halaman history mahasiswa
            return redirect()->route('data-alat');
        }
        
        // Jika data tidak ditemukan, kembalikan respon atau lakukan penanganan kesalahan lainnya
        return response()->json(['message' => 'Data not found'], 404);
    }
}
