<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 * @license http://www.larva.com.cn/license/
 */

namespace Larva\TencentCloud;

use Illuminate\Support\Manager;
use InvalidArgumentException;
use JetBrains\PhpStorm\Pure;
use TencentCloud\Common\Credential;

/**
 * 腾讯云
 *
 * @author Tongle Xu <xutongle@gmail.com>
 */
class TencentCloudManage extends Manager
{
    /**
     * Get the tencent cloud service configuration.
     *
     * @param string $name
     * @return array
     */
    protected function getConfig($name)
    {
        $config = $this->config["tencent.drivers.{$name}"] ?: [];
        if (!isset($config['secret_id']) || empty ($config['secret_id'])) {
            $config['secret_id'] = $this->config["tencent.secret_id"];
        }
        if (!isset($config['secret_key']) || empty ($config['secret_key'])) {
            $config['secret_key'] = $this->config["tencent.secret_key"];
        }
        if (!isset($config['region']) || empty($config['region'])) {
            $config['region'] = $this->config["tencent.region"];
        }
        return $config;
    }

    /**
     * 获取凭证
     * @param array $config
     * @return Credential
     */
    protected function getCredential(array $config): Credential
    {
        return new Credential($config['secret_id'], $config['secret_key']);
    }

    /**
     * Get a driver instance.
     *
     * @param string $driver
     * @return mixed
     */
    public function with(string $driver)
    {
        return $this->driver($driver);
    }

    /**
     * Get the default driver name.
     *
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    public function getDefaultDriver()
    {
        throw new InvalidArgumentException('No driver was specified.');
    }

    /**
     * API 网关客户端服务
     * @return ApiGateway
     */
    public function createApiDriver(): ApiGateway
    {
        $config = $this->getConfig('api');
        return new ApiGateway($config['base_url'], $config['secret_id'], $config['secret_key']);
    }

    /**
     * API网关管理
     * @return \TencentCloud\Apigateway\V20180808\ApigatewayClient
     */
    public function createApigatewayDriver()
    {
        $config = $this->getConfig('api_gateway');
        return new \TencentCloud\Apigateway\V20180808\ApigatewayClient($this->getCredential($config), $config['region']);
    }

    /**
     * yunsou 服务
     * @return \TencentCloud\Yunsou\V20191115\YunsouClient
     */
    public function createYunsouDriver()
    {
        $config = $this->getConfig('yunsou');
        return new \TencentCloud\Yunsou\V20191115\YunsouClient($this->getCredential($config), $config['region']);
    }

    /**
     * Yunjing 服务
     * @return \TencentCloud\Yunjing\V20180228\YunjingClient
     */
    public function createYunjingDriver()
    {
        $config = $this->getConfig('yunjing');
        return new \TencentCloud\Yunjing\V20180228\YunjingClient($this->getCredential($config), $config['region']);
    }

    /**
     * Youmall 服务
     * @return \TencentCloud\Youmall\V20180228\YoumallClient
     */
    public function createYoumallDriver()
    {
        $config = $this->getConfig('youmall');
        return new \TencentCloud\Youmall\V20180228\YoumallClient($this->getCredential($config), $config['region']);
    }

    /**
     * Wss 服务
     * @return \TencentCloud\Wss\V20180426\WssClient
     */
    public function createWssDriver()
    {
        $config = $this->getConfig('wss');
        return new \TencentCloud\Wss\V20180426\WssClient($this->getCredential($config), $config['region']);
    }

    /**
     * Vpc 服务
     * @return \TencentCloud\Vpc\V20170312\VpcClient
     */
    public function createVpcDriver()
    {
        $config = $this->getConfig('vpc');
        return new \TencentCloud\Vpc\V20170312\VpcClient($this->getCredential($config), $config['region']);
    }

    /**
     * 点播 服务
     * @return \TencentCloud\Vod\V20180717\VodClient
     */
    public function createVodDriver()
    {
        $config = $this->getConfig('vod');
        return new \TencentCloud\Vod\V20180717\VodClient($this->getCredential($config), $config['region']);
    }

    /**
     * Tts 服务
     * @return \TencentCloud\Tts\V20190823\TtsClient
     */
    public function createTtsDriver()
    {
        $config = $this->getConfig('tts');
        return new \TencentCloud\Tts\V20190823\TtsClient($this->getCredential($config), $config['region']);
    }

    /**
     * Tsf 服务
     * @return \TencentCloud\Tsf\V20180326\TsfClient
     */
    public function createTsfDriver()
    {
        $config = $this->getConfig('tsf');
        return new \TencentCloud\Tsf\V20180326\TsfClient($this->getCredential($config), $config['region']);
    }

    /**
     * Trtc 服务
     * @return \TencentCloud\Trtc\V20190722\TrtcClient
     */
    public function createTrtcDriver()
    {
        $config = $this->getConfig('trtc');
        return new \TencentCloud\Trtc\V20190722\TrtcClient($this->getCredential($config), $config['region']);
    }

