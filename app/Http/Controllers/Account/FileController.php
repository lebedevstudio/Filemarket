<?php

namespace App\Http\Controllers\Account;

use App\File;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFileRequest;

class FileController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $files = auth()->user()->files()->latest()->finished()->get();

        return view('account.files.index', compact('files'));
    }

    /**
     * @param File $file
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create(File $file)
    {
        if (!$file->exists) {
            $file = $this->createEmptyFile();

            return redirect()->route('account.files.create', $file);
        }

        $this->authorize('touch', $file);

        return view('account.files.create', compact('file'));
    }

    /**
     * @param File $file
     * @param StoreFileRequest $request
     * @return mixed
     */
    public function store(File $file, StoreFileRequest $request)
    {
        $this->authorize('touch', $file);

        $file->update(array_merge(
            $request->only(['title', 'overview_short', 'overview', 'price']),
            ['finished' => true]
        ));

        return redirect()
            ->route('account.files.index')
            ->withSuccess('Новый файл успешно создан.');
    }

    /**
     * @param File $file
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(File $file)
    {
        $this->authorize('touch', $file);

        return view('account.files.edit', compact('file'));
    }

    /**
     * @return mixed
     */
    protected function createEmptyFile()
    {
        return auth()->user()->files()->create([
            'title' => 'Новый',
            'overview_short' => 'Пусто',
            'overview' => 'Пусто',
            'price' => 0,
            'finished' => false,
        ]);
    }
}
