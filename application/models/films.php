<?php
/**
 * Created by PhpStorm.
 * User: Rash
 * Date: 03.05.14
 * Time: 16:54
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Films extends CI_Model {

    // Сегодня в кино
    public function get_films_today()
    {
        $this->db->where('films.is_del',false);
        $where = "date(sessions.time) = curdate()";
        $this->db->where($where);
        $this->db->distinct();
        $this->db->select(
            'films.id as id,
            films.name as name'
        );
        $this->db->from('films');
        $this->db->join('sessions', 'sessions.film_id = films.id');
        $query = $this->db->get();
        return $query->result_array();
    }
    // Выборка фильма
    public function get_film($id)
    {
        $this->db->where('films.id', $id);
        $this->db->select(
            'films.name as name,
            films.duration as duration,
            category.name as category,
            genre.name as genre'
        );
        $this->db->from('films');
        $this->db->join('category', 'category.id = films.category', 'left');
        $this->db->join('genre', 'genre.id = films.genre', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }
}