    /**
     * Tmt 服务
     * @return \TencentCloud\Tmt\V20180321\TmtClient
     */
    public function createTmtDriver()
    {
        $config = $this->getConfig('tmt');
        return new \TencentCloud\Tmt\V20180321\TmtClient($this->getCredential($config), $config['region']);
    }

    /**
     * Tkgdq 服务
     * @return \TencentCloud\Tkgdq\V20190411\TkgdqClient
     */
    public function createTkgdqDriver()
    {
        $config = $this->getConfig('tkgdq');
        return new \TencentCloud\Tkgdq\V20190411\TkgdqClient($this->getCredential($config), $config['region']);
    }

    /**
     * Tke 服务
     * @return \TencentCloud\Tke\V20180525\TkeClient
     */
    public function createTkeDriver()
    {
        $config = $this->getConfig('tke');
        return new \TencentCloud\Tke\V20180525\TkeClient($this->getCredential($config), $config['region']);
    }

    /**
     * Tiw 服务
     * @return \TencentCloud\Tiw\V20190919\TiwClient
     */
    public function createTiwDriver()
    {
        $config = $this->getConfig('wiw');
        return new \TencentCloud\Tiw\V20190919\TiwClient($this->getCredential($config), $config['region']);
    }

    /**
     * Tione 服务
     * @return \TencentCloud\Tione\V20191022\TioneClient
     */
    public function createTioneDriver()
    {
        $config = $this->getConfig('tione');
        return new \TencentCloud\Tione\V20191022\TioneClient($this->getCredential($config), $config['region']);
    }

    /**
     * Tiia 服务
     * @return \TencentCloud\Tiia\V20190529\TiiaClient
     */
    public function createTiiaDriver()
    {
        $config = $this->getConfig('tiia');
        return new \TencentCloud\Tiia\V20190529\TiiaClient($this->getCredential($config), $config['region']);
    }

    /**
     * Tiems 服务
     * @return \TencentCloud\Tiems\V20190416\TiemsClient
     */
    public function createTiemsDriver()
    {
        $config = $this->getConfig('tiems');
        return new \TencentCloud\Tiems\V20190416\TiemsClient($this->getCredential($config), $config['region']);
    }

    /**
     * Tics 服务
     * @return \TencentCloud\Tics\V20181115\TicsClient
     */
    public function createTicsDriver()
    {
        $config = $this->getConfig('tics');
        return new \TencentCloud\Tics\V20181115\TicsClient($this->getCredential($config), $config['region']);
    }

    /**
     * Ticm 服务
     * @return \TencentCloud\Ticm\V20181127\TicmClient
     */
    public function createTicmDriver()
    {
        $config = $this->getConfig('ticm');
        return new \TencentCloud\Ticm\V20181127\TicmClient($this->getCredential($config), $config['region']);
    }

    /**
     * Tia 服务
     * @return \TencentCloud\Tia\V20180226\TiaClient
     */
    public function createTiaDriver()
    {
        $config = $this->getConfig('tia');
        return new \TencentCloud\Tia\V20180226\TiaClient($this->getCredential($config), $config['region']);
    }

    /**
     * Tcr 服务
     * @return \TencentCloud\Tcr\V20190924\TcrClient
     */
    public function createTcrDriver()
    {
        $config = $this->getConfig('tcr');
        return new \TencentCloud\Tcr\V20190924\TcrClient($this->getCredential($config), $config['region']);
    }

    /**
     * Tci 服务
     * @return \TencentCloud\Tci\V20190318\TciClient
     */
    public function createTciDriver()
    {
        $config = $this->getConfig('tci');
        return new \TencentCloud\Tci\V20190318\TciClient($this->getCredential($config), $config['region']);
    }

    /**
     * Tcb 服务
     * @return \TencentCloud\Tcb\V20180608\TcbClient
     */
    public function createTcbDriver()
    {
        $config = $this->getConfig('tcb');
        return new \TencentCloud\Tcb\V20180608\TcbClient($this->getCredential($config), $config['region']);
    }

    /**
     * Tcaplusdb 服务
     * @return \TencentCloud\Tcaplusdb\V20190823\TcaplusdbClient
     */
    public function createTcaplusdbDriver()
    {
        $config = $this->getConfig('tcaplusdb');
        return new \TencentCloud\Tcaplusdb\V20190823\TcaplusdbClient($this->getCredential($config), $config['region']);
    }

    /**
     * Tbp 服务
     * @return \TencentCloud\Tbp\V20190627\TbpClient
     */
    public function createTbpDriver()
    {
        $config = $this->getConfig('tbp');
        return new \TencentCloud\Tbp\V20190627\TbpClient($this->getCredential($config), $config['region']);
    }

