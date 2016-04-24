<?php
/**
 * 在线工具的控制器
 */
 namespace Home\Controller;
 
 class ToolController extends HomeCommonController{
      public function index(){
          $tool = M('tool');
          $count = $tool->count();
          $page = new \Common\Lib\Page($count, 10);
          $page->rollPage = 3;
          $page->setConfig('theme',' %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
          $limit = $page->firstRow. ',' .$page->listRows;
          $list =  M('tool')->where(array('status'=>0))->order('id DESC')->limit($limit)->select();
          $this->assign('page', $page->show());
          $this->assign('title', '在线工具');
          $this->assign('vlist', $list);
          $this->display();
      }
 }