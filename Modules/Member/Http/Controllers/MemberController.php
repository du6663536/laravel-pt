<?php

namespace Modules\Member\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Member\Models\CommonDepartment;
use Modules\Member\Models\CommonMember;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        // $departments = (new CommonDepartment)->getMemberlist();
        // $departments = (new CommonDepartment)->getMemberlistWithDepartment();
        $members = (new CommonMember)->getMemberAndDepartment();


        //调用的 Illuminate\Database\Eloquent\Model 中的 all,  而model中的all  调用了Illuminate\Database\Eloquent\Builder(模型构造器？) 中的get， 返回 \Illuminate\Database\Eloquent\Collection|static[](返回集合?）
        // $users = CommonMember::all();
        //find调用的是 Illuminate\Database\Eloquent\Collection(集合操作类？) 返回\Illuminate\Database\Eloquent\Model|static|null（返回的模型？）
        //toArray调用的是 Illuminate\Database\Eloquent\Model 中的 toArray 返回的是数组（attributesToArray+relationsToArray?）
        // $users = $users->find(1)->toArray();
        // dd($users);

        // all 会取出所有数据   加条件要用get
        // take通过一系列的魔术方法（比如 __callStatic __call ）， 最终调用 Illuminate\Database\Query\Builder  的take 【说明了，模型 可以调用 Database的查询构造器】
        // $users = CommonMember::take(10)->get();
        // dd($users);

        // $users = CommonMember::where(['member_id' => 2])
        // ->first()->toArray();
        // print_r($users);die;

        // $users = CommonMember::where('pid', 0)
        // ->orderBy('member_id', 'desc')
        // ->take(10)
        // ->get()
        // ->toArray();
        // print_r($users);exit;

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
        $user = DB::table('common_member')->where(['member_id' => 2])->first(); //Illuminate\Database\Query\Builder  (DB方式是用的查询构造器？)  Illuminate\Database\Eloquent\Builder(模型使用的构造器？)
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
