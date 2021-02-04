<?php

namespace Modules\Live\Services\Common;

use Illuminate\Support\Facades\Storage;
use mikehaertl\shellcommand\Command;

class FfmpegService 
{
    CONST PRE_DIR = '';
    CONST WATER = 'video/raw_water';//水印
    CONST HlS = 'video/hls';//m3u8
    CONST THUMB = 'video/thumb';//缩略图

    private static $video_size = ['sd', 'raw'];

    public function test()
    {
        echo 'hhhhhhhhhhh';die;
    }

    /**
     * 创建不存在的文件夹
     *
     * @return string
     */
    public function makeDirNotExist($dir)
    {
        if (!is_dir($dir)) {
            $dir = str_replace(storage_path('app/public') . '/', '', $dir);
            Storage::disk('public')->makeDirectory($dir);
        }
    }

    /**
     * 视频切片HLS格式m3u8
     *
     * @return array
     */
    public function cutVideoEncrypt()
    {   
        $pre_dir = storage_path('app/public');
        $water_image = public_path('img/live/video/water.png');
        $video_size = self::$video_size;//要转码的码率

        // //检查视频raw文件是否存在
        $raw_video_path = $pre_dir.'/video/raw/696.mp4';
        if (!is_file($raw_video_path)) {
            dd('文件不存在');
        }
        $video_id = 696;
        $format = 'mp4';

        if(is_array($video_size)){
            $cut_is_over = 0;
            foreach($video_size as $sizeKey => $sizeValue){                
                $water_video_dir = $pre_dir . '/' . self::WATER . '/' . $sizeValue;
                $water_video_path = $water_video_dir . '/' . $video_id . '.' . $format;
                $this->makeDirNotExist($water_video_dir);

                //压缩和打水印
                if($sizeValue == 'raw'){
                    $water_shell = '/usr/bin/ffmpeg -threads 3 -i ' . $raw_video_path . ' -c:v libx264 -preset veryfast -crf 28 -c:a copy -vf "movie=' . $water_image . ' [watermark]; [in][watermark] overlay=40:00 [out] " ' . $water_video_path;
                }else{
                    $water_shell = '/usr/bin/ffmpeg -threads 3 -i ' . $raw_video_path . ' -c:v libx264 -preset veryfast -crf 28 -c:a copy -vf "[in] scale=-2:720 [top] ;movie=' . $water_image . ' [watermark]; [top][watermark] overlay=40:00 [out] " ' . $water_video_path;
                }
                //Log::info('水印：' . $water_shell);
                $command = new Command($water_shell);
                $command->execute();

                //日志
                $res_log = '系统在 ' . date('Y-m-d H:i:s') . ' 尝试对视频 -' . $video_id . '- ' . $sizeValue . ' - 进行添加水印' . PHP_EOL;
                Storage::disk('public')->put(self::HlS . '/' . $sizeValue . '/' . $video_id . '/cut_' . $video_id . '.log', $res_log);
                
                $hls_m3u8_dir = $pre_dir . '/' . self::HlS . '/' . $sizeValue . '/' . $video_id;
                $hls_m3u8_dir_path = $hls_m3u8_dir . '/output.m3u8';
                $this->makeDirNotExist($hls_m3u8_dir);

                //切片开始
                $shell = '/usr/bin/ffmpeg -i ' . $water_video_path . ' -c:v copy -c:a copy -hls_time 3 -hls_list_size 0 -hls_key_info_file '.public_path('31f6d416f331de91.keyinfo').' -hls_segment_filename "' . $hls_m3u8_dir . '/output%d.ts" ' . $hls_m3u8_dir_path;
                $command = new Command($shell);
                $command->execute();

                //日志
                $res_log = '系统在 ' . date('Y-m-d H:i:s') . ' 尝试对视频 -' . $video_id . '- ' . $sizeValue . ' - 进行切片' . PHP_EOL;
                Storage::disk('public')->put(self::HlS . '/' . $sizeValue . '/' . $video_id . '/cut_' . $video_id . '.log', $res_log);

                //检查切片目录下是否有切好的片段，如果没有则错误                
                $files = Storage::disk('public')->files(self::HlS . '/' . $sizeValue . '/' . $video_id);
                if (empty($files)) {
                    dd('切片目录下, 没有切好的片段');
                }                
                foreach ($files as $file) {
                    if (strpos($file, 'ts') !== false) {
                        $cut_is_over++;
                        break;
                    }
                }
            }
        }

        if($cut_is_over > 0 && $cut_is_over == COUNT($video_size) ){
            //生成缩略图
            $thumb_dir = $pre_dir . '/' . self::THUMB . '/' . $video_id;
            $thumb_dir_path = $thumb_dir . '/output_%3d.jpg';
            $this->makeDirNotExist($thumb_dir);
            $thumb_shell = '/usr/bin/ffmpeg -y -i ' . $water_video_path . ' -r 0.5 -ss 00:00:02 -t 180 -q:v 3 -vframes 90 ' . $thumb_dir_path;
            $command = new Command($thumb_shell);
            $command->execute();
        }else{
            dd('失败');
        }        
    }

}