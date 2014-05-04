<?php
/**
 * Created by PhpStorm.
 * User: Rash
 * Date: 03.05.14
 * Time: 16:54
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Schedule extends CI_Model {

    // Расписание сеансов по кинотеатру
    public function get_schedule($id_theater,$id_hall = null)
    {
        if(!is_null($id_hall)) $this->db->where('hall_id',$id_hall);
        $this->db->where('cinema_id',$id_theater);
        $where = "date(sessions.time) = curdate() and sessions.time > now()";
        $this->db->where($where);
        $this->db->select(
            'films.name as name,
            films.duration as duration,
            category.name as category,
            genre.name as genre,
            sessions.id as session_id,
            hour(sessions.time) as hour,
            minute(sessions.time) as minute,
            halls.number_hall as number_hall,
            halls.id as hall_id'
        );
        $this->db->from('sessions');
        $this->db->join('films', 'films.id = film_id', 'left');
        $this->db->join('category', 'category.id = category', 'left');
        $this->db->join('genre', 'genre.id = genre', 'left');
        $this->db->join('halls', 'halls.id = hall_id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }
    // Расписание сеансов по фильму
    public function get_schedule_by_film($id_film)
    {
        $this->db->where('films.id',$id_film);
        $where = "date(sessions.time) = curdate() and sessions.time > now()";
        $this->db->where($where);
        $this->db->select(
            'theaters.name as theater_name,
            halls.number_hall as number_hall,
            sessions.id as session_id,
            hour(sessions.time) as hour,
            minute(sessions.time) as minute'
        );
        $this->db->from('films');
        $this->db->join('sessions', 'sessions.film_id = films.id');
        $this->db->join('halls', 'halls.id = sessions.hall_id', 'left');
        $this->db->join('theaters', 'theaters.id = halls.cinema_id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

}