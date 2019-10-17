<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Loader load
 * @property CI_Input input
 * @property UsersModel usersmodel
 * @property CI_DB_query_builder db
 */

class Users extends CI_Controller {

    private $pageContent = array(
        'pageContent' => null,
        'msg' => ''
    );

    public function __construct() {
        parent::__construct();

        $this->load->model("UsersModel", "usersmodel");
    }

	public function index()
	{
		$this->getuser();
	}

	// user setting func
    function setuser ($userid = null) {
        $post = $this->input->post();

        if (!empty($post)) {

            if (isset($post['username']) && $post['username'] != '')
                $data['username'] = $post['username'];
            if (isset($post['role_id']) && $post['role_id'] != '')
                $data['role_id'] = $post['role_id'];

            $userResult = $this->usersmodel->SetUser($userid, $data);

            redirect('users/getuser/', 'refresh');
        }
        else {
            $userRolesList = $this->usersmodel->GetUserRole();

            if ($userRolesList['result']) {
                $this->pageContent['userroles'] = $userRolesList['result'];
            }
            else {
                $this->pageContent['msg'] = $userRolesList['msg'];
            }
            $this->load->view('userform', $this->pageContent);
        }
    }

    // user getting func
    public function getuser ($userid = null) {
        // prepare role list for selector
        $userRolesList = $this->usersmodel->GetUserRole();

        if ($userRolesList['result']) {
            $this->pageContent['userroles'] = $userRolesList['result'];
        }
        else {
            $this->pageContent['msg'] = $userRolesList['msg'];
        }

        if ($userid) {
            $userItem = $this->usersmodel->GetUser($userid);

            if ($userItem['result']) {
                $this->pageContent['userdata'] = $userItem['result'];
                $this->pageContent['userid'] = $userid;
            }
            else {
                $this->pageContent['msg'] = $userItem['msg'];
            }

            $this->load->view('userform', $this->pageContent);
        }
        else {
            $usersList = $this->usersmodel->GetUser();

            if ($usersList['result']) {
                $this->pageContent['userslist'] = $usersList['result'];
            }
            else {
                $this->pageContent['msg'] = $usersList['msg'];
            }

            $this->load->view('usertable', $this->pageContent);
        }

    }

    // user deleting func
    function deluser ($userid = null) {
        $this->usersmodel->DelUser($userid);
        redirect('users/getuser', 'refresh');
    }

    // user role saving func
    function setuserrole ($userroleid = null) {
        $post = $this->input->post();

        if (!empty($post)) {
            if (isset($post['rolename']) && $post['rolename'] != '')
                $data['rolename'] = $post['rolename'];

            $userRoleResult = $this->usersmodel->SetUserRole($userroleid, $data);

            redirect('users/getuserrole/', 'refresh');
        }
        else {
            $this->load->view('roleform', $this->pageContent);
        }
    }

    // user role getting func
    function getuserrole ($userroleid = null) {
        if ($userroleid) {
            $roleItem = $this->usersmodel->GetUserRole($userroleid);

            if ($roleItem['result']) {
                $this->pageContent['roledata'] = $roleItem['result'];
                $this->pageContent['roleid'] = $roleItem;
            }
            else {
                $this->pageContent['msg'] = $roleItem['msg'];
            }

            $this->load->view('roleform', $this->pageContent);
        }
        else {
            $roleList = $this->usersmodel->GetUserRole();

            if ($roleList['result']) {
                $this->pageContent['rolelist'] = $roleList['result'];
            }
            else {
                $this->pageContent['msg'] = $roleList['msg'];
            }

            $this->load->view('roletable', $this->pageContent);
        }
    }

    // user role deleting func
    function deluserrole ($userroleid = null) {
        $this->usersmodel->DelUserRole($userroleid);
        redirect('users/getuserrole', 'refresh');
    }
}
