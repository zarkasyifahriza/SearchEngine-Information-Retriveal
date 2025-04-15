<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class LandingController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');
        $rank = $request->input('rank', 10); // Default rank jika tidak diberikan

        // Jalankan script Python
        $process = new Process(["python", public_path('query.py'), public_path('list.json'), $rank, $query]);
        $process->run();

        // Periksa apakah proses berhasil
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        // Ambil output dari script Python
        $list_data = json_decode($process->getOutput(), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(['error' => 'Terjadi kesalahan saat memproses data.'], 500);
        }

        // Format hasil pencarian untuk ditampilkan di frontend
        $data = [];
        foreach ($list_data as $item) {
            $data[] = '
                <div class="result-item">
                    <h5><a href="' . $item['url'] . '" target="_blank">' . $item['title'] . '</a></h5>
                    <p>' . $item['description'] . '</p>
                    <p><small>' . $item['url'] . '</small></p>
                    <p><strong>Nomor:</strong> ' . (isset($item['Nomor']) ? $item['Nomor'] : 'Tidak tersedia') . '</p>
                </div>
            ';
        }

        return response()->json($data);
    }
}