@extends('live::layouts.master')

@section('content')
    <div id="dplayer" style="width:100%;height:100%"></div>
@endsection

@section('scriptsAfterJs')
    <script type="text/javascript" src="{{asset('/js/live/hls.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/js/live/DPlayer.min.js')}}"></script>
    <script type="text/javascript">
        //视频播放器
        DP = new DPlayer({
            container: document.getElementById('dplayer'),
            screenshot: false,
            theme: '#727cf5',                            
            volume: 0.7,
            hotkey: true,
            video: {
                url: '{{$m3u8}}',   
                type: 'hls',                             
            },
            
            subtitle: {
                url: "{{$subtitle}}",
                type: 'webvtt',
                fontSize: '24px',
                bottom: '10%',
                color: '#fff',
            },
        });
        // DP.seek(0);
        DP.play();
        DP.on('play', function () {
            console.log('play')
        });
        DP.on('ended', function () {
            console.log('ended')
        });
    </script>
@endsection