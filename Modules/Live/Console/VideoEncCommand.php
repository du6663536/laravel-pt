<?php

namespace Modules\Live\Console;

use Illuminate\Console\Command;

class VideoEncCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:live-video-enc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '视频切片HLS加密格式m3u8';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        \Modules\Live\Facades\Common\Ffmpeg::cutVideoEncrypt();
    }
}
