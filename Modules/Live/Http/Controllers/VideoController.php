<?php

namespace Modules\Live\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class VideoController extends Controller
{
    /**
     * 获取播放密钥
     *
     * @return void
     */
    public function clef()
    {
        $enc_path = public_path('31f6d416f331de91.key');
        //$enc_path = base_path('31f6d416f331de91.key');
        echo file_get_contents($enc_path);
        exit;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        // \Modules\Live\Facades\Common\Ffmpeg::test();die;
        return view('live::video.index', [
            'm3u8' => 'http://live.lpt.kf/storage/video/hls/raw/696/output.m3u8',
            'subtitle' => '',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('live::create');
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
        return view('live::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('live::edit');
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
