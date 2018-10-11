<?php 
use PDO; 
use \Exception as DatabaseException; 

class Mysql{
    private static $conn = array();
    private function __construct(){}
    private static function getConnection( $connection_name="ro" ){
        if(!isset( Mysql::$conn[$connection_name] ) ){
            $connUpper = strtoupper($connection_name);
            $compl = '';
            Mysql::$conn[ $connection_name ] = new PDO(
                'mysql:host=' .  getenv($connUpper."_DBHOST".$compl) .
                ';dbname=' .  getenv($connUpper . "_DBNAME") ,
                 getenv($connUpper . "_DBUSERNAME") ,
                 getenv($connUpper . "_DBPASSWORD") ,
                array(
                    PDO::ATTR_EMULATE_PREPARES => TRUE,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                )
            );
        }
        return Mysql::$conn[ $connection_name ];
    }
    public static function select( $connection_name, $sql, $parameters=array() ){
        try{
            $conn = Mysql::getConnection( $connection_name );
            $q = $conn->prepare( $sql );
            $q->execute( $parameters );
            $ret = $q->fetchAll( PDO::FETCH_ASSOC );
        }catch(\PDOException $e){
            throw new DatabaseException($e->getMessage());
        } catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
        return $ret;
    }
    public static function insert( $connection_name, $sql, $parameters=array() ){
        $conn = Mysql::getConnection( $connection_name );
        $q = $conn->prepare( $sql );
        try{
            $q->execute( $parameters );
            $ret = $conn->lastInsertId();
        }catch(\PDOException $e){
            throw new DatabaseException($e->getMessage());
        } catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
        return (int) $ret;
    }
    public static function update( $connection_name, $sql, $parameters=array() ){
        $conn = Mysql::getConnection( $connection_name );
        $q = $conn->prepare( $sql );
        $ret = true;
        try{
            $q->execute( $parameters );
        }catch(\PDOException $e){
            throw new DatabaseException($e->getMessage());
        } catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
        return (bool) $ret;
    }
    public static function delete( $connection_name, $sql, $parameters=array() ){
        $conn = Mysql::getConnection( $connection_name );
        $q = $conn->prepare( $sql );
        $ret = false;
        try{
            $q->execute( $parameters );
            $ret = $q->rowCount();
        }catch(\PDOException $e){
            throw new DatabaseException($e->getMessage());
        } catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
        return (bool) $ret;
    }
    public static function execute( $connection_name, $sql, $parameters=array() ){
        $ret = false;
        $conn = Mysql::getConnection( $connection_name );
        $q = $conn->prepare( $sql );
        try{
            $q->execute( $parameters );
            $ret = true;
        }catch(\PDOException $e){
            throw new DatabaseException($e->getMessage());
        } catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
        return (bool) $ret;
    }
    public static function beginTransaction($connection_name) {
        $conn = Mysql::getConnection($connection_name);
        return $conn->beginTransaction();
    }
    public static function commit($connection_name) {
        $conn = Mysql::getConnection($connection_name);
        return $conn->commit();
    }
    public static function rollback($connection_name) {
        $conn = Mysql::getConnection($connection_name);
        return $conn->rollback();
    }
}
?>
