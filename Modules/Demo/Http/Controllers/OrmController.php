<?php

namespace Modules\Demo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Demo\Models\User;
use Modules\Demo\Models\Member;
use Modules\Demo\Models\Sample;
use Modules\Demo\Models\Extraction;
use Modules\Demo\Models\Order;
use Modules\Demo\Models\Contract;

class OrmController extends Controller
{

    // 一对一
    public function userIdentityCards()
    {
        // 查看某个人的身份证
        // $identityCard = \Modules\Demo\Models\User::find(2)->identity_card;
        // dd($identityCard);

        // 根据身份证信息找出主人
        // $user = \Modules\Demo\Models\IdentityCard::find(2)->user;
        // dd($user);



        // 有几个身份证，找出它们的主人
        // 1. 普通方式（建议使用下面一种）
        // $cards = \Modules\Demo\Models\IdentityCard::find([1, 2]);
        // foreach ($cards as $card) {
        //     echo $card->user->name;
        // }

        // // 2. 延迟加载
        $cards = \Modules\Demo\Models\IdentityCard::with('user')->find([1, 2]);
        foreach ($cards as $card) {
            echo $card->user->name;
        }
    }

    //一对多
    public function articleComments()
    {
        // $comments = \Modules\Demo\Models\Article::find(2)->comments;
        // $comments = \Modules\Demo\Models\Article::find(2)->comments()->where('content', 'like', '%教学%')->get();

        // $article = \Modules\Demo\Models\Comment::find(2)->article;

        // 延迟加载
        $comments = \Modules\Demo\Models\Article::with('comments')->find([1,2]);
        dd($comments);
    }

    //多对多
    public function roleUsers()
    {
        //获取用户id=2的 所有角色信息
        $roles = \Modules\Demo\Models\User::find(2)->roles;

        //获取角色id 为 1和2 的所有用户信息
        // \Modules\Demo\Models\Role::with('users')->find([1, 2]);

        //获取中间表字段
        foreach ($roles as $role) {
            echo $role->pivot->user_id . PHP_EOL;
            echo $role->pivot->created_at . PHP_EOL;
        }
    }

    //远程一对一
    public function authorFamousBooks()
    {
        // $famousBooks = \Modules\Demo\Models\Top::find(2)->authorFamousBooks;
        $famousBooks = \Modules\Demo\Models\Top::with('authorFamousBooks')->get();
        dd($famousBooks);

    }

    //远程一对多
    public function authorBooks()
    {
        $famousBooks = \Modules\Demo\Models\Top::find(4)->authorBooks;
        // $famousBooks = \Modules\Demo\Models\Top::with('authorBooks')->get();
        dd($famousBooks);
    }

    //多态
    public function morph()
    {
        $article = \Modules\Demo\Models\Article::find(2);
        $image = $article->image;

        dd($image);
    }

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

    public function samples()
    {
        $Sample = new Sample;
        // $samples =  $Sample->getSampleListAndOrder();
        $samples =  $Sample->getSampleListAndOrder()->paginate(100);
        print_r($samples->toArray());
        // dd($samples);
    }

    public function extractions()
    {
        $Extraction = new Extraction;
        $extractions =  $Extraction->getExtraction()->paginate(100);
        print_r($extractions->toArray());
        // dd($samples);
    }

    public function data()
    {
        ini_set('max_execution_time', '0');
        Extraction::where('order_id', '=', 0)->chunk(1000, function ($extractions) {
            foreach ($extractions as $extraction) {
                $sample = Sample::where('sample_id', '=', $extraction->sample_id)->first();
                if (!$sample) {
                    continue;
                }
                $order = Order::where('order_id', '=', $sample->order_id)->first();
                if (!$order) {
                    continue;
                }
                Extraction::where('extraction_id', '=', $extraction->extraction_id)->update(['order_id' => $sample->order_id, 'contract_id' => $order->contract_id]);
            }
        });

        echo 'done';
    }


}
