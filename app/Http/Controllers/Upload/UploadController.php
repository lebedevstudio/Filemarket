<?php

namespace App\Http\Controllers\Upload;

use App\{File, Upload};
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    /**
     * UploadController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param File $file
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(File $file)
    {
        $this->authorize('touch', $file);

        $uploadedFile = request('file');
        $upload = $this->storeUpload($file, $uploadedFile);

        Storage::disk('local')->putFileAs(
            'files/' . $file->identifier, $uploadedFile, $upload->filename
        );

        return response()->json(['id' => $upload->id]);
    }

    /**
     * @param File $file
     * @param Upload $upload
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(File $file, Upload $upload)
    {
        $this->authorize('touch', $file);
        $this->authorize('touch', $upload);

        if ($this->oneFileLeft($file)) {
            return response()->json(null, 422);
        }

        $upload->delete();
    }

    /**
     * @param File $file
     * @param UploadedFile $uploadedFile
     * @return Upload
     */
    protected function storeUpload(File $file, UploadedFile $uploadedFile)
    {
        // Немного отойдем от общего стиля написания кода, ибо
        // в данном случае этот вариант будет проще и удобнее.
        $upload = new Upload();

        $upload->fill([
            'filename' => $this->getFilename($uploadedFile),
            'file_size' => $this->getFileSize($uploadedFile),
        ]);
        $upload->file()->associate($file);
        $upload->user()->associate(auth()->user());
        $upload->save();

        return $upload;
    }

    /**
     * @param UploadedFile $uploadedFile
     * @return null|string
     */
    protected function getFilename(UploadedFile $uploadedFile)
    {
        return $uploadedFile->getClientOriginalName();
    }

    /**
     * @param UploadedFile $uploadedFile
     * @return int
     */
    protected function getFileSize(UploadedFile $uploadedFile): int
    {
        return $uploadedFile->getSize();
    }

    /**
     * @param File $file
     * @return bool
     */
    protected function oneFileLeft(File $file): bool
    {
        return $file->uploads->count() === 1;
    }
}
