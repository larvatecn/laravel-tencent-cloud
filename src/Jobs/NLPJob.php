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
use Illuminate\Queue\SerializesModels;
use Larva\TencentCloud\Jobs\Middleware\NLPRateLimited;

/**
 * 自然语言处理
 * @author Tongle Xu <xutongle@gmail.com>
 */
abstract class NLPJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * 任务可以尝试的最大次数。
     *
     * @var int
     */
    public $tries = 3;

    /**
     * 任务可以执行的最大秒数 (超时时间)。
     *
     * @var int
     */
    public $timeout = 60;

    /**
     * 如果任务的模型不再存在，则删除该任务
     *
     * @var bool
     */
    public $deleteWhenMissingModels = true;

    /**
     * 计算在重试任务之前需等待的秒数
     *
     * @return array
     */
    public function backoff()
    {
        return [3, 5, 15];
    }

    /**
     * 获取一个可以被传递通过的中间件任务
     *
     * @return array
     */
    public function middleware()
    {
        return [new NLPRateLimited];
    }
}
