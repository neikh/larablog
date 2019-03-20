<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;

    class ImageController extends Controller
    {
        public function store(ImagesRequest $request, PhotosRepositoryInterface $photosRepository)
        {
            $photosRepository->save($request->image);
            return view('photo_ok');
        }
    }
