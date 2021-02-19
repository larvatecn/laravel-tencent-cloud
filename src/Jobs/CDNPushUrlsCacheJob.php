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
use TencentCloud\Cdn\V20180606\Models\PushUrlsCacheRequest;

/**
 * 预热 URL
 *
 * @author Tongle Xu <xutongle@gmail.com>
 */
class CDNPushUrlsCacheJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    /**
     * @var array
     */
    public $urls;

    /**
     * @var string 内容区域
     */
    public $area;

    /**
     * Create a new job instance.
     *
     * @param string|array $urls
     * @param string $area
     */
    public function __construct($urls, $area = 'mainland')
    {
        if (is_string($urls)) {
            $this->urls = [$urls];
        } else {
            $this->urls = $urls;
        }
        foreach ($this->urls as $key => $url) {
            $url = $this->parseUrl($url);
            $this->urls[$key] = $url;
        }
        $this->area = $area;
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
        $req = new PushUrlsCacheRequest();
        $req->setUrls($this->urls);
        $req->setArea($this->area);
        try {
            /** @var CdnClient $client */
            $client = TencentCloud::get('cdn');
            $client->PushUrlsCache($req);
        } catch (\Exception $exception) {

        }
    }
}