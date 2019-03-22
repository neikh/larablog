<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Http\Requests\ImagesRequest;
    use App\Repositories\PhotosRepository;

    class ImageController extends Controller
    {
        public function __construct()
        {
        $this->middleware('auth');
        }

        public function store(ImagesRequest $request, PhotosRepository $photosRepository)
        {
            $photosRepository->save($request->image);
            return back();
        }
    }