    /**
     * Tbm 服务
     * @return \TencentCloud\Tbm\V20180129\TbmClient
     */
    public function createTbmDriver()
    {
        $config = $this->getConfig('tbm');
        return new \TencentCloud\Tbm\V20180129\TbmClient($this->getCredential($config), $config['region']);
    }

    /**
     * Tbaas 服务
     * @return \TencentCloud\Tbaas\V20180416\TbaasClient
     */
    public function createTbaasDriver()
    {
        $config = $this->getConfig('tbaas');
        return new \TencentCloud\Tbaas\V20180416\TbaasClient($this->getCredential($config), $config['region']);
    }

    /**
     * Tav 服务
     * @return \TencentCloud\Tav\V20190118\TavClient
     */
    public function createTavDriver()
    {
        $config = $this->getConfig('tav');
        return new \TencentCloud\Tav\V20190118\TavClient($this->getCredential($config), $config['region']);
    }

    /**
     * tag 服务
     * @return \TencentCloud\Tag\V20180813\TagClient
     */
    public function createTagDriver()
    {
        $config = $this->getConfig('tag');
        return new \TencentCloud\Tag\V20180813\TagClient($this->getCredential($config), $config['region']);
    }

    /**
     * Sts 服务
     * @return \TencentCloud\Sts\V20180813\StsClient
     */
    public function createStsDriver()
    {
        $config = $this->getConfig('sts');
        return new \TencentCloud\Sts\V20180813\StsClient($this->getCredential($config), $config['region']);
    }

    /**
     * Ssm 服务
     * @return \TencentCloud\Ssm\V20190923\SsmClient
     */
    public function createSsmDriver()
    {
        $config = $this->getConfig('ssm');
        return new \TencentCloud\Ssm\V20190923\SsmClient($this->getCredential($config), $config['region']);
    }

    /**
     * Ssl 服务
     * @return \TencentCloud\Ssl\V20191205\SslClient
     */
    public function createSslDriver()
    {
        $config = $this->getConfig('ssl');
        return new \TencentCloud\Ssl\V20191205\SslClient($this->getCredential($config), $config['region']);
    }

    /**
     * Sqlserver 服务
     * @return \TencentCloud\Sqlserver\V20180328\SqlserverClient
     */
    public function createSqlserverDriver()
    {
        $config = $this->getConfig('sqlserver');
        return new \TencentCloud\Sqlserver\V20180328\SqlserverClient($this->getCredential($config), $config['region']);
    }

    /**
     * Solar 服务
     * @return \TencentCloud\Solar\V20181011\SolarClient
     */
    public function createSolarDriver()
    {
        $config = $this->getConfig('solar');
        return new \TencentCloud\Solar\V20181011\SolarClient($this->getCredential($config), $config['region']);
    }

    /**
     * Soe 服务
     * @return \TencentCloud\Soe\V20180724\SoeClient
     */
    public function createSoeDriver()
    {
        $config = $this->getConfig('soe');
        return new \TencentCloud\Soe\V20180724\SoeClient($this->getCredential($config), $config['region']);
    }

    /**
     * Sms 服务
     * @return \TencentCloud\Sms\V20190711\SmsClient
     */
    public function createSmsDriver()
    {
        $config = $this->getConfig('sms');
        return new \TencentCloud\Sms\V20190711\SmsClient($this->getCredential($config), $config['region']);
    }

    /**
     * Smpn 服务
     * @return \TencentCloud\Smpn\V20190822\SmpnClient
     */
    public function createSmpnDriver()
    {
        $config = $this->getConfig('smpn');
        return new \TencentCloud\Smpn\V20190822\SmpnClient($this->getCredential($config), $config['region']);
    }

    /**
     * Scf 服务
     * @return \TencentCloud\Scf\V20180416\ScfClient
     */
    public function createScfDriver()
    {
        $config = $this->getConfig('scf');
        return new \TencentCloud\Scf\V20180416\ScfClient($this->getCredential($config), $config['region']);
    }

    /**
     * redis 服务
     * @return \TencentCloud\Redis\V20180412\RedisClient
     */
    public function createRedisDriver()
    {
        $config = $this->getConfig('redis');
        return new \TencentCloud\Redis\V20180412\RedisClient($this->getCredential($config), $config['region']);
    }

    /**
     * Postgres 服务
     * @return \TencentCloud\Postgres\V20170312\PostgresClient
     */
    public function createPostgresDriver()
    {
        $config = $this->getConfig('postgres');
        return new \TencentCloud\Postgres\V20170312\PostgresClient($this->getCredential($config), $config['region']);
    }

    /**
     * Partners 服务
     * @return \TencentCloud\Partners\V20180321\PartnersClient
     */
    public function createPartnersDriver()
    {
        $config = $this->getConfig('partners');
        return new \TencentCloud\Partners\V20180321\PartnersClient($this->getCredential($config), $config['region']);
    }

