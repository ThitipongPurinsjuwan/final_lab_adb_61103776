<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class Cart_model extends CI_Model{

    function __construct()
    {
        parent::__construct();
    }

    public function findOne($condition = [])
    {
        if(sizeof($condition) > 0){
            $this->mongo_db->where($condition);
        }
        $result = $this->mongo_db->getOne('carts');
        $data = $this->mongo_db->row_array($result);
        return $data;
    }

    public function findAll($condition = [])
    {
        if(sizeof($condition) > 0){
            $this->mongo_db->where($condition);
        }
        $result = $this->mongo_db->get('carts');
        return $result;
    }

    public function insert($data)
    {
        $insertId = $this->mongo_db->insert('carts', $data);
        return $insertId;
    }

}