<?php
namespace app\index\controller;
use app\common\model\Projects;
use app\common\model\Common;
use think\Controller;
use think\Hook;
class Docapi extends Controller
{
    public function _initialize()
    {
        parent::_initialize();
        Hook::listen('WebCheckAuth');
    }
    /**
     * 用户登录主页
     */
    public function userDefault()
    {
        $this->assign("menuselect", 1);
        //获取当前登录用户创建的项目
        $projectModel = new Projects();
        $returndata = $projectModel->myprojects();
        $this->assign("createdata", $returndata['createdata']);
        //当前登录用户加入的项目
        $this->assign("joindta", $returndata['joindata']);
        //获取用户参与项目内接口更新变化
        $indexupdate = $projectModel->indexupdate();
        $this->assign("indexupdate", $indexupdate);
        return $this->fetch('index');
    }

    /**
     * 项目列表
     */
    public function userProject()
    {
        $this->assign("menuselect", 2);
        $projectModel = new Projects();
        $projects = $projectModel->projectlists(1);
        $this->assign("projects", $projects);
        return $this->fetch('projects');
    }

    /**
     * 项目约定
     * @param $proid
     * @return mixed
     */
    public function prorules($proid)
    {
        $this->assign("menuselect", 2);
        $projectModel = new Projects();
        $prodata = $projectModel->prodetails($proid);
        $markdown = json_encode($prodata['cooperation_rule'],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
        $this->assign('prorules', $markdown);
        return $this->fetch('prorules');
    }

    /**
     * 接口列表
     * @return mixed
     */
    public function userApis($proid=0,$moduleid=0,$apiid=0)
    {
        $this->assign("menuselect", 3);
        $projectModel = new Projects();
        $resultdata = $projectModel->webapilists($proid, $moduleid, $apiid);
        //页面下拉项目列表
        $this->assign("projects", $resultdata['projects']);
        //当前项目下的版块列表
        $this->assign("modules", $resultdata['modules']);
        //当前项目id
        $this->assign("proid", $resultdata['proid']);
        //当前版块id
        $this->assign("moduleid", $resultdata['moduleid']);
        //当前项目名称
        $this->assign("proname", $resultdata['proname']);
        //接口详情
        $this->assign("apidetails", $resultdata['apidetails']);
        //接口id
        $this->assign("apiid", $resultdata['apiid']);
        return $this->fetch('apis');
    }

    /**
     * 获取接口详情
     * @param $apiid
     */
    public function apidetails()
    {
        $apiid=$_POST['apiid'];
        $projectModel = new Projects();
        $apidetails = $projectModel->apidetails($apiid);
        $apidetails['api_request'] = Common::$reqtype[$apidetails['api_request']];
        return json($apidetails);
    }

    /**
     * 接口测试页面
     * @param $apiid
     * @return mixed
     */
    public function apitest($apiid=0)
    {
        $this->assign("menuselect", 4);
        if($apiid){
            $projectModel = new Projects();
            $apidetails = $projectModel->apidetails($apiid);
            $this->assign("apidetails", $apidetails);
        }
        return $this->fetch('apitest');
    }

    /**
     *测试接口请求
     */
    public function doapitest()
    {
        $requestdata = array();
        $paramstr = array();
        for ($i = 0; $i < count($_POST['reqname']); $i++) {
            if ($_POST['apirequest'] == 0) {
                $paramstr[] = $_POST['reqname'][$i] . "=" . $_POST['reqvalue'][$i];
            } else {
                $requestdata[$_POST['reqname'][$i]] = $_POST['reqvalue'][$i];
            }
            $paramstr[] = $_POST['reqname'][$i] . "=" . $_POST['reqvalue'][$i];
        }
        $apiurl = $_POST['apiurl'];
        if ($_POST['apirequest'] == 0) {
            $paramstr = implode("&", $paramstr);
            $apiurl .= "?" . $paramstr;
        }
        $returnjson = Common::curlapi($apiurl, $requestdata, $_POST['reqtype'], $_POST['apirequest']);
        return json($returnjson);
    }
}