    /**
     * Organization 服务
     * @return \TencentCloud\Organization\V20181225\OrganizationClient
     */
    public function createOrganizationDriver()
    {
        $config = $this->getConfig('organization');
        return new \TencentCloud\Organization\V20181225\OrganizationClient($this->getCredential($config), $config['region']);
    }

    /**
     * 创建 OCR 服务
     * @return \TencentCloud\Ocr\V20181119\OcrClient
     */
    public function createOcrDriver()
    {
        $config = $this->getConfig('ocr');
        return new \TencentCloud\Ocr\V20181119\OcrClient($this->getCredential($config), $config['region']);
    }

    /**
     * Npp 服务
     * @return \TencentCloud\Npp\V20190823\NppClient
     */
    public function createNppDriver()
    {
        $config = $this->getConfig('npp');
        return new \TencentCloud\Npp\V20190823\NppClient($this->getCredential($config), $config['region']);
    }

    /**
     * Nlp 服务
     * @return \TencentCloud\Nlp\V20190408\NlpClient
     */
    public function createNlpDriver()
    {
        $config = $this->getConfig('nlp');
        return new \TencentCloud\Nlp\V20190408\NlpClient($this->getCredential($config), $config['region']);
    }

    /**
     * Mvj 服务
     * @return \TencentCloud\Mvj\V20190926\MvjClient
     */
    public function createMvjDriver()
    {
        $config = $this->getConfig('mvj');
        return new \TencentCloud\Mvj\V20190926\MvjClient($this->getCredential($config), $config['region']);
    }

    /**
     * Msp 服务
     * @return \TencentCloud\Msp\V20180319\MspClient
     */
    public function createMspDriver()
    {
        $config = $this->getConfig('msp');
        return new \TencentCloud\Msp\V20180319\MspClient($this->getCredential($config), $config['region']);
    }

    /**
     * Ms 服务
     * @return \TencentCloud\Ms\V20180408\MsClient
     */
    public function createMsDriver()
    {
        $config = $this->getConfig('ms');
        return new \TencentCloud\Ms\V20180408\MsClient($this->getCredential($config), $config['region']);
    }

    /**
     * Mps 服务
     * @return \TencentCloud\Mps\V20190612\MpsClient
     */
    public function createMpsDriver()
    {
        $config = $this->getConfig('mps');
        return new \TencentCloud\Mps\V20190612\MpsClient($this->getCredential($config), $config['region']);
    }

    /**
     * monitor 服务
     * @return \TencentCloud\Monitor\V20180724\MonitorClient
     */
    public function createMonitorDriver()
    {
        $config = $this->getConfig('monitor');
        return new \TencentCloud\Monitor\V20180724\MonitorClient($this->getCredential($config), $config['region']);
    }

    /**
     * mongodb 服务
     * @return \TencentCloud\Mongodb\V20190725\MongodbClient
     */
    public function createMongodbDriver()
    {
        $config = $this->getConfig('mongodb');
        return new \TencentCloud\Mongodb\V20190725\MongodbClient($this->getCredential($config), $config['region']);
    }

    /**
     * Memcached 服务
     * @return \TencentCloud\Memcached\V20190318\MemcachedClient
     */
    public function createMemcachedDriver()
    {
        $config = $this->getConfig('memcached');
        return new \TencentCloud\Memcached\V20190318\MemcachedClient($this->getCredential($config), $config['region']);
    }

    /**
     * Mariadb 服务
     * @return \TencentCloud\Mariadb\V20170312\MariadbClient
     */
    public function createMariadbDriver()
    {
        $config = $this->getConfig('mariadb');
        return new \TencentCloud\Mariadb\V20170312\MariadbClient($this->getCredential($config), $config['region']);
    }

    /**
     * live 服务
     * @return \TencentCloud\Live\V20180801\LiveClient
     */
    public function createLiveDriver()
    {
        $config = $this->getConfig('live');
        return new \TencentCloud\Live\V20180801\LiveClient($this->getCredential($config), $config['region']);
    }

    /**
     * kms 服务
     * @return \TencentCloud\Kms\V20190118\KmsClient
     */
    public function createKmsDriver()
    {
        $config = $this->getConfig('kms');
        return new \TencentCloud\Kms\V20190118\KmsClient($this->getCredential($config), $config['region']);
    }

    /**
     * iotvideo 服务
     * @return \TencentCloud\Iotvideo\V20191126\IotvideoClient
     */
    public function createIotvideoDriver()
    {
        $config = $this->getConfig('iotvideo');
        return new \TencentCloud\Iotvideo\V20191126\IotvideoClient($this->getCredential($config), $config['region']);
    }

    /**
     * iottid 服务
     * @return \TencentCloud\Iottid\V20190411\IottidClient
     */
    public function createIottidDriver()
    {
        $config = $this->getConfig('iottid');
        return new \TencentCloud\Iottid\V20190411\IottidClient($this->getCredential($config), $config['region']);
    }

