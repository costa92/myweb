<?php
/***
*用户自定义函数文件，二次开发，可将函数写于此，升级不会覆盖此文件
***/

	//XXXtest为测试数据
	function xxxtest() {
		echo "xxxtest function";
	}

	/**
	 * 标签云
	 * @param integer $id 标签云id
	 * @param boolean $flag 是否js方式输出(0|1), 默认html
	 */
	
	function get_tab($id,$flag = 0){
	    $id=intval($id);
	    if(empty($id)){
	        return '';
	    }
	    $setting='';
	    $map=array('tab_status'=>0);
	    $tab = M('tab')->where($map)->order('id DESC')->select();
	    if(!$tab){
	        $tab=array();
	    }
	    foreach ($tab as $row){
	        $contert.="<a href='".U('Search/index',array('keyword'=>$row['tab_name']))."' target='_blank'>";
	        $contert.=$row['tab_name'];
	        $contert.="</a>";
	    }
	    return $contert;
	}
?>