<?php
/**
 * Created by PhpStorm.
 * User: Rash
 * Date: 03.05.14
 * Time: 16:54
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Theaters extends CI_Model {

    // Выборка кинотеатра
    public function get_theater($id = null, $code_name = null)
    {
        if(!is_null($id)) $this->db->where('id', $id);
        if(!is_null($code_name)) $this->db->where('code_name', $code_name);
        $query = $this->db->get('theaters');
        return $query->result_array();
    }

    // Количество залов в кинотеатре
    public function get_count_halls($id_theater)
    {
        $this->db->where('cinema_id',$id_theater);
        $this->db->from('halls');
        return $this->db->count_all_results();
    }

    public function get_theater_by_hall($hall_id)
    {
        $this->db->where('halls.id', $hall_id);
        $this->db->select('*');
        $this->db->from('theaters');
        $this->db->join('halls', 'halls.cinema_id = theaters.id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }
}