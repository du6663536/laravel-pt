<?php

namespace Modules\Member\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $user  = DB::table('common_member')->where(['member_id' => 2])->first();
        print_r($user);die;
        return view('member::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('member::create');
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
        // 第一个参数就是一个原生的 SQL 查询，而第二个参数则是需要绑定到查询中的参数值。通常，这些值用于约束 where 语句。参数绑定用于防止 SQL 注入。
        $users = DB::select('SELECT * FROM `common_member` WHERE member_id = :member_id LIMIT 0, 1000', ['member_id' => 1]);
        print_r($users);die;

        //取出一条数据
        //$user  = DB::table('common_member')->where(['member_id' => 2])->dd();//打印sql
        $user  = DB::table('common_member')->where(['member_id' => 2])->first();
        print_r($user);die;

        //分块
        DB::table('common_member')->orderBy('member_id')->chunk(100, function ($users) {
            echo count($users);
            foreach ($users as $user) {
                
            }
        });
        die;
        return view('member::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('member::edit');
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
