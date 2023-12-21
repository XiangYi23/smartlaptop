<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\favorites;
use App\Models\laptop;


class FavoritesController extends Controller
{
    // 添加收藏
    public function toggleFavorite(Request $request, $laptopId)
    {
        $user = auth()->user();
        $laptop = Laptop::find($laptopId);

        // 检查用户是否已经收藏了指定的产品
        $isFavorited = $user->favorites->contains('laptop_id', $laptopId);

        if (!$isFavorited) {
            // 如果未收藏，创建一个新的收藏记录
            $user->favorites()->create(['laptop_id' => $laptopId]);
            $message = '产品已成功添加到收藏夹。';
        } else {
            // 如果已收藏，移除收藏记录
            $user->favorites()->where('laptop_id', $laptopId)->delete();
            $message = '产品已从收藏夹中移除。';
        }

        return redirect()->back()->with('success', $message);
    }

    // 列出用户的所有收藏
    public function listFavorites()
    {
        $userId = auth()->user()->id;
        
        // 查询用户的收藏数据，同时获取与之关联的 laptop 数据
        $favorites = Favorites::where('user_id', $userId)->with('laptop')->get();

        return view('favorites', ['favorites' => $favorites]);
    }

    public function adminListFavorites()
    {
        $userId = auth()->user()->id;
        
        // 查询用户的收藏数据，同时获取与之关联的 laptop 数据
        $favorites = Favorites::where('user_id', $userId)->with('laptop')->get();

        return view('adminFavorites', ['favorites' => $favorites]);
    }
}


