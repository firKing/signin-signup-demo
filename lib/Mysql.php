<?php
/**
* 
*/
class Mysql {

	private $dbh;

	function __construct($dbname){

		$dsn = 'mysql:host=localhost;dbname='.$dbname;
		$username = 'root';
		$passwd = '';
		$this->dbh = new PDO($dsn,$username,$passwd);
		$this->dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);//报错
		$this->dbh->exec('set names utf8');
	}

	/**
	 * 得到数组形式的返回值
	 * @param $sql 查询语句
	 * @return array|bool
	 */
	public function getArray($sql){

		$res = $this->dbh->prepare($sql);
	    $que = $res->execute();
		if($que === false) return false;

		return $res->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * 返回一条符合的查询结果
	 * @param $sql 查询语句
	 * @return bool|mixed
	 */
	public function find($sql){
		$res = $this->dbh->prepare($sql);
		$que = $res->execute();
		if($que === false) return false;

		return $res->fetch(PDO::FETCH_ASSOC);
	}

	/**
	 * 返回某个表的总的数据条数
	 * @param $table
	 * @return mixed
	 */
	public function count($table){

		$sql = "SELECT COUNT(*) AS `num` FROM ".$table;
		$res = $this->dbh->prepare($sql);
		$res->execute();
		if($message = $res->fetch(PDO::FETCH_ASSOC)){
			$totalNum = $message['num'];
		}

		return $totalNum;
	}

	/**
	 * 执行一条sql语句
	 * @param $sql
	 * @return bool
	 */
	public function sql($sql){
		$res = $this->dbh->prepare($sql);
		$que = $res->execute();

		return $que;
	}
}