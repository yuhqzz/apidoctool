<?php
/**
 * 微信相关接口
 * 作者：刘单风
 * 最后修改时间：2018-01-13
 * 版权：刘单风
 */
namespace app\activity\controller;
use think\Controller;
use org\wechat\weixin;

class Apiwechat extends Controller
{
    //自动回复
    public function autoreply()
    {
        $weixinModel=new weixin();
        $data=$weixinModel->responseMsg();
        echo $data;
        exit;
    }

    public function test()
    {
        return $this->fetch('test');
    }

    public function testsubmit()
    {
        echo "";
//        $access_token = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx7fadd7f9c48963d7&secret=644260c6a9539e4e63190cf82da77dda";
//        $access_msg = json_decode(file_get_contents($access_token));
//        $token = $access_msg->access_token;
//        $subscribe_msg = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=ooz5xv1VrGKSlobzkD1lrR_0Aso0";
//        $subscribe = json_decode(file_get_contents($subscribe_msg));
//        $gzxx = $subscribe->subscribe;
//        echo $gzxx;exit;



        $dst_path = 'WechatIMG2.jpeg';
//创建图片的实例
        $dst = imagecreatefromstring(file_get_contents($dst_path));
//打上文字
        $font = 'xiaocao.ttf';//字体
        $black = imagecolorallocate($dst, 0x00, 0x00, 0x00);//字体颜色
        imagefttext($dst, 13, 0, 20, 20, $black, $font, '快乐编程');
//输出图片
        list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);
        switch ($dst_type) {
            case 1://GIF
                header('Content-Type: image/gif');
                imagegif($dst);
                break;
            case 2://JPG
                header('Content-Type: image/jpeg');
                imagejpeg($dst);
                break;
            case 3://PNG
                header('Content-Type: image/png');
                imagepng($dst);
                break;
            default:
                break;
        }
        imagedestroy($dst);

exit;
//        $im = imagecreate(1080, 1920);
//
//        $bg = imagecolorallocate($im, 255, 255, 255); //设置画布的背景为白色
//        $black = imagecolorallocate($im, 0, 0, 0); //设置一个颜色变量为黑色
//        $red = imagecolorallocate($im, 255, 0, 0); //设置一个颜色变量为红色
//
//        $string = "LAMPBrother"; //在图像中输出的字符
//        $text="人生成绩单";
//        $font="xiaocao.ttf";
//        imagettftext($im,60,0,340,100,$black,$font,$text);//水平的将字符串输出到图像中
//        imagettftext($im,40,0,740,100,$black,$font,"平均分");//水平的将字符串输出到图像中
//        imagettftext($im,70,0,940,100,$red,$font,"90");//水平的将字符串输出到图像中
//        imageline($im, 908, 416, 1044, 368, $red);
//        imagestringup($im, 3, 59, 115, $string, $black); //垂直由下而上输到图像中
//        for($i=0,$j=strlen($string);$i<strlen($string);$i++,$j--){ //循环单个字符输出到图像中
//            imagechar($im, 3, 10*($i+1),10*($j+2),$string[$i],$black); //向下倾斜输出每个字符
//            imagecharup($im, 3, 10*($i+1),10*($j+2),$string[$i],$black); //向上倾斜输出每个字符
//        }

//        header('Content-type:image/png');
//        imagepng($im);
        exit();
    }
}