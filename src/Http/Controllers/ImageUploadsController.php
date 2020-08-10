<?php

namespace Wink\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class ImageUploadsController
{
    /**
     * Upload a new image.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload()
    {
        $path = request()->file('image')->store(
            config('wink.storage_path'),
            request()->file('image')->getHashName() . request()->file('image')->getClientOriginalExtensio(),
            [
                'disk' => config('wink.storage_disk'),
                'visibility' => 'public',
            ]
        );

        return response()->json([
            'url' => Storage::disk(config('wink.storage_disk'))->url($path),
        ]);
    }
}
