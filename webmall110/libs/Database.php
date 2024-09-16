<?php
use Medoo\Medoo;

require_once ("Defines.php");
require_once ("Medoo.php");

class Database {

    private ?Medoo $medoo = null;

    public function __construct()
    {}

    private function DbConnect($dbname)
    {
        try
        {
            $_dbname = (is_null($dbname) ? SQL_DB_NAME : $dbname);

            if (is_null($this->medoo))
            {
                $this->medoo = new Medoo([
                    'type' => 'mssql',
                    'host' => SQL_DB_HOST,
                    'username' => SQL_DB_USERID,
                    'password' => SQL_DB_PASSWD,
                    'database' => $_dbname,
                    'connection_pooling' => true,
                    'trust_server_certificate' => true
                ]);
            }

            if ($this->medoo->error)
            {
                $_error = $this->medoo->errorInfo;
                Common::WriteLog($_error[2], __FUNCTION__);
                return false;
            }

            return true;
        }
        catch (Exception $e)
        {
            Common::WriteLog($e, __FUNCTION__);
            return false;
        }
    }

    protected function Select($table, $columns, $where, $dbname = null)
    {
        if (!$this->DbConnect($dbname))
            return false;

        try
        {
            $_select = $this->medoo->select($table, $columns, $where);
        
            if ($this->medoo->error)
            {
                $_error = $this->medoo->errorInfo;
                Common::WriteLog($_error[2], __FUNCTION__);
                return false;
            }

            return $_select;
        }
        catch (Exception $e)
        {
            Common::WriteLog($e, __FUNCTION__);
            return false;
        }
    }

    protected function Get($table, $columns, $where, $dbname = null)
    {
        if (!$this->DbConnect($dbname))
            return false;

        try
        {
            $_get = $this->medoo->get($table, $columns, $where);
            
            if ($this->medoo->error)
            {
                $_error = $this->medoo->errorInfo;
                Common::WriteLog($_error[2], __FUNCTION__);
                return false;
            }
    
            return $_get;
        }
        catch (Exception $e)
        {
            Common::WriteLog($e, __FUNCTION__);
            return false;
        }
    }

    protected function Update($table, $data, $where, $dbname = null)
    {
        if (!$this->DbConnect($dbname))
            return false;

        try
        {
            $_update = $this->medoo->update($table, $data, $where);
    
            if ($this->medoo->error)
            {
                $_error = $this->medoo->errorInfo;
                Common::WriteLog($_error[2], __FUNCTION__);
                return false;
            }
    
            return $_update;
        }
        catch (Exception $e)
        {
            Common::WriteLog($e, __FUNCTION__);
            return false;
        }
    }

    protected function Insert($table, $values, $dbname = null)
    {
        if (!$this->DbConnect($dbname))
            return false;

        try
        {
            $_insert = $this->medoo->insert($table, $values);

            if ($this->medoo->error)
            {
                $_error = $this->medoo->errorInfo;
                Common::WriteLog($_error[2], __FUNCTION__);
                return false;
            }
            
            return $_insert;
        }
        catch (Exception $e)
        {
            Common::WriteLog($e, __FUNCTION__);
            return false;
        }
    }

    protected function Exists($table, $where, $dbname = null)
    {
        if (!$this->DbConnect($dbname))
            return false;

        try
        {
            $_has = $this->medoo->has($table, $where);

            if ($this->medoo->error)
            {
                $_error = $this->medoo->errorInfo;
                Common::WriteLog($_error[2], __FUNCTION__);
                return false;
            }

            return $_has;
        }
        catch (Exception $e)
        {
            Common::WriteLog($e, __FUNCTION__);
            return false;
        }
    }

    protected function Count($table, $where, $dbname = null)
    {
        if (!$this->DbConnect($dbname))
            return false;

        try
        {
            $_count = $this->medoo->count($table, $where);

            if ($this->medoo->error)
            {
                $_error = $this->medoo->errorInfo;
                Common::WriteLog($_error[2], __FUNCTION__);
                return false;
            }
    
            return $_count; 
        }
        catch (Exception $e)
        {
            Common::WriteLog($e, __FUNCTION__);
            return false;
        }
    }

    protected function Exec($query, $dbname = null)
    {
        if (!$this->DbConnect($dbname))
            return false;

        try
        {
            if (is_array($query))
                $_exec = $this->medoo->query($query[0], $query[1])->fetchAll();
            else
                $_exec = $this->medoo->query($query)->fetchAll();

            if ($this->medoo->error)
            {
                $_error = $this->medoo->errorInfo;
                Common::WriteLog($_error[2], __FUNCTION__);
                return false;
            }

            return $_exec;
        }
        catch (Exception $e)
        {
            Common::WriteLog($e, __FUNCTION__);
            return false;
        }
    }
}