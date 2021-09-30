<?php

namespace App\Actions\Fortify;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Str;
class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {

        // if($input === 'admin'){
        //     Validator::make($input, [
        //         'name' => ['required', 'string', 'max:255'],
        //         'email' => [
        //             'required',
        //             'string',
        //             'email',
        //             'max:255',
        //             Rule::unique(Admin::class),
        //         ],
        //         'password' => $this->passwordRules(),
        //     ])->validate();
    
        //     return Admin::create([
        //         'name' => $input['name'],
        //         'email' => $input['email'],
        //         'password' => Hash::make($input['password']),
        //     ]);
        // }

    

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255',
                Rule::unique(User::class),],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'role' =>  $input['role'],
            'state' => $input['state'],
            'parent_id' => $input['parent_id'],
            'email_verified_at' => now(),
        ]);
    }
}