    /**
     * 创建 iotexplorer 服务
     * @return \TencentCloud\Iotexplorer\V20190423\IotexplorerClient
     */
    public function createIotexplorerDriver()
    {
        $config = $this->getConfig('iotexplorer');
        return new \TencentCloud\Iotexplorer\V20190423\IotexplorerClient($this->getCredential($config), $config['region']);
    }

    /**
     * 创建 iotcloud 服务
     * @return \TencentCloud\Iotcloud\V20180614\IotcloudClient
     */
    public function createIotcloudDriver()
    {
        $config = $this->getConfig('iotcloud');
        return new \TencentCloud\Iotcloud\V20180614\IotcloudClient($this->getCredential($config), $config['region']);
    }

    /**
     * 创建 Iot 服务
     * @return \TencentCloud\Iot\V20180123\IotClient
     */
    public function createIotDriver()
    {
        $config = $this->getConfig('iot');
        return new \TencentCloud\Iot\V20180123\IotClient($this->getCredential($config), $config['region']);
    }

    /**
     * 创建 Ie 服务
     * @return \TencentCloud\Ie\V20200304\IeClient
     */
    public function createIeDriver()
    {
        $config = $this->getConfig('ie');
        return new \TencentCloud\Ie\V20200304\IeClient($this->getCredential($config), $config['region']);
    }

    /**
     * 创建 IC 服务
     * @return \TencentCloud\Ic\V20190307\IcClient
     */
    public function createIcDriver()
    {
        $config = $this->getConfig('ic');
        return new \TencentCloud\Ic\V20190307\IcClient($this->getCredential($config), $config['region']);
    }

    /**
     * 创建 iai 服务
     * @return \TencentCloud\Iai\V20180301\IaiClient
     */
    public function createIaiDriver()
    {
        $config = $this->getConfig('iai');
        return new \TencentCloud\Iai\V20180301\IaiClient($this->getCredential($config), $config['region']);
    }

    /**
     * 创建 hcm 服务
     * @return \TencentCloud\Hcm\V20181106\HcmClient
     */
    public function createHcmDriver()
    {
        $config = $this->getConfig('hcm');
        return new \TencentCloud\Hcm\V20181106\HcmClient($this->getCredential($config), $config['region']);
    }

    /**
     * 创建 habo 服务
     * @return \TencentCloud\Habo\V20181203\HaboClient
     */
    public function createHaboDriver()
    {
        $config = $this->getConfig('habo');
        return new \TencentCloud\Habo\V20181203\HaboClient($this->getCredential($config), $config['region']);
    }

    /**
     * Gse 服务
     * @return \TencentCloud\Gse\V20191112\GseClient
     */
    public function createGseDriver()
    {
        $config = $this->getConfig('gse');
        return new \TencentCloud\Gse\V20191112\GseClient($this->getCredential($config), $config['region']);
    }

    /**
     * Gs 服务
     * @return \TencentCloud\Gs\V20191118\GsClient
     */
    public function createGsDriver()
    {
        $config = $this->getConfig('gs');
        return new \TencentCloud\Gs\V20191118\GsClient($this->getCredential($config), $config['region']);
    }

    /**
     * Gme 服务
     * @return \TencentCloud\Gme\V20180711\GmeClient
     */
    public function createGmeDriver()
    {
        $config = $this->getConfig('gme');
        return new \TencentCloud\Gme\V20180711\GmeClient($this->getCredential($config), $config['region']);
    }

    /**
     * Gaap 服务
     * @return \TencentCloud\Gaap\V20180529\GaapClient
     */
    public function createGaapDriver()
    {
        $config = $this->getConfig('gaap');
        return new \TencentCloud\Gaap\V20180529\GaapClient($this->getCredential($config), $config['region']);
    }

    /**
     * ft 服务
     * @return \TencentCloud\Ft\V20200304\FtClient
     */
    public function createFtDriver()
    {
        $config = $this->getConfig('ft');
        return new \TencentCloud\Ft\V20200304\FtClient($this->getCredential($config), $config['region']);
    }

    /**
     * fmu 服务
     * @return \TencentCloud\Fmu\V20191213\FmuClient
     */
    public function createFmuDriver()
    {
        $config = $this->getConfig('fmu');
        return new \TencentCloud\Fmu\V20191213\FmuClient($this->getCredential($config), $config['region']);
    }

    /**
     * faceid 服务
     * @return \TencentCloud\Faceid\V20180301\FaceidClient
     */
    public function createFaceidDriver()
    {
        $config = $this->getConfig('faceid');
        return new \TencentCloud\Faceid\V20180301\FaceidClient($this->getCredential($config), $config['region']);
    }

