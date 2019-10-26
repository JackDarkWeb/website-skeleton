<?php


abstract class Model extends Db
{
    private $query,
        $error = false,
        $results,
        $count = 0;

    #The name of the table in the database
    # The name of the table must always be plural
    protected $table = false;

    function __construct()
    {
        if($this->table === false){
            $this->table = strtolower(get_class($this)).'s';
        }
    }

    /**
     * @return mixed
     */
    function findAll(){
        return $this->action('SELECT *',$this->table)
            ->results();
    }
    /**
     * @return mixed
     */
    function first(){

        return current($this->results());
    }

    public function findById($id)
    {
        return ($this->action('SELECT *', $this->table, ['id', '=', $id])
            ->results()[0]);
    }
    public function find(array $condition){
        return $this->action('SELECT *', $this->table, $condition)
            ->results()[0];
    }

    /**
     * @param $sql
     * @param array $params
     * @return $this
     */
    function query($sql, $params = [])
    {
        $this->error = false;
        if($this->query = $this->getInstance()->prepare($sql))
        {
            $x = 1;
            if(count($params))
            {
                foreach ($params as $param)
                {
                    $this->query->bindValue($x, $param);
                    $x++;
                }
            }
        }
        if($this->query->execute()){
            $this->results = $this->query->fetchAll(PDO::FETCH_OBJ);
            $this->count   = $this->query->rowCount();
        }else
        {
            $this->error = true;
        }
        return $this;
    }

    /**
     * @param $action
     * @param $table
     * @param array $where
     * @return $this|bool
     */

    // [ORDER BY id DESC]
    private function action($action, $table, $where = []){

        if(gettype($where) == 'array' && count($where) === 3){

            $operators = ['=', '<', '>', '<=', '>='];

            $field    = $where[0];
            $operator = $where[1];
            $value    = $where[2];

            if(in_array($operator, $operators)){

                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ? ";

                if(!$this->query($sql, [$value])->error()){

                    return $this;
                }
            }
        }else{

            $sql = "{$action} FROM {$table}";
            if(!$this->query($sql, [])->error()){

                return $this;
            }

        }
        return false;
    }







    /**
     * @return mixed
     */
    function results(){

        return $this->results;
    }

    /**
     * @return int
     */
    function count(){

        return $this->count;
    }

    /**
     * @return bool
     */
    function error()
    {
        return $this->error;
    }

    /**
     * @param $name
     * @param $args
     */
    public function __call($name, $args){

        echo $name," doesn't exist in this class";
    }

}