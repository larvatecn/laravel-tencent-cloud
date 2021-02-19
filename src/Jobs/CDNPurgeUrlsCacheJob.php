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
use TencentCloud\Cdn\V20180606\Models\PurgeUrlsCacheRequest;

/**
 * 批量提交 URL 进行刷新
 *
 * @author Tongle Xu <xutongle@gmail.com>
 */
class CDNPurgeUrlsCacheJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    /**
     * @var array
     */
    public $urls;

    /**
     * Create a new job instance.
     *
     * @param string|array $urls
     */
    public function __construct($urls)
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
        $req = new PurgeUrlsCacheRequest();
        $req->setUrls($this->urls);
        try {
            /** @var CdnClient $client */
            $client = TencentCloud::get('cdn');
            $client->PurgeUrlsCache($req);
        } catch (\Exception $exception) {

        }
    }
}