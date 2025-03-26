<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use \App\Models\GenerativeModel;
use \App\Models\Image;

use GuzzleHttp\Psr7;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;

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

        $url = null;
        $profile = Auth::user()->profile;

        // [ERROR] Balance not enough
        if ($model->cost > $profile->balance) {
            $toast = [
                'title' => "Balance is not enough",
                'description' =>
                    "Your account does not have enough balance, refill " . 
                    "it or you won't be able to generate images",
                'variant' => "destructive",
            ];
            return redirect()->route('image.create')
                         ->with('image_url', $url)
                         ->with('toast', $toast);
        }

        $headers = [
                    'Authorization' => 'Bearer sk-iTIAZq8e6TAMTTX0l12tiF9tfJlAhJJZx7IksBJnZSYBjmvn',
                    'Accept' => 'image/*',
                ];

        $multipart = [
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
                ];

        $client = new GuzzleClient();
        try {
            $response = $client->post(
                $model->endpoint, [
                    'headers' => $headers,
                    'multipart' => $multipart
                ]
            );
            $url = str()->random() . ".png";
            Storage::disk('public')->put(
                $url, $response->getBody()
            ); 

            Image::create([
                'generative_model_id' => $model->id,
                'profile_id' => $profile->id,
                'link' => $url,
                'prompt' => $request->prompt,
                'attachment' => $url,
                'type' => 'png',
                'photo_size' => Storage::disk('public')->size($url),
                'resolution' => '1000x1000'
            ]);

            $url = Storage::disk('public')->url($url);
            $toast = [
                'description' => "Image generated successfully",
                'title' => "Success",
                'variant' => "success",
            ];


        } catch (ClientException $e) {
            $body = json_decode($e->getResponse()->getBody(), true);
            $toast = [
                'description' => $body['errors'][0],
                'title' => $body['name'],
                'variant' => "destructive",
            ];

        }

        return redirect()->route('image.create')
                         ->with('image_url', $url)
                         ->with('toast', $toast);
    }
}