    /**
     * Facefusion 服务
     * @return \TencentCloud\Facefusion\V20181201\FacefusionClient
     */
    public function createFacefusionDriver()
    {
        $config = $this->getConfig('facefusion');
        return new \TencentCloud\Facefusion\V20181201\FacefusionClient($this->getCredential($config), $config['region']);
    }

    /**
     * Es 服务
     * @return \TencentCloud\Es\V20180416\EsClient
     */
    public function createEsDriver()
    {
        $config = $this->getConfig('es');
        return new \TencentCloud\Es\V20180416\EsClient($this->getCredential($config), $config['region']);
    }

    /**
     * Emr 服务
     * @return \TencentCloud\Emr\V20190103\EmrClient
     */
    public function createEmrDriver()
    {
        $config = $this->getConfig('emr');
        return new \TencentCloud\Emr\V20190103\EmrClient($this->getCredential($config), $config['region']);
    }

    /**
     * Ecm 服务
     * @return \TencentCloud\Ecm\V20190719\EcmClient
     */
    public function createEcmDriver()
    {
        $config = $this->getConfig('ecm');
        return new \TencentCloud\Ecm\V20190719\EcmClient($this->getCredential($config), $config['region']);
    }

    /**
     * Ecdn 服务
     * @return \TencentCloud\Ecdn\V20191012\EcdnClient
     */
    public function createEcdnDriver()
    {
        $config = $this->getConfig('ecdn');
        return new \TencentCloud\Ecdn\V20191012\EcdnClient($this->getCredential($config), $config['region']);
    }

    /**
     * Ecc 服务
     * @return \TencentCloud\Ecc\V20181213\EccClient
     */
    public function createEccDriver()
    {
        $config = $this->getConfig('ecc');
        return new \TencentCloud\Ecc\V20181213\EccClient($this->getCredential($config), $config['region']);
    }

    /**
     * Dts 服务
     * @return \TencentCloud\Dts\V20180330\DtsClient
     */
    public function createDtsDriver()
    {
        $config = $this->getConfig('dts');
        return new \TencentCloud\Dts\V20180330\DtsClient($this->getCredential($config), $config['region']);
    }

    /**
     * Ds 服务
     * @return \TencentCloud\Ds\V20180523\DsClient
     */
    public function createDsDriver()
    {
        $config = $this->getConfig('ds');
        return new \TencentCloud\Ds\V20180523\DsClient($this->getCredential($config), $config['region']);
    }

    /**
     * Drm 服务
     * @return \TencentCloud\Drm\V20181115\DrmClient
     */
    public function createDrmDriver()
    {
        $config = $this->getConfig('drm');
        return new \TencentCloud\Drm\V20181115\DrmClient($this->getCredential($config), $config['region']);
    }

    /**
     * 获取域名服务
     * @return \TencentCloud\Domain\V20180808\DomainClient
     */
    public function createDomainDriver()
    {
        $config = $this->getConfig('domain');
        return new \TencentCloud\Domain\V20180808\DomainClient($this->getCredential($config), $config['region']);
    }

    /**
     * Dcdb 服务
     * @return \TencentCloud\Dcdb\V20180411\DcdbClient
     */
    public function createDcdbDriver()
    {
        $config = $this->getConfig('dcdb');
        return new \TencentCloud\Dcdb\V20180411\DcdbClient($this->getCredential($config), $config['region']);
    }

    /**
     * Dc 服务
     * @return \TencentCloud\Dc\V20180410\DcClient
     */
    public function createDbbrainDriver()
    {
        $config = $this->getConfig('dc');
        return new \TencentCloud\Dc\V20180410\DcClient($this->getCredential($config), $config['region']);
    }

    /**
     * Dayu 服务
     * @return \TencentCloud\Dayu\V20180709\DayuClient
     */
    public function createDayuDriver()
    {
        $config = $this->getConfig('dayu');
        return new \TencentCloud\Dayu\V20180709\DayuClient($this->getCredential($config), $config['region']);
    }

    /**
     * Cws 服务
     * @return \TencentCloud\Cws\V20180312\CwsClient
     */
    public function createCwsDriver()
    {
        $config = $this->getConfig('cws');
        return new \TencentCloud\Cws\V20180312\CwsClient($this->getCredential($config), $config['region']);
    }

    /**
     * Cvm 服务
     * @return \TencentCloud\Cvm\V20170312\CvmClient
     */
    public function createCvmDriver()
    {
        $config = $this->getConfig('cvm');
        return new \TencentCloud\Cvm\V20170312\CvmClient($this->getCredential($config), $config['region']);
    }

    /**
     * Cr 服务
     * @return \TencentCloud\Cr\V20180321\CrClient
     */
    public function createCrDriver()
    {
        $config = $this->getConfig('cr');
        return new \TencentCloud\Cr\V20180321\CrClient($this->getCredential($config), $config['region']);
    }

