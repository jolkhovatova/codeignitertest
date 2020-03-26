<?php

class CommentsModel extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function getComments($commentId = NULL)
    {
        $this->db->order_by("id", "desc");

        if (is_null($commentId)) {
            $query = $this->db->get('comments');
            return $query->result_array();
        }

        $query = $this->db->get_where('comments', ["id " => $commentId]);
        return $query->result_array();
    }


    public function addNewComment($newComment)
    {
        $qAddBug = 'INSERT INTO comments (user_name, email, comment,'
            . ' VALUES (?, ?, ?,)';
        $res = $this->db->query($qAddBug, array(
            $newComment['user_name'],
            $newComment['email'],
            $newComment['comment']
        ));
        if ($res) {
            return $this->db->insert_id();
        }
        return $res;
    }


    public function saveNewComment($newComment)
    {
        if ($this->checkNewComment($newComment)) {
            $name = $newComment['name'];
            if (empty($name)) {
                $name = explode("@", $newComment['email'])[0]; //email[0]
            }

            $data = array(
                'user_name' => $name,
                'email' => $newComment['email'],
                'comment' => $newComment['comment'],
            );
            $this->db->insert('comments', $data);
        }

    }

    private function checkNewComment($newComment)
    {

        if ($newComment['email'] and $newComment['comment']) {
            if (filter_var($newComment['email'], FILTER_VALIDATE_EMAIL)) {
                return true;
            }
        }

        return false;
    }

}

