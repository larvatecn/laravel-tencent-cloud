<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 * @license http://www.larva.com.cn/license/
 */

namespace Larva\TencentCloud;

use Exception;
use Illuminate\Support\Facades\Http;

/**
 * API 网关
 * @author Tongle Xu <xutongle@gmail.com>
 */
class ApiGateway
{
    const SIGNATURE_METHOD_HMAC_SHA1 = 'hmac-sha1';
    const SIGNATURE_METHOD_HMAC_SHA256 = 'hmac-sha256';

    /**
     * @var string
     */
    protected $signatureMethod = self::SIGNATURE_METHOD_HMAC_SHA1;

    /**
     * @var string
     */
    protected $dateTimeFormat = 'D, d M Y H:i:s \G\M\T';

    /**
     * @var string
     */
    public $baseUrl;

    /**
     * @var string
     */
    private $secretId;

    /**
     * @var string
     */
    private $secretKey;

    /**
     * ApiGateway constructor.
     * @param string $baseUrl
     * @param string|null $secretId
     * @param string|null $secretKey
     */
    public function __construct($baseUrl, $secretId, $secretKey)
    {
        $this->baseUrl = $baseUrl;
        $this->secretId = $secretId;
        $this->secretKey = $secretKey;
    }

    /**
     * GET请求
     * @param string $url
     * @param null $query
     * @return \Illuminate\Http\Client\Response
     * @throws Exception
     */
    public function get(string $url, $query = null)
    {
        return Http::baseUrl($this->baseUrl)->withHeaders($this->getSignatureHeaders())->get($url, $query);
    }

    /**
     * POST 请求
     * @param string $url
     * @param array $data
     * @return \Illuminate\Http\Client\Response
     * @throws Exception
     */
    public function post(string $url, array $data = [])
    {
        return Http::baseUrl($this->baseUrl)->withHeaders($this->getSignatureHeaders())->post($url, $data);
    }

    /**
     * 获取签名头
     * @return array
     */
    public function getSignatureHeaders(): array
    {
        $headers = [];
        $headers['Date'] = gmdate($this->dateTimeFormat);
        $headers['Nonce'] = uniqid();
        $signString = "date: " . $headers['Date'] . "\n" . "nonce: " . $headers['Nonce'];
        if ($this->signatureMethod == self::SIGNATURE_METHOD_HMAC_SHA256) {
            $sign = base64_encode(hash_hmac('sha256', $signString, $this->secretKey, true));
        } else {
            $sign = base64_encode(hash_hmac('sha1', $signString, $this->secretKey, true));
        }
        $headers['Authorization'] = "hmac id=\"{$this->secretId}\", algorithm=\"{$this->signatureMethod}\", headers=\"date nonce\", signature=\"{$sign}\"";
        return $headers;
    }
}
