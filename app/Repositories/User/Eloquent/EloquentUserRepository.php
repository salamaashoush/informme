<?php
namespace App\Repositories\User\Eloquent;

use App\Events\SendVerificationCodeEvent;
use App\Repositories\EloquentBaseRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Hash;

class EloquentUserRepository extends EloquentBaseRepository implements UserRepository
{
    public function login ($request){
        // $code = random_int(100000, 999999);
        $code =1111;
       $user =  $this->updateOrCreate(
           ["mobile"=>$request->mobile],[
            "verification_code"=>$code
        ]);
        event(new SendVerificationCodeEvent($user));
        return $user;
    }

}
