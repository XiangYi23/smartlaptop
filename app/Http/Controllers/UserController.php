<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Review;
use App\Models\favorites;

class UserController extends Controller
{
    public function showUserProfile($id)
    {
        $user = User::find($id);
        $reviewCount = Review::where('user_id', $user->id)->count();
        $favoriteCount = Favorites::where('user_id', $user->id)->count();

        if (!$user) {
            return abort(404);
        }

        return view('profile', compact('user', 'reviewCount', 'favoriteCount'));
    }

    public function showAdminProfile($id)
    {
        $user = User::find($id);
        $reviewCount = Review::where('user_id', $user->id)->count();
        $favoriteCount = Favorites::where('user_id', $user->id)->count();

        if (!$user) {
            return abort(404);
        }

        return view('adminProfile', compact('user', 'reviewCount', 'favoriteCount'));
    }
}
