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
use Larva\TencentCloud\TencentCloud;
use TencentCloud\Cdn\V20180606\CdnClient;
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
        foreach ($this->paths as $key => $path) {
            $path = $this->parseUrl($path);
            $this->paths[$key] = $path;
        }
        $this->type = $type;
    }

    /**
     * 解析Url
     * @param string $url
     * @return mixed|string
     */
    public function parseUrl($url)
    {
        $u = parse_url($url);
        if ($u) {
            $url = $u['host'];
            if (!isset($u['path'])) {
                $u['path'] = '/';
            }
            $url = $url . $u['path'];
            if (isset($u['query'])) {
                $url = $url . $u['query'];
            }
            return $url;
        }
        return $url;
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
        $req->setUrls($this->urls);
        try {
            /** @var CdnClient $client */
            $client = TencentCloud::get('cdn');
            $client->PurgeUrlsCache($req);
        } catch (\Exception $exception) {

        }
    }
}