<?php
namespace org\wechat;
define("TOKEN", "liuxiaomo");
class weixin
{
    private $path;
    public function __construct()
    {
        $this->path = __DIR__ . DS;
    }

    public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }
    //接收消息
    public function responseMsg()
    {
    	//接收消息
//		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		$postStr = file_get_contents('php://input');
		if (!empty($postStr))
		{
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $keyword = trim($postObj->Content);
            $Event = trim($postObj->Event);
            $time = time();
            //文本模板
            $textTpl = "<xml>
			<ToUserName><![CDATA[%s]]></ToUserName>
			<FromUserName><![CDATA[%s]]></FromUserName>
			<CreateTime>%s</CreateTime>
			<MsgType><![CDATA[%s]]></MsgType>
			<Content><![CDATA[%s]]></Content>
			<FuncFlag>0</FuncFlag>
			</xml>";
            //图片模板
            $imgTpl = "
                    <xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[image]]></MsgType>
                    <Image>
                    <MediaId><![CDATA[%s]]></MediaId>
                    </Image>
                    </xml>";
            if($keyword=="2018"){
                //发送文本
//                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, "text", $contentStr);
                //图片集合
                $imgarr=array("pDOk-XVguI3-AISSiroBkLi-V2J_enhkbs3OZ1ani_s");
                //随机发送
                $randnum=mt_rand(0,0);
                //发送图片
                $resultStr = sprintf($imgTpl, $fromUsername, $toUsername, $time, $imgarr[$randnum]);
            }else{
                $resultStr = sprintf($imgTpl, $fromUsername, $toUsername, $time, "pDOk-XVguI3-AISSiroBkLi-V2J_enhkbs3OZ1ani_s");
            }
            return $resultStr;



            //获取微信access_token
//            $weixintoken=$this->gettoken();
//            //发送消息接口地址
//            $formAction = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.$weixintoken['access_token'];
//            //关键词回复专门处理
//            if($keyword=="2018"){
//                //给此用户发消息
//                $data='{"touser": "'.$fromUsername.'", "msgtype": "text", "text": {"content": "aaa"}}';
//
//            }else{
//                $data='{"touser": "'.$fromUsername.'", "msgtype": "text", "text": {"content": "回复2018有惊喜哦"}}';
//            }
//            $ch = curl_init();
//            $header[] = "Content-type:application/json; encoding=utf-8";//定义content-type为json
//            curl_setopt($ch, CURLOPT_URL, $formAction); //定义表单提交地址
//            curl_setopt($ch, CURLOPT_POST, 1);   //定义提交类型 1：POST ；0：GET
//            curl_setopt($ch, CURLOPT_HEADER,0); //定义是否显示状态头 1：显示 ； 0：不显示
//            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);//定义请求类型
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);//定义是否直接输出返回流
//            curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //定义提交的数据，这里是XML文件
//            $res = curl_exec($ch);
//            curl_close($ch);//关闭
        }else {
            echo "";
            exit;
        }
    }

    /**
     * 取出微信access_token
     */
    public function gettoken()
    {
        $weixintoken=file_get_contents("weixintoken.txt");//读取token数据信息
        $weixintoken=json_decode($weixintoken,true);
        if(empty($weixintoken))//如果是空说明是第一次获取
        {
            $newtoken=$this->returntoken();
            $return=array(
                "status"=>0,
                "msg"=>"success",
                "access_token"=>$newtoken
            );
        }
        else
        {
            $datetime=date("Y-m-d H:i:s");
            if($weixintoken['endtime']>$datetime)//token没有过期
            {
                $return=array(
                    "status"=>0,
                    "msg"=>"success",
                    "access_token"=>$weixintoken['access_token']
                );
            }
            else//说明过期，重新获取
            {
                $newtoken=$this->returntoken();
                $return=array(
                    "status"=>0,
                    "msg"=>"success",
                    "access_token"=>$newtoken
                );
            }
        }
       return $return;
    }

    /**
     * 获取微信access_token方法
     */
    public function returntoken()
    {
        $ch = curl_init("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx7fadd7f9c48963d7&secret=644260c6a9539e4e63190cf82da77dda") ;
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回
        $output=curl_exec($ch);
        $token=json_decode($output,true);
        $nowtime=date("Y-m-d H:i:s");
        $enday=date("Y-m-d H:i:s",time()+$token['expires_in']);//token有效期截止时间
        $data=array(
            "access_token"=>$token['access_token'],
            "expires_in"=>$token['expires_in'],
            "gettime"=>$nowtime,
            "endtime"=>$enday
        );
        /* 写入文件 */
        $fh = fopen("weixintoken.txt", 'w') ;
        fwrite($fh, json_encode($data));
        fclose($fh);
        return $token['access_token'];
    }
	
    //校验
	public function checkSignature()
	{
        if (!defined("TOKEN"))
        {
            throw new Exception('TOKEN is not defined!');
        }
        
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode($tmpArr);
		$tmpStr = sha1($tmpStr);
		if( $tmpStr == $signature)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
?>