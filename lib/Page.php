<?php
 include "Mysql.php";
 include "function.php";

/**
* 分页类
*/
class Page {

	private $totalPage;		//总页数
	private $pageSize;		//每页的数据量
	private $tag;			//用来表示页数的标签
	private $page = 1;		//当前的页码, 为空时默认1
	private $mysql;			//创建的mysql对象
	/**
	 * 构造函数, 参数:数据库名, 表名, 每页显示的数据条数(默认20条), 用来表示当前页码的标签
	 */
	function __construct($dbname, $table, $pageSize = 20, $tag = "page"){

		$this->mysql = new Mysql($dbname);
		$totalNum = $this->mysql->count($table);
		$this->dbname = $dbname;
		$this->table = $table;
		$this->totalPage = ceil($totalNum / $pageSize);
		$this->pageSize = $pageSize;
		$this->tag = $tag;
	}
	/**
	 * 获取当前页码
	 */
	private function getPage(){

		$this->page = isset($_GET[$this->tag]) ? $_GET[$this->tag] : 1;
		if($this->page < 1) $this->page = 1;
		if($this->page > $this->totalPage) $this->page = $this->totalPage;
	}
	/**
	 * 显示所有页码
	 */
	public function showPage(){

		$this->getPage();

		//解析分离参数
		$get = array();
		foreach($_GET as $key => $value){
			if($key == $this->tag) continue;
			$get[] = "$key=$value";
		}
		$get = join("&",$get);
		//追加页码参数
		if(empty($get)){
			$get = $this->tag."=";
		}else{
			$get .= "&".$this->tag."=";
		}

		//页码数链接显示
		$type = 2;		//当前页前后显示的页码的数量
		if($this->page >= $this->totalPage - $type){
			$start = $this->totalPage - $type * 2;
		}else{
			$start = $this->page - $type;
		}
		if($this->page <= $type){
			$end = 1 + $type * 2;
		}else{
			$end = $this->page + $type;
		}
		if($start < 1){
			$start = 1;
		}
		if($end > $this->totalPage){
			$end = $this->totalPage;
		}

		//字符串拼接
		$str = "<a href='?".$get."1'>首页</a>&nbsp;";
		if ($this->page == '1') {
			$str .= "<a href='?".$get."1'>上页</a>&nbsp;";
		}else{
			$str .= "<a href='?".$get.($this->page - 1)."'>上页</a>&nbsp;";
		}
		for($i = $start; $i <= $end;$i++){
			if($i == $this->page){
				$str .= "<a>".$i."</a>&nbsp;";
			}else{
				$str .= "<a href='?".$get.$i."'>".$i."</a>&nbsp;";
			}
		}
		if ($this->page == $this->totalPage) {
			$str .= "<a href='?".$get.($this->totalPage)."'>下页</a>&nbsp;";
		}else{
			$str .= "<a href='?".$get.($this->page + 1)."'>下页</a>&nbsp;";
		}
		$str .= "<a href='?".$get.$this->totalPage."'>尾页</a>&nbsp;";

		return $str;
	}
	/**
	 * 显示当前页的内容
	 */
	public function showList(){

		$this->getPage();

		$sql = "SELECT * FROM ".$this->table." LIMIT ".(($this->page - 1)*$this->pageSize).",".$this->pageSize;
		$result = $this->mysql->getArray($sql);

		return $result;
	}
}