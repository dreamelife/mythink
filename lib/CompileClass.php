<?php 
	/**
	 * 模板编译工具类
	 * @author dylan
	 * 
	 * */
	class CompileClass{
		private $template;
		private $content;
		private $comfile;
		private $left = '{';
		private $right = '}';
		private $value = array();
		
		public function compile($sourse,$file) {
			file_put_contents($file,file_get_contents($sourse));
		}
	}

?>