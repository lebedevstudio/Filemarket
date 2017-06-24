<?php

namespace App\Http\Controllers\Account;

use App\File;
use App\Http\Controllers\Controller;
use App\Http\Requests\{
    StoreFileRequest, UpdateFileRequest
};

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

        $file->update($this->fileFields($request));

        return redirect()->route('account.files.index')
            ->withSuccess('Новый файл успешно создан.');
    }

    /**
     * @param File $file
     * @param UpdateFileRequest $request
     * @return mixed
     */
    public function update(File $file, UpdateFileRequest $request)
    {
        $this->authorize('touch', $file);

        $properties = $request->only(File::APPROVAL_PROPERTIES);

        if ($file->needsApproval($properties)) {
            $file->createApproval($properties);

            return back()->withSuccess('Файл был изменен. Мы рассмотрим все изменения как можно быстрее!');
        }

        $file->update([
            'live' => $request->get('live', false),
            'price' => $request->get('price'),
        ]);

        return back()->withSuccess('Файл успешно обновлен.');
    }

    /**
     * @param File $file
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(File $file)
    {
        $this->authorize('touch', $file);

        $approvals = $file->approvals()->latest()->first();

        return view('account.files.edit', compact('file', 'approvals'));
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

    /**
     * @param StoreFileRequest $request
     * @return array
     */
    protected function fileFields(StoreFileRequest $request): array
    {
        return array_merge(
            $request->only(['title', 'overview_short', 'overview', 'price']),
            ['finished' => true]
        );
    }
}
