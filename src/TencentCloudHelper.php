<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 * @license http://www.larva.com.cn/license/
 */

namespace Larva\TencentCloud;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

/**
 * 快速操作助手
 * @author Tongle Xu <xutongle@gmail.com>
 */
class TencentCloudHelper
{
    /**
     * 抽取关键词
     * @param string $title
     * @param null|string $content
     * @return array
     */
    public static function keywordsExtraction($title, $content = null)
    {
        $words = [];
        try {
            $req = new \TencentCloud\Nlp\V20190408\Models\KeywordsExtractionRequest();
            $req->setText($title);
            $req->setNum(5);
            $resp = \Larva\TencentCloud\TencentCloud::nlp()->KeywordsExtraction($req);
            /** @var \TencentCloud\Nlp\V20190408\Models\Keyword $keyword */
            foreach ($resp->getKeywords() as $keyword) {
                if (mb_strlen($keyword->Word) > 1) {
                    $words[] = $keyword->Word;
                }
            }
        } catch (\TencentCloud\Common\Exception\TencentCloudSDKException $e) {
            Log::error($e->getFile() . '[' . $e->getLine() . ']:' . $e->getMessage());
        }
        return $words;
    }

    /**
     * 文本安全检查
     * @param string $content
     * @param string $bizType
     * @return array
     */
    public static function textModeration($content, $bizType = '')
    {
        $request = new \TencentCloud\Cms\V20190321\Models\TextModerationRequest();
        $request->setContent($content);
        if (!empty($bizType)) {
            $request->setBizType($bizType);
        }
        /** @var \TencentCloud\Cms\V20190321\Models\TextModerationResponse $result */
        $result = \Larva\TencentCloud\TencentCloud::cms()->TextModeration($request);
        $keyWords = Arr::get($result, 'Data.Keywords', []);
        if (isset($result['Data']['DetailResult'])) {
            /**
             * filter 筛选腾讯云敏感词类型范围
             * Normal：正常，Polity：涉政，Porn：色情，Illegal：违法，Abuse：谩骂，Terror：暴恐，Ad：广告，Custom：自定义关键词
             */
            $filter = ['Normal', 'Ad']; // Tag Setting 可以放入配置
            $filtered = collect($result['Data']['DetailResult'])->filter(function ($item) use ($filter) {
                if (in_array($item['EvilLabel'], $filter)) {
                    $item = [];
                }
                return $item;
            });
            $detailResult = $filtered->pluck('Keywords');
            $detailResult = Arr::collapse($detailResult);
            $keyWords = array_merge($keyWords, $detailResult);
        }
        return $keyWords;
    }

    /**
     * 图片审核
     * @param string $path
     * @param false $isRemote
     * @return bool
     */
    public static function imageModeration($path, $isRemote = false)
    {
        $request = new \TencentCloud\Cms\V20190321\Models\ImageModerationRequest();
        if ($isRemote) {
            $request->setFileUrl($path);
        } else {
            $request->setFileContent(base64_encode(file_get_contents($path)));
        }
        /** @var \TencentCloud\Cms\V20190321\Models\ImageModerationResponse $result */
        $result = \Larva\TencentCloud\TencentCloud::cms()->ImageModeration($request);
        if (Arr::get($result, 'Data.EvilType') != 100) {
            return false;
        }
        return true;
    }

    /**
     * 腾讯云检验身份证号码和姓名是否真实
     *
     * @param string $identity 身份证号码
     * @param string $realName 姓名
     * @return \TencentCloud\Faceid\V20180301\Models\IdCardVerificationResponse
     */
    public static function idCardVerification($identity, $realName)
    {
        $request = new \TencentCloud\Faceid\V20180301\Models\IdCardVerificationRequest();
        $request->setIdCard($identity);
        $request->setName($realName);
        /** @var \TencentCloud\Faceid\V20180301\Models\IdCardVerificationResponse $result */
        return \Larva\TencentCloud\TencentCloud::faceid()->idCardVerification($request);
    }

    /**
     * 校验姓名和银行卡号的真实性和一致性
     * @param string $bankCard
     * @param string $name
     * @return \TencentCloud\Faceid\V20180301\Models\BankCard2EVerificationResponse
     */
    public static function bankCard2EVerification($bankCard, $name)
    {
        $request = new \TencentCloud\Faceid\V20180301\Models\BankCard2EVerificationRequest();
        $request->setName($name);
        $request->setBankCard($bankCard);
        /** @var \TencentCloud\Faceid\V20180301\Models\BankCard2EVerificationResponse $result */
        return \Larva\TencentCloud\TencentCloud::faceid()->BankCard2EVerification($request);
    }

    /**
     * 发送短信
     * @param array|string $phoneNumber e.164 标准
     * @param string $templateID
     * @param array $templateParams
     * @return array
     */
    public static function sendSms($phoneNumber, $templateID, $templateParams)
    {
        $request = new \TencentCloud\Sms\V20190711\Models\SendSmsRequest();
        $request->setPhoneNumberSet($phoneNumber);
        $request->setTemplateID($templateID);
        $request->setTemplateParamSet($templateParams);
        /** @var \TencentCloud\Sms\V20190711\Models\SendSmsResponse $result */
        $result =  \Larva\TencentCloud\TencentCloud::sms()->SendSms($request);
        return $result->getSendStatusSet();
    }
}
