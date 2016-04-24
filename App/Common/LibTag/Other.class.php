<?php
namespace Common\LibTag;
use Think\Template\TagLib;

//自定义标签库
class Other extends TagLib {
	
	//xxxtest测试数据，可删除
	protected $tags = array(
		//自定义标签
		'xxxtest'	=> array('close' => 0),	
	    'tab' =>array(
	       'attr'=>'id,flag',  
	       'close'	=> 0,
	    ),
	);
	

	public function _xxxtest($attr, $content) {
		return 'tag__xxxtest';
	}

    public function _tab($attr,$content){
        $id = !isset($attr['id']) || $attr['id'] == '' ? 0 : trim($attr['id']);
        $flag = empty($attr['flag'])? '0' : $attr['flag'];
        $str = <<<str
         <php>
            echo get_tab(1);
        </php>
str;
        return  $str;
    }
}


?>