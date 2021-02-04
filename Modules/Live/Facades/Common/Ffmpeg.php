<?php 

namespace Modules\Live\Facades\Common;

use Illuminate\Support\Facades\Facade;

/**
 *
 * @see \Modules\Live\Services\Common\FfmpegService
 */
class Ffmpeg extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Ffmpeg';
    }
}
