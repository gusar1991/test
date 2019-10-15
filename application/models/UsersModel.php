<?php
/**
 * @property CI_DB_query_builder db
 * @property CI_Loader load
 */
class UsersModel extends CI_Model {
    private $answer = array(
        "success" => false,
        "msg" => '',
        "result" => null
    );

    // user setter func
    function SetUser ($userId = null, $data = array()) {
        $answer = $this->answer;

        if ($userId) {
            // update user
            $this->db
                ->where('id', $userId)
                ->update('users', $data);
            // here must be notification email function
        }
        else {
            // create user
            $this->db->insert('users', $data);
            $userId = $this->db->insert_id();

            // here must be notification email function, new id is for it
        }

        $answer['success'] = true;
        $answer['result'] = $userId;
        return $answer;
    }

    // user getter func
    function GetUser ($userId = null) {
        $answer = $this->answer;

        if ($userId) {
            // one user
            $userResult = $this->db
                ->select('users.*, user_role.*')
                ->join('user_role', 'role_id = user_role.id', 'left')
                ->where('id', $userId)
                ->get('users');

            if ($userResult->num_rows() > 0) {
                $answer['success'] = true;
                $answer['result'] = $userResult->row();
            }
            else {
                $answer['msg'] = 'can not get user';
                return $answer;
            }
        }
        else {
            // list
            $userResult = $this->db
                ->select('users.*, user_role.*')
                ->join('user_role', 'role_id = user_role.id', 'left')
                ->get('users');

            if ($userResult->num_rows() > 0) {
                $answer['success'] = true;
                $answer['result'] = $userResult->result();
            }
            else {
                $answer['msg'] = 'can not get user list';
                return $answer;
            }
        }
        return $answer;
    }

    // user delete func
    function DelUser ($userId = null) {
        // honestly, I think better change user status and check his data on setting new user, for better HR's experience
        $this->db->where('id', $userId)->delete('users');
    }

    // user role setter func
    function SetUserRole ($userRoleId = null, $data = array()) {
        $answer = $this->answer;

        if ($userRoleId) {
            // update user role
            $this->db
                ->where('id', $userRoleId)
                ->update('user_role', $data);
            // here must be notification email function
        }
        else {
            // create user role
            $this->db->insert('user_role', $data);
            $userRoleId = $this->db->insert_id();

            // here must be notification email function, new id is for it
        }

        $answer['success'] = true;
        $answer['result'] = $userRoleId;
        return $answer;
    }

    // user role getter func
    function GetUserRole ($userRoleId = null) {
        $answer = $this->answer;

        if ($userRoleId) {
            $roleResult = $this->db
                ->where('id', $userRoleId)
                ->get('user_role');

            if ($roleResult->num_rows() > 0) {
                $answer['success'] = true;
                $answer['result'] = $roleResult->row();
            }
            else {
                $answer['msg'] = 'can not get role';
                return $answer;
            }
        }
        else {
            $roleResult = $this->db
                ->get('user_role');

            if ($roleResult->num_rows() > 0) {
                $answer['success'] = true;
                $answer['result'] = $roleResult->result();
            }
            else {
                $answer['msg'] = 'can not get role list';
                return $answer;
            }
        }
        return $answer;
    }

    // user delete func
    function DelUserRole ($userRoleId = null) {
        $this->db->where('id', $userRoleId)->delete('users');
    }
}