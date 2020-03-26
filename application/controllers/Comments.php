<?php

defined('BASEPATH') OR exit("No direct script allowed");

class Comments extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('CommentsModel');
    }

    public function index(){
        if (!empty($_POST)){
            $this->CommentsModel->saveNewComment($_POST);
        }

        $data['title'] = "Все комментарии";
        $data['comments'] = $this->CommentsModel->getComments();


        $this->load->view('templates/header',$data);
        $this->load->view('comments/index', $data);
        $this->load->view('templates/footer');

    }



    public function  view($commentId = NULL){
        $data['comments'] = $this->CommentsModel->getComments($commentId);


        if(empty($data['comments'])){
            show_404();
        }



       $data['title'] = $data['comments'][0]['user_name'];
       $data['comment'] = $data['comments'][0]['comment'];

        $this->load->view('templates/header',$data);
        $this->load->view('comments/view', $data);
        $this->load->view('templates/footer');

    }

}