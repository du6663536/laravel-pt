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
