<?php
class ManageFind extends CI_Controller
{
    private $per_page = 5;
    private $open_id = 1101;

    function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
    }

    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('LostAndFound/Find');
        $this->load->view('templates/footer');
    }
    
    public function view_all()
    {
        $this->load->model("LostAndFound/Found");
        $res = $this->Found->query_all(1,20);
        var_dump($res);
    }
    
}