<?php
/**
 * Created by PhpStorm.
 * User: Rash
 * Date: 03.05.14
 * Time: 15:41
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Content-Type: text/html; charset=utf-8");

class Welcome extends CI_Controller {

    // Главная
    public function index()
    {
        $this->load->model('theaters');
        $data['theaters'] = $this->theaters->get_theater();
        foreach($data['theaters'] as $key => $value)
        {
            $data['theaters'][$key]['count_halls'] = $this->theaters->get_count_halls($value['id']);
        }
        $this->load->model('films');
        $data['films'] = $this->films->get_films_today();
        $this->load->view('welcome_view',$data);
    }

    // Расписание по кинотеатру
    public function schedule($theater_name,$hall = null)
    {
        $this->load->model('theaters');
        $theater = $this->theaters->get_theater(null,$theater_name);
        $data['theater'] = $theater;
        $this->load->model('schedule');
        $data['schedule'] = $this->schedule->get_schedule($theater[0]['id'],$hall);
        $data['current_date'] = date('d.m.Y');
        $this->load->view('schedule_view',$data);
    }

    // Расписание по фильму
    public function films($film)
    {
        $this->load->model('films');
        $data['film'] = $this->films->get_film($film);
        $this->load->model('schedule');
        $data['schedule_by_film'] = $this->schedule->get_schedule_by_film($film);
        $data['current_date'] = date('d.m.Y');
        $this->load->view('schedule_view',$data);
    }

    // Инфа по сеансу
    public function sessions($session_id,$result = null)
    {
        $this->load->model('sessions');
        $session = $this->sessions->get_session($session_id);
        $data['sessions'] = $session;
        $this->load->model('films');
        $data['film'] = $this->films->get_film($session[0]['film_id']);
        $this->load->model('theaters');
        $data['theater'] = $this->theaters->get_theater_by_hall($session[0]['hall_id']);
        $this->db->where('id', $session[0]['hall_id']);
        $query = $this->db->get('halls');
        $data['count_places'] = $query->row()->count_places;
        $data['result'] = $result;
        $data['bought_places'] = $data['busy_tickets'] = array();
        $bought_places = $this->sessions->get_bought_places($session_id);
        foreach($bought_places as $place)
        {
            $data['bought_places'][] = $place['place'];
            if(isset($data['busy_tickets'][$place['unique_code']]))
            {
                $data['busy_tickets'][$place['unique_code']] .= $place['place'] . "; ";
            }
            else
            {
                $data['busy_tickets'][$place['unique_code']] = $place['place'] . "; ";
            }
        }
        $this->load->view('session_view',$data);
    }

    // Покупаем билеты в кино или отменяем покупку
    public function tickets($method,$session_id,$unique_code = null)
    {
        $result = '';
        $this->load->model('sessions');
        $session = $this->sessions->get_session($session_id);
        if('buy' == $method)
        {
            // Сохраняем билеты и генерим уникальный код
            if(!empty($_POST['places']))
            {
                $places = $_POST['places'];
                $random = rand(100,999);
                foreach($places as $place)
                {
                    $this->db->set('session_id', $session_id);
                    $this->db->set('place', $place);
                    $this->db->set('unique_code',
                        $session[0]['id'] .
                        $session[0]['film_id'] .
                        $session[0]['hall_id'] .
                        $random);
                    $this->db->insert('tickets');
                }
                $result = "Билеты успешно куплены!";
            }
            else
            {
                $result = "А кто места выбирать будет? Пушкин?!";
            }
        }
        elseif('reject' == $method)
        {
            // Удаляем купленные места
            $diff_time = (strtotime($session[0]['time']) - time())/(60*60);
            if($diff_time > 0 && $diff_time < 1)
            {
                if(!is_null($unique_code))
                {
                    $this->db->where('unique_code', $unique_code);
                    $this->db->delete('tickets');
                    $result = 'Покупка билетов отменена!';
                }
                else
                {
                    $result = 'Не указан уникальный код!';
                }
            }
            else
            {
                $result = 'Отменить покупку можно не раньше чем за час!';
            }
        }
        $this->sessions($session_id, $result);
    }
}