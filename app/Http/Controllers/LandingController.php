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
        $rank = $request->input('rank');

        $process = new Process(["python", "query.py", "indexdb.pkl", $rank, $query]);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $list_data = array_filter(explode("\n", $process->getOutput()));
        $data = [];

        foreach ($list_data as $book) {
            $dataj = json_decode($book, true);
            $data[] = '
                <div class="col-lg-2 col-md-2 mb-4">
                    <div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden transition-all hover-shadow-lg">
                        <div class="position-relative overflow-hidden">
                            <img src="http://books.toscrape.com/' . $dataj['image'] . '" class="card-img-top img-fluid rounded-top" alt="' . $dataj['title'] . '" style="height: 280px; object-fit: cover;">
                            <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-0 transition-opacity duration-300 hover-opacity-25"></div>
                        </div>
                        <div class="card-body d-flex flex-column p-4">
                            <h7 class="card-title text-dark fw-bold mb-3" style="font-size: 0.8rem;">' . $dataj['title'] . '</h7>
                                <p class="card-text fs-5 text-success fw-bold mb-3" style="font-size: 0.4rem;">
                                    Harga: ' . $dataj['price'] . '
                                </p>
                            <div class="mt-auto">
                                <a href="http://books.toscrape.com/catalogue/' . $dataj['url'] . '" class="btn btn-success w-100 py-2 rounded-pill fw-bold transition-all hover-bg-success hover-text-white">
                                    <i class="fas fa-eye me-2"></i>View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }

        return response()->json($data);
    }
}