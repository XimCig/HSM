<?php

function db(){
    return DB_pdo::DB_Example();
}
class DB_pdo{


        public $prefix;     //数据表前缀

        public $coding;     //编码

        public $pdo_con;    //数据总链接柄

        public $fetchModel;

        static $Example=null;   //单例

        public $errorInfo;

        private $PDOStatement;

        private  function __construct(){

            $this->db_connect();
       }
       private  function __clone(){}

       static function DB_Example(){
            if ( self::$Example === null ){
                self::$Example = new DB_pdo();
            }
            return self::$Example;
       }

       /*
        *   数据库连接
        * */
        public function db_connect(){
            //数据库配置文件
            require_once ("./main/config/database.php");

            $this->prefix = $mysql['prefix'];     //前缀
            $this->coding = $mysql['coding'];     //编码

            //PDO_DSN
            $DSN = 'mysql:host='.$mysql['host'].';dbname='.$mysql['db'].';charset='.$this->coding;

            //连接
            $this->pdo_con = new \PDO( $DSN , $mysql['user'], $mysql['pass'],array(  PDO::ATTR_PERSISTENT => $mysql['PERSISTENT'] ));

            $this->pdo_con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);       //PDO 关闭 PHP模拟处理

            $this->pdo_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    //设置PDO报错机制


            $this->query("set names ".$this->coding);                                  //数据库编码

            $this->fetchModel = PDO::FETCH_ASSOC;   
        }

        /**
         * [query SQL查询]
         * @param  [String] $sql [sql语句]
         * @return [type]      [description]
         */
        public function query( $sql ){
            try{

                $this->PDOStatement = $this->pdo_con->query( $sql );
                return $this;
            } catch (PDOException $e){

                \hsm\HSM_::print_error($e);
            }


        }

        /**
         * [prep 预处理]
         * @param  [SQL String] $sql      [SQL语句]
         * @param  [Array]      $prep_arr [预处理数据]
         * @return [$this]           [description]
         */
        public function prep( $sql,$prep_arr ){
            try{

                $this->PDOStatement = $this->pdo_con->prepare($sql);

                $this->PDOStatement ->execute($prep_arr);

                return $this;

              }catch (PDOException $exception){

                \hsm\HSM_::print_error($exception);

            }

        }

        /**
         * [result 返回全部数据]
         * @return [type] [description]
         */
        public function result(){

            $result = $this->PDOStatement->fetchAll($this->fetchModel);

            $this->PDOStatement = null;

            return $result;
        }

        /**
         * [resultOne 取一条数据]
         * @return [Array] [取得的数据]
         */
        public function resultOne(){
            return $this->PDOStatement->fetch($this->fetchModel);
        }

        /**
         * [__destruct 注销PDO]
         */
        public function __destruct()
        {
            $this->pdo_con = null;
        }
}
