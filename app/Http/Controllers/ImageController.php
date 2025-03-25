<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use \App\Models\GenerativeModel;

use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function create()
    {
        $url = url('images/placeholder.png');
        $models = GenerativeModel::all();
        return Inertia::render('Image/Create', [
            'models' => $models,
            'url' => $url
        ]);
    }

    public function store(Request $request) {
        $request->validate([
          'model' => ['required'],
          'prompt' => ['required'],
        ]);

        $model = GenerativeModel::query()
            ->where('name', '=', $request->model)
            ->firstOrFail();

        $client = new GuzzleClient();
        $response = $client->post(
            $model->endpoint, [
                'headers' => [
                    'Authorization' => 'Bearer sk-7DmpnSxtdeUs2DLpGHhoKlgLiQJ7C9ZWsfWd84xq7kkEFsb4',
                    'Accept' => 'image/*',
                ],
                'multipart' => [
                    [
                        'name' => 'none',
                        'contents' => ''
                    ],
                    [
                        'name' => 'prompt',
                        'contents' => $request->prompt
                    ],
                    [
                        'name' => 'output_format',
                        'contents' => 'png'
                    ],
                ],
            ]
        );

        if ($response->getStatusCode() == 200) {
            $url = str()->random() . ".png";
            Storage::disk('public')->put($url, $response->getBody()); 
            $models = GenerativeModel::all();
            return Inertia::render('Image/Create', [
                'models' => $models,
                'url' => url('storage/' . $url)
            ]);
        }

    }
}
