<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 * @license http://www.larva.com.cn/license/
 */

namespace Larva\TencentCloud\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Larva\TencentCloud\TencentCloud;
use TencentCloud\Cdn\V20180606\Models\PurgePathCacheRequest;

/**
 * Class CDNPurgePathCacheJob
 *
 * @author Tongle Xu <xutongle@gmail.com>
 */
class CDNPurgePathCacheJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    /**
     * @var array
     */
    public $paths;

    /**
     * @var string
     */
    public $type;

    /**
     * Create a new job instance.
     *
     * @param array|string $paths
     * @param string $type
     */
    public function __construct($paths, $type = 'delete')
    {
        if (is_string($paths)) {
            $this->paths = [$paths];
        } else {
            $this->paths = $paths;
        }
        $this->type = $type;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \Exception
     */
    public function handle()
    {
        $req = new PurgePathCacheRequest();
        $req->setPaths($this->paths);
        try {
            $client = TencentCloud::cdn();
            $client->PurgePathCache($req);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}