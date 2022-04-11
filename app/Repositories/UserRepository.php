<?php

namespace App\Repositories;

use App\Model\Company;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function get($id)
    {
        return User::where('id', $id)->first();
    }

    public function create($data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'company_id' => $data['company_id'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * @throws \Throwable
     */
    public function createWithCompany($data)
    {
        return DB::transaction(function() use ($data) {
            $company = new Company();
            $company->save();
            $user = new User;
            $user->email = $data->email;
            $user->name = $data->name;
            $user->company_id = $company->id;
            $user->password = bcrypt($data->password);
            $user->save();
            return $user;
        });
    }
}
