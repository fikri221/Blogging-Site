<?php 

class Blog extends CI_Controller{

    public function __construct(){
        parent::__construct();

        $this->load->helper('text');
        $this->load->model('Blog_model');
        $this->load->library('session');
        
    }

    public function index($offset = 0)
    {
        $this->load->library('pagination');

        // config
        $config['base_url'] = site_url('blog/index');
        $config['total_rows'] = $this->Blog_model->getTotalBlogs();
        $config['per_page'] = 3;
        
        //styling
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tagl_close'] = '</a></li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tagl_close'] = '</li>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item disabled">';
        $config['first_tagl_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tagl_close'] = '</a></li>';
        $config['attributes'] = array('class' => 'page-link');

        // initialize
        $this->pagination->initialize($config);

        $query = $this->Blog_model->getBlogs($config['per_page'], $offset);
        $data['blog'] = $query->result_array();

        $this->load->view('blog', $data);
    }

    public function detail_artikel($url)
    {
        $query = $this->Blog_model->getSingleBlog('url', $url);
        $data['blog'] = $query->row_array();

        $this->load->view('detail_artikel', $data);
    }

    public function add()
    {
        $this->form_validation->set_rules('title', 'Judul', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required|alpha_dash');
        $this->form_validation->set_rules('content', 'Konten', 'required');

        if($this->form_validation->run()){
            $title = $this->input->post('title');
            $url = $this->input->post('url');
            $content = $this->input->post('content');

            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 10000;
            $config['max_width']            = 7680;
            $config['max_height']           = 4320;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('cover'))
            {
                echo $this->upload->display_errors();
            }
            else
            {
                $cover = $this->upload->data()['file_name'];
            }

            $id = $this->Blog_model->insertBlog($title, $url, $content, $cover);

            if($id){
                $this->session->set_flashdata("message", '<div class="alert alert-success">Data berhasil disimpan</div>');
                redirect('/');
            } else{
                $this->session->set_flashdata("message", '<div class="alert alert-success">Data gagal disimpan</div>');
                redirect('/');
            }
        }

        $this->load->view('form_add');
    }

    public function edit($id)
    {
        $query = $this->Blog_model->getSingleBlog('id', $id);
        $data['blog'] = $query->row_array();

        $this->form_validation->set_rules('title', 'Judul', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required|alpha_dash');
        $this->form_validation->set_rules('content', 'Konten', 'required');

        if($this->form_validation->run()){
            $title = $this->input->post('title');
            $url = $this->input->post('url');
            $content = $this->input->post('content');

            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 10000;
            $config['max_width']            = 7680;
            $config['max_height']           = 4320;

            $this->load->library('upload', $config);
            $this->upload->do_upload('cover');

            if (!empty($cover = $this->upload->data()['file_name']))
            {
                $cover = $this->upload->data()['file_name'];
            }

            $id = $this->Blog_model->updateBlog($id, $title, $url, $content, $cover);

            if($id){
                $this->session->set_flashdata("message", '<div class="alert alert-success">Data berhasil diperbarui</div>');
                redirect('/');
            } else{
                $this->session->set_flashdata("message", '<div class="alert alert-success">Data gagal diperbarui</div>');
                redirect('/');
            }
        }

        $this->load->view('form_edit', $data);
    }

    public function delete($id)
    {
        $id = $this->Blog_model->deleteBlog($id);
        if($id){
            $this->session->set_flashdata("message", '<div class="alert alert-success">Data berhasil dihapus</div>');
            redirect('/');
        } else{
            $this->session->set_flashdata("message", '<div class="alert alert-success">Data gagal dihapus</div>');
            redirect('/');
        }
    }

    public function login()
    {
        if($this->input->post())
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            if($username=="admin" && $password=="admin"){
                $_SESSION['username'] = 'admin';
                redirect('/');
            }
            else if($username=="admin" && $password!="admin"){
                $this->session->set_flashdata("message", '<div class="alert alert-success">Password yang Anda masukkan salah.</div>');
                redirect('blog/login');
            }
            else if($username!="admin" && $password=="admin"){
                $this->session->set_flashdata("message", '<div class="alert alert-success">Username yang Anda masukkan salah.</div>');
                redirect('blog/login');
            }
            else{
                $this->session->set_flashdata("message", '<div class="alert alert-success">Username/Password yang Anda masukkan salah.</div>');
                redirect('blog/login');
            }
        }
        $this->load->view('login');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/');
    }
    
}

?>