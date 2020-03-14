<?php


namespace App\ServicesAndHelpers;


use App\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class UserService
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function createUser()
    {
        $user = new User();

        $user->email = $this->request->email;
        $user->name = $this->request->name ?? '*';
        $user->phone = $this->request->phone ?? '*';
        $user->user_info = $this->request->userInfo ?? '*';
        $user->password = bcrypt($this->request->newPassword);
        $user->rank = $this->request->rank ?? '100';
        $user->role_id = 2;
        $user->photo = $this->createImage();
        $user->save();
    }

    public function updateUser(User $user){
        $user->name = $this->request->name ?? '*';
        $user->phone = $this->request->phone ?? '*';

        $user->user_info = $this->request->userInfo ?? '*';
        if($this->request->has('password')){
            $user->password = bcrypt($this->request->newPassword);
        }

        $user->rank = $this->request->rank ?? '100';

        if($this->request->has('photo')){
            Storage::delete($user->photo);
            $user->photo = $this->createImage();
        }
        $user->save();
    }

    public function createImage()
    {
        if (!$this->request->has('photo')) {
            return '';
        }
        while (true) {
            $name = uniqid() . '.png';
            $path = 'storage/photos/user_photos/' . $name;
            if (!file_exists($path)) {
                break;
            }
        }
        $image_resize = Image::make($this->request->photo->getRealPath()); //Возьмем фото
        $width = $image_resize->width();
        $height = $image_resize->height();
        //уменьшим в 2 раза размер
        if ($width > 1280) {
            $width /= 2;
        }
        if ($height > 720) {
            $height /= 2;
        }
        $image_resize->resize($width, $height)
            ->save($path);//сохраним

        return $path;
    }
}
