<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('Home');
		$this->load->view('templates/footer');
	}
	
	public function FindSquare()
	{
	    $this->load->view('templates/header');
	    $this->load->view('FindSquare');
	    $this->load->view('templates/footer');
	}
	
	public function InsertFind()
	{
	    $this->load->view('templates/header');
	    $this->load->view('NewFind');
	    $this->load->view('templates/footer');
	}
	
	public function LoseSquare()
	{
	    $this->load->view('templates/header');
	    $this->load->view('LoseSquare');
	    $this->load->view('templates/footer');
	}
	
	public function InsertLose()
	{
	    $this->load->view('templates/header');
	    $this->load->view('NewLose');
	    $this->load->view('templates/footer');
	}
}
