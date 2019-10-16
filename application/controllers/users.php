<?php
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

    function index() {
        $this->getuser();
    }

    // user saving func
    function setuser () {
        $post = $this->input->post();

        if (isset($post['username']) && $post['username']!='')
            $data['username'] = $post['username'];
        if (isset($post['role_id']) && $post['role_id']!='')
            $data['role_id'] = $post['role_id'];

        if ($post['userid']) {
            $userResult = $this->usersmodel->SetUser($post['userid'], $data);
        }
        else {
            $userResult = $this->usersmodel->SetUser($data);
        }

        redirect('users/getuser/'.$userResult, 'refresh');
    }

    // user getting func
    function getuser ($userid = null) {
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

            $this->showcontent('userform', $this->pageContent);
        }
        else {
            $usersList = $this->usersmodel->GetUser();

            if ($usersList['result']) {
                $this->pageContent['userslist'] = $usersList['result'];
            }
            else {
                $this->pageContent['msg'] = $usersList['msg'];
            }

            $this->showcontent('usertable', $this->pageContent);
        }

    }

    // user deleting func
    function deluser ($userid = null) {
        $this->usersmodel->DelUser($userid);
        redirect('users/getuser', 'refresh');
    }

    // user role saving func
    function setuserrole () {
        $post = $this->input->post();

        if (isset($post['rolename']) && $post['rolename']!='')
            $data['rolename'] = $post['rolename'];

        if ($post['roleid']) {
            $userRoleResult = $this->usersmodel->SetUser($post['roleid'], $data);
        }
        else {
            $userRoleResult = $this->usersmodel->SetUser($data);
        }

        redirect('users/getuserrole/'.$userRoleResult, 'refresh');
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

            $this->showcontent('roleform', $this->pageContent);
        }
        else {
            $roleList = $this->usersmodel->GetUserRole();

            if ($roleList['result']) {
                $this->pageContent['rolelist'] = $roleList['result'];
            }
            else {
                $this->pageContent['msg'] = $roleList['msg'];
            }

            $this->showcontent('roletable', $this->pageContent);
        }
    }

    // user role deleting func
    function deluserrole ($userroleid = null) {
        $this->usersmodel->DelUserRole($userroleid);
        redirect('users/getuserrole', 'refresh');
    }
}