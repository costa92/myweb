<?php
namespace Manage\Controller;

class ToolController extends CommonController{
   public function index(){

   	   $count = M('tool')->count();

		$page = new \Common\Lib\Page($count, 10);
		$page->rollPage = 7;
		$page->setConfig('theme','%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$limit = $page->firstRow. ',' .$page->listRows;
		$list = M('tool')->order('id desc')->limit($limit)->select();

		$this->assign('page', $page->show());
		$this->assign('vlist', $list);

       	$this->assign('type', '在线工具');
        $this->display();
   }

   public function add(){
   	    if(IS_POST){
   	    	$this->addPost();
   	    	exit();
   	    }
    	$this->display();
   }   

   public function addPost(){
   	  //当前控制器名称		
		$actionName = strtolower(CONTROLLER_NAME);

		$data['name'] = I('name', '', 'htmlspecialchars,trim');
		$data['link'] = I('link', '', 'htmlspecialchars,trim');
		if (empty($data['name']) || empty($data['link'])) {
			$this->error('名称或网址不能为空');
		}
		$data['ctime']=time();
		if(M('tool')->add($data)){
			$this->success('添加成功',U('Tool/index'));
		}else{
 			$this->error('添加失败');	
		}
   }

   public function edit(){
   	   $id = I('id', 0, 'intval');//类别ID
   	   $tool = M('tool')->where(array('id'=>$id))->find();
   	   	if(!$tool){$this->error("没有该数据");}
   	    $this->assign('vo',$tool);
   	    if(IS_POST){
   	    	$this->editPost();
   	    	exit();
   	    }
   		$this->display();
   }
   public function editPost(){
      $id= $data['id']=  I('id', 0, 'intval');//类别ID
      $data['name'] = I('name', '', 'htmlspecialchars,trim');
      $data['link'] = I('link', '', 'htmlspecialchars,trim');
      if (empty($data['name']) || empty($data['link'])) {
        $this->error('名称或网址不能为空');
      }
      if(M('tool')->save($data)){
        $this->success('修改成功', U('Tool/index'));
      }else {
        $this->error('修改失败');
      }
   }

   //彻底删除文章
  public function del() {

    $id = I('id',0 , 'intval');  
    if (M('tool')->delete($id)) {     
      $this->success('彻底删除成功', U('Tool/index'));
    }else {
      $this->error('彻底删除失败');
    }
  }


  //批量彻底删除文章
  public function delBatch() {

    $idArr = I('key',0 , 'intval');   
    if (!is_array($idArr)) {
      $this->error('请选择要彻底删除的项');
    }
    $where = array('id' => array('in', $idArr));

    if (M('tool')->where($where)->delete()) {
      $this->success('彻底删除成功', U('Tool/index'));
    }else {
      $this->error('彻底删除失败');
    }
  }
}