<?php
    namespace App\Repositories; //bien penser au namespace

    use Illuminate\Http\UploadedFile;

    class PhotosRepository implements PhotosRepositoryInterface
    {
        public function save(UploadedFile $image)
        {
            $image->store(config('images.path'), 'public'); //ce qui était dans le controller
        }
    }
