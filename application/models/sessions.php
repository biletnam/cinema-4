<?php
/**
 * Created by PhpStorm.
 * User: Rash
 * Date: 03.05.14
 * Time: 16:54
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sessions extends CI_Model {

    // Выборка сессии
    public function get_session($id)
    {
        $this->db->where('id', $id);
        $this->db->select(
            'id,
            year(time) as year,
            month(time) as month,
            day(time) as day,
            hour(time) as hour,
            minute(time) as minute,
            time as time,
            hall_id,
            film_id'
        );
        $this->db->from('sessions');
        $query = $this->db->get();
        return $query->result_array();
    }
    // Выбор купленных мест
    public function get_bought_places($id_session)
    {
        $this->db->where('session_id', $id_session);
        $query = $this->db->get('tickets');
        return $query->result_array();
    }
}