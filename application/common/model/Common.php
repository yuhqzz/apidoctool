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
}
