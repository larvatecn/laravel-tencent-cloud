<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 * @license http://www.larva.com.cn/license/
 */

namespace Larva\TencentCloud;

use Illuminate\Support\ServiceProvider;

/**
 * 腾讯云服务提供者
 *
 * @author Tongle Xu <xutongle@gmail.com>
 */
class TencentCloudServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->setupConfig();

        $this->app->singleton(TencentCloudManage::class, function () {
            return new TencentCloudManage($this->app);
        });
    }

    /**
     * Setup the config.
     */
    protected function setupConfig()
    {
        $source = realpath($raw = __DIR__ . '/../config/tencent.php') ?: $raw;

        if ($this->app->runningInConsole()) {
            $this->publishes([
                $source => config_path('tencent.php'),
            ], 'tencent-config');
        }

        $this->mergeConfigFrom($source, 'tencent');
    }
}