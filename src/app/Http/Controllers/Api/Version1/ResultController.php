<?php

namespace App\Http\Controllers\Api\Version1;

use App\Http\Resources\Api\Version1\ResultResource;
use App\Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ramsey\Uuid\Uuid;
use Storage;

class ResultController extends Controller
{
    public function index(Request $request)
    {
        $query = Result::query();
        $params = [
            'per_page' => $request->input('per_page', 10)
        ];

        // TODO: Filtering

        $page = $query->paginate($params['per_page'])->appends($params)->setPath(route('api.v1.results.index'));
        return ResultResource::collection($page)->response();
    }

    public function store(Request $request)
    {
        $result = new Result;
        $data = (object) $request->input('data');
        $image = null;
        if (property_exists($data, 'image')) {
            $image = $data->image;
            unset($data->image);
        }
        $result->data = $data;
        if (property_exists($result->data, 'image_url')) {
            $result->image_url = $result->data->image_url;
        }
        if ($image) {
            $img = str_replace('data:image/jpeg;base64,', '', $image);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);

            $filename = Uuid::uuid4()->toString() . '.jpg';
            $drive = Storage::drive();
            $drive->put($filename, $data);
            $result->image_url = env('MINIO_BASE_URI') . $filename;
        }
        $result->save();
        return ResultResource::make($result)->response()->setStatusCode(201);
    }

    public function show(Request $request, Result $result)
    {
        return ResultResource::make($result)->response();
    }
}
