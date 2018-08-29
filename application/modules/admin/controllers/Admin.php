<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    public function index($msg = NULL)
    {
        if (!empty($this->session->userdata['user_role'])) {
            $log = $this->session->userdata['user_role'];
            if ($log == 1) {
                redirect('admin/dashboard');
            } else {
                $this->load->view('admin/login', $msg);
            }
        } else {
            if (isset($msg) && !empty($msg)) {
                $data['msg'] = $msg;
            } else {
                $data['msg'] = '';
            }
            $this->load->view('admin/login', $data);
        }
    }
    public function last_executed_query()
    {
        echo $this->db->last_query();
        die;
    }
    public function print_array($data = NULL)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
    public function verifylogin()
    {
        $data = $this->input->post();
        $this->controller->verifylogin($data);
    }
    public function dashboard()
    {
        if ($this->controller->checkSession()) {
            $user_role             = $this->session->userdata('user_role');
            $where                 = array(
                'is_active' => 1
            );
            //$data['totalProducts'] = $this->model->getcount('products', $where);
            $data['body']          = 'dashboard';
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    public function check_database($password)
    {
        $username = $this->input->post('username', TRUE);
        $where    = array(
            'username' => $username,
            'password' => md5($password),
            'is_active' => 1
        );
        $result   = $this->model->getsingle('users', $where);
        if (!empty($result)) {
            $sess_array = array(
                'id' => $result->id,
                'username' => $result->username,
                'email' => $result->email,
                'user_role' => $result->user_role,
                'first_name' => $result->first_name,
                'last_name' => $result->last_name
            );
            if ($result->user_role == 1 || $result->user_role == 3) {
                unset($sess_array['hospital_id']);
            }
            if ($result->user_role == 4) {
                $where                = array(
                    'user_id' => $result->id
                );
                $sess_array['rights'] = $this->model->getsingle('user_rights', $where);
            }
            $this->session->set_userdata($sess_array);
            return true;
        } else {
            $this->form_validation->set_message('check_database', 'Invalid Credentials ! Please try again with valid username and password');
            return false;
        }
    }
    public function change_password()
    {
        if ($this->controller->checkSession()) {
            $this->form_validation->set_rules('old_password', 'Old Password', 'trim|required');
            $this->form_validation->set_rules('new_password', 'New Password', 'trim|required');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required');
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('errors', validation_errors());
                $data['body'] = 'change_password';
                $this->controller->load_view($data);
            } else {
                $data   = array(
                    'password' => md5($this->input->post('new_password', TRUE))
                );
                $where  = array(
                    'id' => $this->session->userdata('id')
                );
                $table  = 'users';
                $result = $this->model->updateFields($table, $data, $where);
                if ($result == true) {
                    $this->session->set_flashdata('success_msg', 'Password Successfully Updated!!!');
                } else {
                    $this->session->set_flashdata('error', "Something Went Wrong");
                }
                redirect('admin/change_password', 'refresh');
            }
        } else {
            redirect('admin/index');
        }
    }
    public function oldpass_check($oldpass)
    {
        $user_id = $this->session->userdata('id');
        $result  = $this->model->check_oldpassword($oldpass, $user_id);
        if ($result == 0) {
            $this->form_validation->set_message('oldpass_check', "%s does not match.");
            return FALSE;
        } else {
            $this->session->set_flashdata('success_msg', 'Password Successfully Updated!!!');
            return TRUE;
        }
    }
    public function logout()
    {
        $user_data = $this->session->all_userdata();
        foreach ($user_data as $key => $value) {
            if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                $this->session->unset_userdata($key);
            }
        }
        $this->session->sess_destroy();
        $msg = "You have been logged out Successfully...";
        $this->index($msg);
    }
    public function alpha_dash_space($str)
    {
        if (!preg_match("/^([-a-z_ ])+$/i", $str)) {
            $this->form_validation->set_message('check_captcha', 'Only Aplphabates allowed in this field');
        } else {
            return true;
        }
    }
    // public function register($id = null)
    // {
    //     if ($this->controller->checkSession()) {
    //         $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|callback_alpha_dash_space|min_length[2]');
    //         $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|callback_alpha_dash_space|min_length[2]');
    //         $this->form_validation->set_rules('dob', 'Date Of Birth', 'trim|required');
    //         if (empty($id)) {
    //             $this->form_validation->set_rules('user_name', 'User Name', 'trim|required|is_unique[users.username]');
    //             $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
    //             $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|alpha_numeric');
    //         }
    //         if ($this->form_validation->run() == false) {
    //             $this->session->set_flashdata('errors', validation_errors());
    //             $data['countries'] = $this->model->getall('countries');
    //             $data['body']      = 'register';
    //             $this->controller->load_view($data);
    //         } else {
    //             $first_name  = $this->input->post('first_name');
    //             $user_name   = $this->input->post('user_name');
    //             $last_name   = $this->input->post('last_name');
    //             $email       = $this->input->post('email');
    //             $password    = $this->input->post('password');
    //             $address     = $this->input->post('address');
    //             $phone_no    = $this->input->post('phone_no');
    //             $mobile_no   = $this->input->post('mobile_no');
    //             // $dob         = $this->input->post('dob');
    //             $gender      = $this->input->post('gender');
    //             $blood_group = $this->input->post('blood_group');
    //             $status      = $this->input->post('status');
    //             if (!empty($_FILES)) {
    //                 $file_name = $this->file_upload('image');
    //             } else {
    //                 $file_name = '';
    //             }
    //             $data = array(
    //                 'first_name' => $first_name,
    //                 'last_name' => $last_name,
    //                 'username' => $user_name,
    //                 'email' => $email,
    //                 'password' => MD5($password),
    //                 'address' => $address,
    //                 'phone_no' => $phone_no,
    //                 'mobile' => $mobile_no,
    //                 'date_of_birth' => $dob,
    //                 'gender' => $gender,
    //                 'blood_group' => $blood_group,
    //                 'is_active' => $status,
    //                 'user_role' => 3,
    //                 'created_at' => date('Y-m-d H:i:s'),
    //                 'profile_pic' => $file_name
    //             );
    //             if ($this->session->userdata('user_role') == 4) {
    //                 $data['hospital_id'] = $this->session->userdata('hospital_id');
    //             }
    //             $result = $this->model->insertData('users', $data);
    //             redirect('admin/users_list/3');
    //         }
    //     } else {
    //         redirect('admin/index');
    //     }
    // }
    public function delete()
    {
        if ($this->controller->checkSession()) {
            $id    = $this->input->post('id');
            $table = $this->input->post('table');
            //$field = $this->input->post('field');
            $where = array(
                'id' => $id
            );
            $this->model->delete($table, $where);
        } else {
            redirect('admin/index');
        }
    }
    public function change_status()
    {
        if ($this->controller->checkSession()) {
            $id     = $this->input->post('id');
            $table  = $this->input->post('table');
            $where  = array(
                'id' => $id
            );
            $data   = array(
                'is_active' => 0
            );
            $result = $this->model->updateFields($table, $data, $where);
        } else {
            redirect('admin/index');
        }
    }
    public function update_status()
    {
        if ($this->controller->checkSession()) {
            $id     = $this->input->post('id');
            $active = $this->input->post('active');
            $data   = array(
                'is_active' => $active
            );
            $where  = array(
                'id' => $id
            );
            $this->model->update('appointment', $data, $where);
        } else {
            redirect('admin/index');
        }
    }
    public function profile()
    {
        if ($this->controller->checkSession()) {
            $where         = array(
                'id' => $this->session->userdata('id')
            );
            $data['users'] = $this->model->getAllwhere('users', $where);
            if (!empty($data['users'][0]->city)) {
                $where_city                   = array(
                    'id' => $data['users'][0]->city
                );
                $select                       = 'state_id';
                $where_city                   = $this->model->getAllwhere('cities', $where_city, $select);
                $where_state                  = array(
                    'id' => $where_city[0]->state_id
                );
                $select                       = 'country_id';
                $where_state                  = $this->model->getAllwhere('states', $where_state, $select);
                $data['users'][0]->country_id = $where_state[0]->country_id;
            }
            $data['country'] = $this->model->getAllwhere('countries');
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|alpha|min_length[2]');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|alpha|min_length[2]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('errors', validation_errors());
                $data['body'] = 'profile';
                $this->controller->load_view($data);
            } else {
                $first_name  = $this->input->post('first_name');
                $last_name   = $this->input->post('last_name');
                $email       = $this->input->post('email');
                $city        = $this->input->post('city');
                $street      = $this->input->post('street');
                $zip         = $this->input->post('zip');
                $phone_no    = $this->input->post('phone');
                $mobile_no   = $this->input->post('mobile');
                $gender      = $this->input->post('gender');
                $blood_group = $this->input->post('blood_group');
                $data        = array(
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email' => $email,
                    'city' => $city,
                    'street' => $street,
                    'zip' => $zip,
                    'phone_no' => $phone_no,
                    'mobile' => $mobile_no,
                    'gender' => $gender,
                    'blood_group' => $blood_group
                );
                if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
                    if (move_uploaded_file($_FILES['image']['tmp_name'], 'asset/uploads/' . $_FILES['image']['name'])) {
                        $data['profile_pic'] = $_FILES['image']['name'];
                    }
                }
                $result = $this->model->updateFields('users', $data, $where);
                if ($result == true) {
                    $this->session->set_flashdata('success_msg', 'Profile Successfully Updated!!!');
                } else {
                    $this->session->set_flashdata('error', "Something Went Wrong");
                }
                redirect('/admin/profile', 'refresh');
            }
        } else {
            redirect('admin/index');
        }
    }
    public function send_mail()
    {
        if ($this->controller->checkSession()) {
            $where = array(
                'user_role != ' => $this->session->userdata('user_role')
            );
            $this->form_validation->set_rules('reciever_id[]', 'Mail to', 'trim|required');
            $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
            $this->form_validation->set_rules('message', 'Message', 'trim|required');
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('errors', validation_errors());
                $data['users'] = $this->model->getAllwhere('users', $where);
                $data['body']  = 'send_mail';
                $this->controller->load_view($data);
            } else {
                $reciever_id = $this->input->post('reciever_id');
                $subject     = $this->input->post('subject');
                $message     = $this->input->post('message');
                $sender_id   = $this->session->userdata('id');
                $data        = array(
                    'reciever_id' => $reciever_id,
                    'sender_id' => $sender_id,
                    'subject' => $subject,
                    'message' => trim($message),
                    'is_active' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                );
                $config_mail = Array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'ssl://smtp.googlemail.com',
                    'smtp_port' => '465',
                    'smtp_user' => '',
                    'smtp_pass' => '',
                    'mailtype' => 'html',
                    'charset' => 'iso-8859-1',
                    'newline' => "\r\n"
                );
                $this->load->library('email', $config_mail);
                $this->email->set_mailtype("html");
                $this->email->set_newline("\r\n");
                for ($i = 0; $i < count($reciever_id); $i++) {
                    $this->email->from($this->session->userdata('email'), "Admin Team");
                    $this->email->to($reciever_id[$i]);
                    $this->email->subject($subject);
                    $this->email->message($message);
                    $data[] = array(
                        'reciever_id' => $reciever_id[$i],
                        'sender_id' => $sender_id,
                        'subject' => $subject,
                        'message' => trim($message),
                        'is_active' => 1,
                        'created_at' => date('Y-m-d H:i:s')
                    );
                }
                if (!$this->email->send()) {
                    show_error($this->email->print_debugger());
                }
                $this->db->insert_batch('mail', $data);
                redirect('admin/mail_list');
            }
        } else {
            redirect('admin/index');
        }
    }
    public function mail_list()
    {
        if ($this->controller->checkSession()) {
            $where             = array(
                'sender_id =' => $this->session->userdata('id')
            );
            $field_val         = 'mail.*,users.first_name,users.last_name';
            $data['mail_list'] = $this->model->GetJoinRecord('mail', 'reciever_id', 'users', 'id', $field_val, $where);
            $data['body']      = 'mail_list';
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    public function check_password()
    {
        $old_password = $this->input->post('data');
        $where        = array(
            'id' => $this->session->userdata('id'),
            'password' => md5($old_password)
        );
        $result       = $this->model->getsingle('users', $where);
        if (!empty($result)) {
            echo '0';
        } else {
            echo '1';
        }
    }
    public function file_upload($file, $id = null, $field_name = null)
    {
        if (!empty($_FILES["$file"]["name"])) {
            $cpt  = count($_FILES["$file"]["name"]);
            $data = array();
            for ($i = 0; $i < $cpt; $i++) {
                $f_name      = $_FILES["$file"]["name"][$i];
                $f_tmp       = $_FILES["$file"]["tmp_name"][$i];
                $f_size      = $_FILES["$file"]["size"][$i];
                $f_extension = explode('.', $f_name); //To breaks the string into array
                $f_extension = strtolower(end($f_extension)); //end() is used to retrun a last element to the array
                $f_newfile   = "";
                if ($f_name) {
                    $f_newfile                  = uniqid() . '.' . $f_extension;
                    $store                      = 'asset/uploads/' . $f_newfile;
                    $image1                     = move_uploaded_file($f_tmp, $store);
                    $data['image'][$i]['image'] = $f_newfile;
                    if (!empty($field_name) && !empty($id)) {
                        $data['image'][$i]["$field_name"] = $id;
                    }
                }
            }
            return $data;
        }
    }
    public function get_location()
    {
        if (!empty($_POST['latitude']) && !empty($_POST['longitude'])) {
            //send request and receive json data by latitude and longitude
            $url    = 'http://maps.googleapis.com/maps/api/geocode/json?latlng=' . trim($_POST['latitude']) . ',' . trim($_POST['longitude']) . '&sensor=false';
            $json   = @file_get_contents($url);
            $data   = json_decode($json);
            $status = $data->status;
            //if request status is successful
            if ($status == "OK") {
                //get address from json data
                $location = $data->results[0]->formatted_address;
            } else {
                $location = '';
            }
            //return address to ajax 
            echo $location;
        }
    }
    // Add Product 
    public function category($id = null)
    {
        if ($this->controller->checkSession()) {
            $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[2]');
            $this->form_validation->set_rules('description', 'Price', 'trim|required');
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('errors', validation_errors());
                if (!empty($id)) {
                    $where =  array('id'=>$id);
                    $data['categories'] = $this->model->getAllwhere('category', $where);
                }
                $data['body'] = 'categories';
                $this->controller->load_view($data);
            } else {

                $name              = $this->input->post('name');
                $description       = $this->input->post('description');
                $data              = array(
                    'name' => $name,
                    'description' => $description,
                    'is_active' => 1,
                    'added_by'=>$this->session->userdata('id'),
                    'created_at' => date('Y-m-d H:i:s')
                );

                if (!empty($_FILES['images']['name'][0])) {
                    $images = $this->file_upload('images', '', '');
                    $data['image'] = $images['image'][0]['image'];
                }else{
                    $data['image'] = '';
                }
                if (!empty($id)) {
                    $where = array(
                        'id' => $id
                    );
                    unset($data['created_at']);
                    $result  = $this->model->updateFields('category', $data, $where);
                    $last_id = $id;
                } else {
                    $last_id = $this->model->insertData('category', $data);
                }
                
                if ($last_id) {
                    $this->session->set_flashdata('info_message', 'Product Successfully Updated!!!');
                } else {
                    $this->session->set_flashdata('error', "Something Went Wrong");
                }
                redirect('/admin/list_categories', 'refresh');
            }
        } else {
            redirect('admin/index');
        }
    }
    public function list_categories()
    {
        if ($this->controller->checkSession()) {
            $data['category'] = $this->model->getAllwhere('category');
            $data['body']     = 'list_categories';
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }


    public function sub_categories($id = null)
    {
        if ($this->controller->checkSession()) {
            $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[2]');
            $this->form_validation->set_rules('description', 'Price', 'trim|required');
            $this->form_validation->set_rules('cat_id', 'Category', 'trim|required');
            //$this->form_validation->set_rules('description', 'Price', 'trim|required');

            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('errors', validation_errors());
                if (!empty($id)) {
                    $where =  array('id'=>$id);
                    $data['sub_categories'] = $this->model->getAllwhere('sub_category', $where);
                }
                $where =  array('is_active'=>1);
                $data['categories'] = $this->model->getAllwhere('category', $where);
                $data['body'] = 'sub_categories';
                $this->controller->load_view($data);
            } else {

                $name              = $this->input->post('name');
                $description       = $this->input->post('description');
                $cat_id            = $this->input->post('cat_id');
                $data              = array(
                    'name' => $name,
                    'description' => $description,
                    'cat_id'=>$cat_id,
                    'is_active' => 1,
                    'added_by'=>$this->session->userdata('id'),
                    'created_at' => date('Y-m-d H:i:s')
                );

                if (!empty($_FILES['image']['name'][0])) {
                    $images = $this->file_upload('image', '', '');
                    $data['image'] = $images['image'][0]['image'];
                }
                if (!empty($id)) {
                    $where = array(
                        'id' => $id
                    );
                    unset($data['created_at']);
                    $result  = $this->model->updateFields('sub_category', $data, $where);
                    $last_id = $id;
                } else {
                    $last_id = $this->model->insertData('sub_category', $data);
                }
                
                if ($last_id) {
                    $this->session->set_flashdata('info_message', 'Product Successfully Updated!!!');
                } else {
                    $this->session->set_flashdata('error', "Something Went Wrong");
                }
                redirect('/admin/list_sub_categories', 'refresh');
            }
        } else {
            redirect('admin/index');
        }
    }
    public function list_sub_categories()
    {
        if ($this->controller->checkSession()) {
            $data['sub_categories'] = $this->model->getAllwhere('sub_category');
            $data['body']     = 'list_sub_categories';
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }



    public function companies($id = null)
    {
        if ($this->controller->checkSession()) {
            $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[2]');
            $this->form_validation->set_rules('description', 'Price', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[companies.email]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
            $this->form_validation->set_rules('country', 'Country', 'trim|required');
            $this->form_validation->set_rules('state', 'State', 'trim|required');
            $this->form_validation->set_rules('city', 'City', 'trim|required');
            $this->form_validation->set_rules('zip', 'Zip', 'trim|required');
            $this->form_validation->set_rules('address', 'Address', 'trim|required');
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
            $this->form_validation->set_rules('vat', 'Vat', 'trim|required');

            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('errors', validation_errors());
                if (!empty($id)) {
                    $where =  array('id'=>$id);
                    $data['companies'] = $this->model->getAllwhere('companies', $where);
                }
                 $data['countries'] = $this->model->getAllwhere('countries');
                $data['body'] = 'companies';
                $this->controller->load_view($data);
            } else {

                $name         = $this->input->post('name');
                $description  = $this->input->post('description');
                $email        = $this->input->post('email');
                $password     = $this->input->post('password');
                $city         = $this->input->post('city');
                $zip          = $this->input->post('zip');
                $address      = $this->input->post('address');
                $phone        = $this->input->post('phone');
                $vat          = $this->input->post('vat');


                $data              = array(
                    'name' => $name,
                    'description' => $description,
                    'email'=>$email,
                    'password' => MD5($password),
                    'city' => $city,
                    'zip'=>$zip,
                    'address' => $address,
                    'phone' => $phone,
                    'vat'=>$vat,
                    'is_active' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                );

                if (!empty($_FILES['image']['name'][0])) {
                    $images = $this->file_upload('image', '', '');
                    $data['image'] = $images['image'][0]['image'];
                }
                if (!empty($id)) {
                    $where = array(
                        'id' => $id
                    );
                    unset($data['created_at']);
                    $result  = $this->model->updateFields('companies', $data, $where);
                    $last_id = $id;
                } else {
                    $last_id = $this->model->insertData('companies', $data);
                }
                
                if ($last_id) {
                    $this->session->set_flashdata('info_message', 'Company Successfully Updated!!!');
                } else {
                    $this->session->set_flashdata('error', "Something Went Wrong");
                }
                redirect('/admin/list_companies', 'refresh');
            }
        } else {
            redirect('admin/index');
        }
    }
    public function list_companies()
    {
        if ($this->controller->checkSession()) {
            $data['companies'] = $this->model->getAllwhere('companies');
            $data['body']     = 'list_companies';
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }


    public function service_provider($id = null)
    {
        if ($this->controller->checkSession()) {
            $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[2]');
            $this->form_validation->set_rules('description', 'Price', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[companies.email]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
            $this->form_validation->set_rules('country', 'Country', 'trim|required');
            $this->form_validation->set_rules('state', 'State', 'trim|required');
            $this->form_validation->set_rules('city', 'City', 'trim|required');
            $this->form_validation->set_rules('zip', 'Zip', 'trim|required');
            $this->form_validation->set_rules('address', 'Address', 'trim|required');
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
            $this->form_validation->set_rules('vat', 'Vat', 'trim|required');

            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('errors', validation_errors());
                if (!empty($id)) {
                    $where =  array('id'=>$id);
                    $data['service_provider'] = $this->model->getAllwhere('service_provider', $where);
                }
                $data['countries'] = $this->model->getAllwhere('countries');
                $data['companies'] = $this->model->getAllwhere('companies');
                $data['body'] = 'service_provider';
                $this->controller->load_view($data);
            } else {

                $name         = $this->input->post('name');
                $description  = $this->input->post('description');
                $email        = $this->input->post('email');
                $password     = $this->input->post('password');
                $city         = $this->input->post('city');
                $zip          = $this->input->post('zip');
                $address      = $this->input->post('address');
                $phone        = $this->input->post('phone');
                $vat          = $this->input->post('vat');


                $data              = array(
                    'name' => $name,
                    'description' => $description,
                    'email'=>$email,
                    'password' => MD5($password),
                    'city' => $city,
                    'zip'=>$zip,
                    'address' => $address,
                    'phone' => $phone,
                    'vat'=>$vat,
                    'is_active' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                );

                if (!empty($_FILES['image']['name'][0])) {
                    $images = $this->file_upload('image', '', '');
                    $data['image'] = $images['image'][0]['image'];
                }
                if (!empty($id)) {
                    $where = array(
                        'id' => $id
                    );
                    unset($data['created_at']);
                    $result  = $this->model->updateFields('service_provider', $data, $where);
                    $last_id = $id;
                } else {
                    $last_id = $this->model->insertData('service_provider', $data);
                }
                
                if ($last_id) {
                    $this->session->set_flashdata('info_message', 'Service Provider Successfully Updated!!!');
                } else {
                    $this->session->set_flashdata('error', "Something Went Wrong");
                }
                redirect('/admin/list_service_provider', 'refresh');
            }
        } else {
            redirect('admin/index');
        }
    }
    public function list_service_provider()
    {
        if ($this->controller->checkSession()) {
            $data['service_provider'] = $this->model->getAllwhere('service_provider');
            $data['body']     = 'list_service_provider';
            $this->controller->load_view($data);
        } else {
            redirect('admin/index');
        }
    }
    public function get_record()
    {
        $id    = $this->input->get('id');
        $table = $this->input->get('table');
        $field = $this->input->get('field');
        $where  = array("$field" => $id);
        $select = 'id, name';
        $states = $this->model->getAllwhere($table, $where, $select);
        echo json_encode($states);
    }
}