    /**
     * Cpdp 服务
     * @return \TencentCloud\Cpdp\V20190820\CpdpClient
     */
    public function createCpdpDriver()
    {
        $config = $this->getConfig('cpdp');
        return new \TencentCloud\Cpdp\V20190820\CpdpClient($this->getCredential($config), $config['region']);
    }

    /**
     * Cms 服务
     * @return \TencentCloud\Cms\V20190321\CmsClient
     */
    public function createCmsDriver()
    {
        $config = $this->getConfig('cms');
        return new \TencentCloud\Cms\V20190321\CmsClient($this->getCredential($config), $config['region']);
    }

    /**
     * Cmq 服务
     * @return \TencentCloud\Cmq\V20190304\CmqClient
     */
    public function createCmqDriver()
    {
        $config = $this->getConfig('cmq');
        return new \TencentCloud\Cmq\V20190304\CmqClient($this->getCredential($config), $config['region']);
    }

    /**
     * Cme 服务
     * @return \TencentCloud\Cme\V20191029\CmeClient
     */
    public function createCmeDriver()
    {
        $config = $this->getConfig('cme');
        return new \TencentCloud\Cme\V20191029\CmeClient($this->getCredential($config), $config['region']);
    }

    /**
     * cloudhsm 服务
     * @return \TencentCloud\Cloudhsm\V20191112\CloudhsmClient
     */
    public function createCloudhsmDriver()
    {
        $config = $this->getConfig('cloudhsm');
        return new \TencentCloud\Cloudhsm\V20191112\CloudhsmClient($this->getCredential($config), $config['region']);
    }

    /**
     * Cloudaudit 服务
     * @return \TencentCloud\Cloudaudit\V20190319\CloudauditClient
     */
    public function createCloudauditDriver()
    {
        $config = $this->getConfig('cloudaudit');
        return new \TencentCloud\Cloudaudit\V20190319\CloudauditClient($this->getCredential($config), $config['region']);
    }

    /**
     * clb 服务
     * @return \TencentCloud\Clb\V20180317\ClbClient
     */
    public function createClbDriver()
    {
        $config = $this->getConfig('clb');
        return new \TencentCloud\Clb\V20180317\ClbClient($this->getCredential($config), $config['region']);
    }

    /**
     * ckafka 服务
     * @return \TencentCloud\Ckafka\V20190819\CkafkaClient
     */
    public function createCkafkaDriver()
    {
        $config = $this->getConfig('ckafka');
        return new \TencentCloud\Ckafka\V20190819\CkafkaClient($this->getCredential($config), $config['region']);
    }

    /**
     * cis 服务
     * @return \TencentCloud\Cis\V20180408\CisClient
     */
    public function createCisDriver()
    {
        $config = $this->getConfig('cis');
        return new \TencentCloud\Cis\V20180408\CisClient($this->getCredential($config), $config['region']);
    }

    /**
     * cim 服务
     * @return \TencentCloud\Cim\V20190318\CimClient
     */
    public function createCimDriver()
    {
        $config = $this->getConfig('cim');
        return new \TencentCloud\Cim\V20190318\CimClient($this->getCredential($config), $config['region']);
    }

    /**
     * chdfs 服务
     * @return \TencentCloud\Chdfs\V20190718\ChdfsClient
     */
    public function createChdfsDriver()
    {
        $config = $this->getConfig('chdfs');
        return new \TencentCloud\Chdfs\V20190718\ChdfsClient($this->getCredential($config), $config['region']);
    }

    /**
     * cfs 服务
     * @return \TencentCloud\Cfs\V20190719\CfsClient
     */
    public function createCfsDriver()
    {
        $config = $this->getConfig('cfs');
        return new \TencentCloud\Cfs\V20190719\CfsClient($this->getCredential($config), $config['region']);
    }

    /**
     * cds 服务
     * @return \TencentCloud\Cds\V20180420\CdsClient
     */
    public function createCdsDriver()
    {
        $config = $this->getConfig('cds');
        return new \TencentCloud\Cds\V20180420\CdsClient($this->getCredential($config), $config['region']);
    }

    /**
     * 创建CDN服务
     * @return \TencentCloud\Cdn\V20180606\CdnClient
     */
    public function createCdnDriver()
    {
        $config = $this->getConfig('cdn');
        return new \TencentCloud\Cdn\V20180606\CdnClient($this->getCredential($config), $config['region']);
    }

    /**
     * Cdb 服务
     * @return \TencentCloud\Cdb\V20170320\CdbClient
     */
    public function createCdbDriver()
    {
        $config = $this->getConfig('cdb');
        return new \TencentCloud\Cdb\V20170320\CdbClient($this->getCredential($config), $config['region']);
    }

    /**
     * Cbs 服务
     * @return \TencentCloud\Cbs\V20170312\CbsClient
     */
    public function createCbsDriver()
    {
        $config = $this->getConfig('cbs');
        return new \TencentCloud\Cbs\V20170312\CbsClient($this->getCredential($config), $config['region']);
    }

