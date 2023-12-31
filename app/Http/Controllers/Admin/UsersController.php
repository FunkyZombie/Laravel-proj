<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Queries\UsersQueryBuilder;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct(
        protected UsersQueryBuilder $usersQueryBuilder
    ) {
    }
    /**
     * Handle the incoming request.
     */
    public function index(Request $request): View
    {
        return view('admin.users.index', [
            'usersList'  => $this->usersQueryBuilder->getAll()
        ]);
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        try {
            $data = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
            ]);

            $data['isAdmin'] = $request->appoint === "on" ? 1 : 0;

            $user = $user->fill($data);

            if($user->save()) {
                return redirect()->route('admin.users.index')->with('success', __('User has been updated'));
            }
        } catch (\Exception $e) {
            // return new \Error($e->getMessage(), $e->getCode());
            return back()->with('error', __('User has not been update'));
        }
    }

    
}
