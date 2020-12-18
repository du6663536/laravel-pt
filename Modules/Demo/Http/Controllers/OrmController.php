<?php

namespace Modules\Demo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Demo\Models\User;
use Modules\Demo\Models\Member;

class OrmController extends Controller
{
    public function favorites(Request $request)
    {
        $User = new User;
        $products =  $User->favoriteProducts()->where(1)->paginate(16);
        dd($products);
        return true;
    }

    public function favoritesMember(Request $request)
    {
        $Member = new Member;
        // $products =  $Member->favoriteProducts()->where('member_favorite_products.product_id', '=', 4)->paginate(16);
        $products =  $Member->favoriteProducts()->paginate(16);
        dd($products);

        return true;
    }
}