    /**
     * Cat 服务
     * @return \TencentCloud\Cat\V20180409\CatClient
     */
    public function createCatDriver()
    {
        $config = $this->getConfig('cat');
        return new \TencentCloud\Cat\V20180409\CatClient($this->getCredential($config), $config['region']);
    }

    /**
     * 验证码服务
     * @return \TencentCloud\Captcha\V20190722\CaptchaClient
     */
    public function createCaptchaDriver()
    {
        $config = $this->getConfig('captcha');
        return new \TencentCloud\Captcha\V20190722\CaptchaClient($this->getCredential($config), $config['region']);
    }

    /**
     * 创建 Cam 服务
     * @return \TencentCloud\Cam\V20190116\CamClient
     */
    public function createCamDriver()
    {
        $config = $this->getConfig('cam');
        return new \TencentCloud\Cam\V20190116\CamClient($this->getCredential($config), $config['region']);
    }

    /**
     * 创建 Bri 服务
     * @return \TencentCloud\Bri\V20190328\BriClient
     */
    public function createBriDriver()
    {
        $config = $this->getConfig('bri');
        return new \TencentCloud\Bri\V20190328\BriClient($this->getCredential($config), $config['region']);
    }

    /**
     * 创建 Bmvpc 服务
     * @return \TencentCloud\Bmvpc\V20180625\BmvpcClient
     */
    public function createBmvpcDriver()
    {
        $config = $this->getConfig('bmvpc');
        return new \TencentCloud\Bmvpc\V20180625\BmvpcClient($this->getCredential($config), $config['region']);
    }

    /**
     * 创建 Bmlb 服务
     * @return \TencentCloud\Bmlb\V20180625\BmlbClient
     */
    public function createBmlbDriver()
    {
        $config = $this->getConfig('bmlb');
        return new \TencentCloud\Bmlb\V20180625\BmlbClient($this->getCredential($config), $config['region']);
    }

    /**
     * 创建 Bmeip 服务
     * @return \TencentCloud\Bmeip\V20180625\BmeipClient
     */
    public function createBmeipDriver()
    {
        $config = $this->getConfig('bmeip');
        return new \TencentCloud\Bmeip\V20180625\BmeipClient($this->getCredential($config), $config['region']);
    }

    /**
     * 创建 Bm 服务
     * @return \TencentCloud\Bm\V20180423\BmClient
     */
    public function createBmDriver()
    {
        $config = $this->getConfig('bm');
        return new \TencentCloud\Bm\V20180423\BmClient($this->getCredential($config), $config['region']);
    }

    /**
     * 创建 Bizlive 服务
     * @return \TencentCloud\Bizlive\V20190313\BizliveClient
     */
    public function createBizliveDriver()
    {
        $config = $this->getConfig('bizlive');
        return new \TencentCloud\Bizlive\V20190313\BizliveClient($this->getCredential($config), $config['region']);
    }

    /**
     * 创建 Billing 服务
     * @return \TencentCloud\Billing\V20180709\BillingClient
     */
    public function createBillingDriver()
    {
        $config = $this->getConfig('billing');
        return new \TencentCloud\Billing\V20180709\BillingClient($this->getCredential($config), $config['region']);
    }

    /**
     * 创建 Bda 服务
     * @return \TencentCloud\Bda\V20200324\BdaClient
     */
    public function createBdaDriver()
    {
        $config = $this->getConfig('bda');
        return new \TencentCloud\Bda\V20200324\BdaClient($this->getCredential($config), $config['region']);
    }

    /**
     * 创建 Batch 服务
     * @return \TencentCloud\Batch\V20170312\BatchClient
     */
    public function createBatchDriver()
    {
        $config = $this->getConfig('batch');
        return new \TencentCloud\Batch\V20170312\BatchClient($this->getCredential($config), $config['region']);
    }

    /**
     * 创建Asr服务
     * @return \TencentCloud\Asr\V20190614\AsrClient
     */
    public function createAsrDriver()
    {
        $config = $this->getConfig('asr');
        return new \TencentCloud\Asr\V20190614\AsrClient($this->getCredential($config), $config['region']);
    }

    /**
     * 获取AME服务
     * @return \TencentCloud\Ame\V20190916\AmeClient
     */
    public function createAmeDriver()
    {
        $config = $this->getConfig('ame');
        return new \TencentCloud\Ame\V20190916\AmeClient($this->getCredential($config), $config['region']);
    }

    /**
     * 获取AAI服务
     * @return \TencentCloud\Aai\V20180522\AaiClient
     */
    public function createAaiDriver()
    {
        $config = $this->getConfig('aai');
        return new \TencentCloud\Aai\V20180522\AaiClient($this->getCredential($config), $config['region']);
    }
}
