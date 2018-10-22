<?php
namespace app\common\model;
use think\Db;
use think\Model;
class Common extends Model
{
    //获取用户信息
    public static function userdata($userid)
    {
        $createuser = Db::table('doc_users')
            ->where('userid', $userid)
            ->find();
        return $createuser;
    }

    public static function mdate($time = NULL)
    {
        $text = '';
        $t = time() - $time; //时间差 （秒）
        $y = date('Y', $time) - date('Y', time());//是否跨年
        switch ($t) {
            case $t == 0:
                $text = '刚刚';
                break;
            case $t < 60:
                $text = $t . '秒前'; // 一分钟内
                break;
            case $t < 60 * 60:
                $text = floor($t / 60) . '分钟前'; //一小时内
                break;
            case $t < 60 * 60 * 24:
                $text = floor($t / (60 * 60)) . '小时前' ; // 一天内
                break;
            case $t < 60 * 60 * 24 * 3:
                $text = floor($time / (60 * 60 * 24)) == 1 ? '昨天' . date('H:i', $time) : '前天 ' . date('H:i', $time); //昨天和前天
                break;
            case $t < 60 * 60 * 24 * 30:
                $text = floor($t / (60 * 60 * 24)) . '天前';
                break;
            case $t < 60 * 60 * 24 * 365 && $y == 0:
                $text = floor($t / (60 * 60 * 24 * 30)) . '个月前';
                break;
            default:
                $text = date('Y-m-d', $time); //两年以前
                break;
        }
        return $text;
    }

    //请求类型
    public static $reqtype = [
        'GET',
        'POST',
        'PUT',
        'DELETE',
    ];

    /**
     * 请求方法
     * @param $requesturl请求地址
     * @param $requestdata请求参数
     * @param int $requesttype请求类型0http;1https
     * @param $reqmethod请求方式;get、post、put、delete
     * @return mixed
     */
    public static function curlapi($requesturl,$requestdata,$requesttype=0,$reqmethod,$headers="")
    {
        $ch = curl_init();
        if ($requesttype == 1) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true); // 从证书中检查SSL加密算法是否存在
        }
        curl_setopt($ch, CURLOPT_URL, $requesturl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        } else {
            //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: text/json'));
        }
        switch ($reqmethod) {
            case 0 :
                curl_setopt($ch, CURLOPT_HTTPGET, true);
                break;
            case 1:
                curl_setopt($ch, CURLOPT_POST, 1);
                break;
            case 2 :
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                break;
            case 3:
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
                break;
        }
        if ($requestdata&&$reqmethod!=0) {
            curl_setopt($ch, CURLOPT_POSTFIELDS,($requestdata));
        }
        $file_contents = curl_exec($ch);//获得返回值
        curl_close($ch);
        return $file_contents;
    }
}
