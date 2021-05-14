<?php

namespace Modules\Frame\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Frame\Services\Container;
use Modules\Frame\Services\Superman;
use Modules\Frame\Interfaces\Container\XPower;
use Modules\Frame\Interfaces\Container\UltraBomb;

class ContainerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        // 创建一个容器（后面称作超级工厂）
        $container = new Container;

        // 向该 超级工厂 添加 超人 的生产脚本
        $container->bind('superman', function($container, $moduleName) {
            return new Superman($container->make($moduleName));
        });

        // 向该 超级工厂 添加 超能力模组 的生产脚本
        $container->bind('xpower', function($container) {
            return new XPower;
        });

        // 同上  aaa
        $container->bind('ultrabomb', function($container) {
            return new UltraBomb;
        });

// dd($container);

        // ******************  华丽丽的分割线  **********************
        // 开始启动生产
        $superman_1 = $container->make('superman', ['xpower']);
// var_dump($superman_1->module->activate([]));
var_dump($superman_1->getModule()->activate([]));

dd($container);die;
        $superman_2 = $container->make('superman', ['ultrabomb']);
        $superman_3 = $container->make('superman', ['xpower']);
        // ...随意添加


        die;
        return view('frame::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('frame::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('frame::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('frame::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
