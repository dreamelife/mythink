<?php 

/*****************************************
  
 +-----------------------------------+
 | 				模板引擎				 |
 +-----------------------------------+ 
 
 ******************************************/


/*
	模板类 
	@author dylan
*/

 Class Template{
 	
 	private $arrayConfig = array(
 		'suffix' 	  => '.m',					//模板文件后缀
 		'templateDir' => 'template/',  			//模板目录
 		'compiledir'  => 'cache',				//编译后文件存放目录
 		'cache_htm'   => false,					//是否开启缓存
 		'suffix_cache'=> '.htm',				//编译文件后最
 		'cache_time'  => 7200,					//自动刷新时间  单位s
 	);	
 	
 	public $file; //模板文件名
 	private $value = array();
 	//private $compileTool = new CompileClass();				//编译器
 	static private $instance = null;
 	
 	public function __construct($arrayConfig = array()){
 		$this->arrayConfig =$arrayConfig+$this->arrayConfig;
 		include('CompileClass.php');
 		$this->compileClass = new CompileClass;
 	}
 	
 	
 	/**
 	 * 实例化模板引擎
 	 * @return object
 	 * @author dylan
 	 * */
 	
 	public static function getInstance(){
 		if(is_null(self::$instance)){
 			self::$instance = new Template();
 		}
 		return self::$instance;
 	}
 	
 	/*
 	 * 设置引擎
 	 * @author dylan
 	 * 
 	 * */
 	
 	public function setConfig($key,$value=null){
 		if(is_array($key)){
 			$this->arrayConfig = $key+$this->arrayConfig;
 		}else{
 			$this->arrayConfig[$key] = $value;
 		}
 	}
 	
 	/*
 	 * 获取当前模板引擎配置
 	 * @author dylan
 	 * */
 	public function getConfig($key=null){
 		if($key){
 			return $this->arrayConfig[$key];
 		}else{
 			return $this->arrayConfig;
 		}
 	}
 	
 	/**
 	 * 注册变量
 	 * @param string $key
 	 * @param mixed $value
 	 * @return void
 	 * 
 	 * ***/
 	public function assign($key,$value){
 		$this->value[$key] = $value;
 	}	
 	
 	/**
 	 *注册数组变量
 	 *@param array $array
 	 * 
 	 * **/
 	
 	public function assignArray($array){
 		if(is_array($array)){
 			foreach ($array as $key =>$v){
 				$this->value[$key] = $v;
 			}
 		}
 	}
 	
 	public function path(){
 		return $this->arrayConfig['templateDir'].$this->file.$this->arrayConfig['suffix'];
 	}
 	
 	
 	
 	public function show($file){
 		$this->file = $file;
 		if(!is_file($this->path())){
 			exit('模板不存在');
 		}
 		$compileFile = $this->arrayConfig['compiledir'].'/'.md5($file).'.php';
 		if(!is_file($compileFile)){
 			if(!is_dir($this->arrayConfig['compiledir'])){
 				mkdir($this->arrayConfig['compiledir']);
 			}
 			$CompileClass = new CompileClass();
 			$CompileClass->compile($this->path(),$compileFile);
 			readfile($compileFile);
 		}else{
 			readfile($compileFile);
 		}
 	}
 	
 	
 	
 }
 
 

?>